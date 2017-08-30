<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php') ?>
<div class="content">
    <ul class="postlist">
        <li>
            <h3 class="archive-title"><?php $this->archiveTitle(array(
                    'category'  =>  _t('分类『%s』下的文章'),
                    'search'    =>  _t('包含关键字『%s』的文章'),
                    'tag'       =>  _t('标签『%s』下的文章'),
                    'author'    =>  _t('%s 发布的文章')
                ), '', ''); ?>
            </h3>
        </li>
        <?php if ($this->have()): while($this->next()): ?>
            <li class="post" data-postid="<?php $this->cid() ?>">
                <h1 class="posttitle">
                    <a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
                </h1>
                <div class="container">
                    <?php
//                    getThumbImg($this);
                    $this->excerpt(500); ?>
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
                        <?php $this->date('Y-m-d H:i:s') ?>
                    </span>
                </span>
                    <span>
                    <i class="fa fa-folder"></i>
                    <span class="category">
                        <?php $this->category() ?>
                    </span>
                </span>
                    <span>
                    <i class="fa fa-comments"></i>
                    <span class="comment">
                        <a itemprop="discussionUrl" href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('评论', '1 条评论', '%d 条评论'); ?></a>
                    </span>
                </span>
                </p>
                <div class="clearfix"></div>
            </li>
        <?php endwhile;else:?>
            <li class="post">
                <div class="container">
                    <h1>抱歉,文章都跑火星去了!</h1>
                </div>
            </li>
        <?php endif; ?>
        <?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;', 5, '', array('wrapTag' => 'li', 'wrapClass' => 'pageNav','itemTag' => '','currentClass' => 'current',)); ?>
    </ul><!-- end #main-->
    <?php $this->need('sidebar.php'); ?>
</div>
<?php $this->need('footer.php'); ?>