<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;$this->need('header.php');
viewCounter($this->cid);
if ( $this->fields->hasTree == 1 ) { $menu = createMenuTree($this);}
?>
<div class="content">
    <ul class="postlist">
        <li class="posttitle" data-postid="<?php $this->cid() ?>">
            <h1>
                <?php $this->title() ?>
            </h1>
            <span>
                <i class="fa fa-user"></i>
                <span class="author">
                    <a href="<?php $this->author->permalink(); ?>">
                        <?php $this->author(); ?>
                    </a>
                </span>
            </span>
            <span>
                <i class="fa fa-calendar"></i>
                <span data-time="<?php $this->date() ?>" class="time">
                    <?php $this->date('Y-m-d H:i') ?>
                </span>
            </span>
            <span>
                <i class="fa fa-folder"></i>
                <span class="category">
                    <?php $this->category() ?>
                </span>
            </span>
            <span>
                <i class="fa fa-eye"></i>
                <span class="views">
                    <?php echo getViewsNum($this->cid); ?>次浏览
                </span>
            </span>
            <span>
                <i class="fa fa-comments"></i>
                <span class="comment">
                    <a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('评论', '1条评论', '%d条评论'); ?></a>
                </span>
            </span>
            <div class="clearfix"></div>
        </li>
        <li class="postcontent">
            <?php if ( $this->is('post') && $this->fields->hasTree == 1 ):?>
                <span class="postmenu">
                    <h3 class="menu-title">文章目录&nbsp;&nbsp;[<a href="javascript:void(0);" class="open">隐藏</a>]</h3>
                    <?php echo $menu; ?>
                </span>
            <?php endif;if ( (time() - $this->created ) >= 31536000 ):?>
                <div class="yellow">
                    文章发布时间已经超过一年,文中涉及到的相关技术可能已经更新,仅供参考,谢谢!
                </div>
            <?php endif;$this->content(); ?>
        </li>
<!--        <li class="copyright">-->
<!---->
<!--        </li>-->
        <li class="post-tags">
            <?php _e('标签: '); ?><?php $this->tags(' ', true, '暂无标签'); ?>
        </li>
        <li class="post-near">
            <div class="prev">
                上一篇: <?php $this->thePrev('%s','没有了'); ?>
            </div>
            <div class="next">
                下一篇: <?php $this->theNext('%s','没有了'); ?>
            </div>
            <div class="clearfix"></div>
        </li>
        <?php $this->need('comments.php'); ?>
    </ul>
    <?php $this->need('sidebar.php'); ?>
</div>
<?php $this->need('footer.php'); ?>
