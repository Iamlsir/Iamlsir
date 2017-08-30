<?php
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
            </li>
            <?php $this->need('comments.php'); ?>
        </ul>
        <?php $this->need('sidebar.php'); ?>
    </div>
<?php $this->need('footer.php'); ?>