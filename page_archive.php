<?php
/**
 * 文章存档
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;$this->need('header.php'); ?>
    <div class="content">
        <ul class="postlist">
            <li class="posttitle" data-postid="<?php $this->cid() ?>">
                <h1>
                    <a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
                </h1>
                <span class="page-time">
                    <span class="author">
                        <a href="<?php $this->author->permalink(); ?>">
                            <?php $this->author(); ?>
                        </a>
                    </span>
                    发表于
                    <span data-time="<?php echo date('Y-m-d H:i:s',$this->created) ?>" class="time">
                        <?php $this->date('Y-m-d H:i') ?>
                    </span>
                    最后修改于
                    <span data-time="<?php $this->modified ?>" class="modify">
                        <?php echo date('Y-m-d H:i:s',$this->modified) ?>
                    </span>
                </span>
                <div class="clearfix"></div>
            </li>
            <li class="postcontent">
                <?php $this->content(); ?>
                <?php
                $stat = Typecho_Widget::widget('Widget_Stat');
                Typecho_Widget::widget('Widget_Contents_Post_Recent', 'pageSize='.$stat->publishedPostsNum)->to($arch);
                $year=$mon=$i=0;
                $output = '<div class="archives">';
                while($arch->next()){
                    $year_tmp = date('Y',$arch->created);
                    $mon_tmp = date('m',$arch->created);
                    $y=$year; $m=$mon;
                    if ($year > $year_tmp || $mon > $mon_tmp) {
                        $output .= '</ul></div>';
                    }
                    if ($year != $year_tmp || $mon != $mon_tmp) {
                        $year = $year_tmp;
                        $mon = $mon_tmp;
                        $style = $i < 1 ? " style='display:block'" : '';
                        $icon = $i < 1 ? '<i class="fa fa-folder-open"></i>' : '<i class="fa fa-folder"></i>';
                        $output .= '<div class="archives-item"><h2>'.$icon.'&nbsp;&nbsp;'.date('Y年m月',$arch->created).'</h2><ul class="archives_list"'.$style.'>'; //输出年份
                        $i++;
                    }
                    $output .= '<li>'.date('d日',$arch->created).'&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$arch->permalink .'">'. $arch->title .'</a></li>'; //输出文章
                }
                $output .= '</ul></div></div>';
                echo $output;
                ?>
            </li>
            <?php $this->need('comments.php'); ?>
        </ul>
        <?php $this->need('sidebar.php'); ?>
    </div>
<?php $this->need('footer.php'); ?>