<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;$this->need('header.php');
?>
<div class="content">
    <ul class="postlist">
        <li class="posttitle" data-postid="<?php $this->cid() ?>">
            <h1>
                抱歉,您查找的页面失联了!
            </h1>
        </li>
        <li class="postcontent">
            <ul class="widget-search">
                <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                    <input type="text" id="s" name="s" class="text" placeholder="<?php _e('输入,回车'); ?>" />
                </form>
            </ul>
        </li>
    </ul>
    <?php $this->need('sidebar.php'); ?>
</div>
<?php $this->need('footer.php'); ?>