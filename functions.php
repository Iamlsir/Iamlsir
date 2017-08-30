<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

//if($this->request->isAjax()) sleep(10);

define('SHENGLVEHAO','···');

function themeInit(){

}

function themeConfig($form) {
    $adminEmail = new Typecho_Widget_Helper_Form_Element_Text('adminEmail', NULL, NULL, _t('站长邮箱'), _t('博主邮箱'));
    $form->addInput($adminEmail);
    
    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock',
    array('ShowRecentPosts' => _t('显示最新文章'),
    'ShowRecentComments' => _t('显示最近回复'),
    'ShowCategory' => _t('显示分类'),
    'ShowArchive' => _t('显示归档'),
    'ShowOther' => _t('显示其它杂项')),
    array('ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowArchive', 'ShowOther'), _t('侧边栏显示'));

    $form->addInput($sidebarBlock->multiMode());
}

function getUrl($str)
{
    echo Helper::options()->themeUrl($str,'Iamlsir');
}

/**
 * 获取文章缩略图
 * @param $archive
 * @param null $size
 * @return string
 */
function getThumbImg($archive)
{
    preg_match_all( "/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $archive->content, $matches );
    $image = $matches[1][0];
    if ( !isset($image) ){
        return '';
    }

    //先看有没有缓存的缩略图
    $cacheDir = __TYPECHO_ROOT_DIR__ . '/usr/cache/thumb/';

    if ( !is_file( $cacheDir . $archive->cid . '.jpg' ) ){
        //生成缩略图并返回
        require_once __DIR__ . '/extra/Image.php';
        $src = dirname(dirname(dirname(__DIR__))) . '/' . str_replace(Helper::options()->siteUrl,'',$image);
        if ( !is_file($src) ){
            return '';
        }
        $img = new Image(1,$src);
        $img->thumb(300,200);
        $img->save($cacheDir . $archive->cid . '.jpg','jpg');
    }
    $thumb = Helper::options()->siteUrl . '/usr/cache/thumb/' . $archive->cid.'.jpg';
    echo '<a href="'.$archive->permalink.'" class="thumb" title="点击阅读全文"><img src="'.$thumb.'" alt="'.$archive->title.'"></a>';
}

/**
 * 带缓存的头像
 * @param $mail
 * @param $size
 */
function getAvatar($mail='', $size=60, $rating = '', $default='',$isSecure = false )
{
    $cache = __TYPECHO_ROOT_DIR__ . '/usr/cache/avatar/';

    if ( $mail == Helper::options()->adminEmail ){
        return Helper::options()->themeUrl('extra/admin.jpg','Iamlsir');
    }

    if ( $mail == '' ){
        return Helper::options()->themeUrl('extra/default.jpg','Iamlsir');
    }
    $head = md5(strtolower(trim($mail))).'_'.$size;

    if ( !file_exists( $cache . $head . '.jpg') || time() - filectime($cache . $head . '.jpg') > 604800 ){
        $file = Typecho_Common::gravatarUrl($mail,$size,$rating,$default,$isSecure);

        if ( !copy( $file, $cache . $head . '.jpg' ) ){
            echo $file;
        }
    }
    return Helper::options()->siteUrl('/usr/cache/avatar/' . $head . '.jpg') ;
}

/**
 * 重写评论显示函数
 * @param $comments
 * @param $options
 * @return void
 */
function threadedComments($comments, $options)
{
    if ( function_exists('weiyu') ){
        weiyu($comments,$options);
        return;
    }
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }

    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    ?>
    <li id="<?php $comments->theId(); ?>" class="comment-body<?php
    if ($comments->levels > 0) {
        echo ' comment-child';
        $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
    } else {
        echo ' comment-parent';
    }
    $comments->alt(' comment-odd', ' comment-even');
    echo $commentClass;
    ?>">
        <div class="comment-avatar">
            <img class="avatar"  src="<?php echo getAvatar($comments->mail, $options->avatarSize, null,$options->defaultAvatar);?>" width="<?php echo $options->avatarSize;?>">
        </div>
        <div class="comment-meta">
            <span class="comment-meta-author">
                <a href="<?php echo $comments->url ?>" rel="external nofollow" target="_blank" title="<?php if (empty($comments->url)){echo '此獠未留下地址!';}else{ echo '看看 '.$comments->author.' 的站';} ?>"><?php echo $comments->author ?></a>
                <?php if ( $comments->authorId == $comments->ownerId ):?>
                    <span class="label">作者</span>
                <?php endif; ?>
            </span>
            <span class="comment-meta-time">
                <a href="<?php $comments->permalink(); ?>"><time itemprop="commentTime" datetime="<?php $comments->date('c'); ?>"><?php $options->beforeDate();
                        $comments->date($options->dateFormat);
                        $options->afterDate(); ?></time></a>
            </span>
            <?php if ('waiting' == $comments->status) { ?>
                <em class="comment-awaiting-moderation"><?php $options->commentStatus(); ?></em>
            <?php } ?>
            <span class="comment-meta-reply">
                <?php $comments->reply($options->replyWord); ?>
            </span>
        </div>
        <div class="comment-content" itemprop="commentText">
            <?php $comments->content(); ?>
        </div>

        <?php if ($comments->children) { ?>
            <div class="comment-children" itemprop="discusses">
                <?php $comments->threadedComments(); ?>
            </div>
        <?php } ?>
    </li>
    <?php
}

/**
 * 浏览量
 * @param $archive
 */
function viewCounter($cid)
{
    $views = Typecho_Cookie::get('__sis_pvs');
    if(empty($views)){
        $views = array();
    }else{
        $views = explode(',', $views);
    }
    if(!in_array($cid,$views)){
        $db = Typecho_Db::get();
        $row = $db->fetchRow($db->select('viewsNum')->from('table.contents')->where('cid = ?', $cid));
        $db->query($db->update('table.contents')->rows(array('viewsNum' => (int)$row['viewsNum']+1))->where('cid = ?', $cid));
        array_push($views, $cid);
        $views = implode(',', $views);
        Typecho_Cookie::set('__sis_pvs', $views); //记录查看cookie
    }
}

function getViewsNum($cid)
{
    $db = Typecho_Db::get();
    $row = $db->fetchRow($db->select('viewsNum')->from('table.contents')->where('cid = ?', $cid));
    if ( $row ){
        return $row['viewsNum'];
    }
    return 0;
}

/**
 * 文章目录树
 * @param $obj
 * @return string
 */
function createMenuTree(&$obj)
{
    $menuTree = new MenuTree($obj->content);
    $result = $menuTree::result();
    $obj->content = $menuTree::parse();
    return $result;
}
class MenuTree{
    public static $id = 1;
    public static $tree = array();
    public static $html = '';
    public function __construct(&$html)
    {
        self::$html = $html;
        self::parse();
    }
    public static function parse() {
        $html = preg_replace_callback( '/<h([1-6])[^>]*>.*?<\/h\1>/s', array('MenuTree','parseCallback'), self::$html );
        return $html;
    }
    public static function parseCallback( $match ) {
        $parent = &self::$tree;
        $html = $match[0];
        $n = $match[1];
        $menu = array(
            'num' => $n,
            'title' => trim( strip_tags( $html ) ),
            'id' => 'menu_index_' . self::$id,
            'sub' => array()
        );
        $current = array();
        if( $parent ) {
            $current = &$parent[ count( $parent ) - 1 ];
        }
        // 根
        if( ! $parent || ( isset( $current['num'] ) && $n <= $current['num'] ) ) {
            $parent[] = $menu;
        } else {
            while( is_array( $current[ 'sub' ] ) ) {
                // 父子关系
                if( $current['num'] == $n - 1 ) {
                    $current[ 'sub' ][] = $menu;
                    break;
                }
                // 后代关系，并存在子菜单
                elseif( $current['num'] < $n && $current[ 'sub' ] ) {
                    $current = &$current['sub'][ count( $current['sub'] ) - 1 ];
                }
                // 后代关系，不存在子菜单
                else {
                    for( $i = 0; $i < $n - $current['num']; $i++ ) {
                        $current['sub'][] = array(
                            'num' => $current['num'] + 1,
                            'sub' => array()
                        );
                        $current = &$current['sub'][0];
                    }
                    $current['sub'][] = $menu;
                    break;
                }
            }
        }
        self::$id++;
        return "<span id=\"{$menu['id']}\" name=\"{$menu['id']}\"></span>" . $html;
    }
    public static function buildMenuHtml( $tree, $include = true ) {
        $menuHtml = '';
        foreach( $tree as $menu ) {
            if( ! isset( $menu['id'] ) && $menu['sub'] ) {
                $menuHtml .= self::buildMenuHtml( $menu['sub'], false );
            } elseif( $menu['sub'] ) {
                $menuHtml .= "<li><a data-scroll href=\"#{$menu['id']}\" title=\"{$menu['title']}\">{$menu['title']}</a>" . self::buildMenuHtml( $menu['sub'] ) . "</li>";
            } else {
                $menuHtml .= "<li><a data-scroll href=\"#{$menu['id']}\" title=\"{$menu['title']}\">{$menu['title']}</a></li>";
            }
        }
        if( $include ) {
            $menuHtml = '<ul class="menu-list">' . $menuHtml . '</ul>';
        }
        return $menuHtml;
    }
    public static function result() {
        $html = self::buildMenuHtml( self::$tree ) ;
        self::$id = 1;
        self::$tree = array();
        return $html;
    }
}