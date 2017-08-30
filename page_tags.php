<?php
/**
 * 标签云
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
            </li>
            <li class="postcontent">
                <?php $this->content(); ?>
                <ul class="post-tags">
                    <?php
                    @Typecho_Widget::widget('Widget_Metas_Tag_Cloud', $params)->to($tags);

                    $list = $counts = array();
                    while($tags->next()){
                        $list[] = array(
                            'mid'=>$tags->mid,
                            'name'=>$tags->name,
                            'permalink'=>$tags->permalink,
                            'count'=>$tags->count,
                        );
                        if ( !in_array($tags->count,$counts) ){
                            $counts[] = $tags->count;
                        }
                    }

                    $count_sum = count($counts);

                    if ( $count_sum == 0 ){
                        echo '暂无标签';
                    }else{
                        $html = '';

                        $fontsize = range(1,3,0.2);
                        rsort($fontsize);
                        $html = '';
                        $fontsizesort = 0;
                        foreach ( $list as $tag ){

                            $size = isset($fontsize[$fontsizesort]) ? $fontsize[$fontsizesort] : $fontsize[count($fontsize)-1];

                            $html .= '<a href="'.$tag['permalink'].'" title="'.$tag['count'].'篇文章" style="font-size:'.$size.'em">'.$tag['name'].'<span class="count">&nbsp;'.$tag['count'].'</span></a>';
                            $fontsizesort += 1;
                        }
                        echo $html;
                    }
                    ?>
                </ul>
            </li>
        </ul>
        <?php $this->need('sidebar.php'); ?>
    </div>
<?php $this->need('footer.php'); ?>