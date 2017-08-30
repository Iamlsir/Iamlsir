<?php
/**
 * 基于 typecho 默认皮肤,高仿
 * 
 * @package Iamlsir Theme For Typecho
 * @author Iamlsir
 * @version 1.0
 * @link https://www.lifecho.me
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;$this->need('header.php'); ?>
<div class="content">
    <ul class="postlist">
        <?php if($this->have()) :while($this->next()): ?>
            <li class="post" data-postid="<?php $this->cid() ?>">
                <h1 class="posttitle">
                    <a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title(); ?></a>
                </h1>
                <div class="container">
                <?php getThumbImg($this);$this->excerpt(500,'&nbsp;'.SHENGLVEHAO);?>
                </div>
                <div class="clearfix"></div>
                <p class="postarch">
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
                            <a itemprop="discussionUrl" href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('评论', '1条评论', '%d条评论'); ?></a>
                        </span>
                    </span>
                </p>
                <div class="clearfix"></div>
            </li>
        <?php endwhile;endif; ?>
        <?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;', 5, SHENGLVEHAO, array('wrapTag' => 'li', 'wrapClass' => 'pageNav','itemTag' => '','currentClass' => 'current',)); ?>
    </ul>
<?php $this->need('sidebar.php'); ?>
</div>
<?php $this->need('footer.php'); ?>