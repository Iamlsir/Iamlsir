<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="sidebar">
    <section class="widget">
        <h3 class="widget-title">搜索</h3>
        <ul class="widget-search">
            <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                <input type="text" id="s" name="s" class="text" placeholder="<?php _e('输入,回车'); ?>" />
            </form>
        </ul>
    </section>
    <section class="widget">
        <h3 class="widget-title">天气</h3>
        <ul class="widget-list">
            <li>
                <span class="location"></span>
                <span class="weather"></span>
            </li>
        </ul>
    </section>
    <?php
        if ( !$this->is('page','archives') ):
    ?>
    <section class="widget">
		<h3 class="widget-title">最新文章</h3>
        <ul class="widget-list">
            <?php $this->widget('Widget_Contents_Post_Recent')
            ->parse('<li><a href="{permalink}" title="{title}">{title}</a></li>'); ?>
        </ul>
    </section>
    <?php endif; ?>

    <section class="widget">
		<h3 class="widget-title">最近回复</h3>
        <ul class="widget-list">
        <?php $this->widget('Widget_Comments_Recent')->to($comments); ?>
        <?php while($comments->next()): ?>
            <li><a href="<?php $comments->permalink(); ?>" class="noinblock"><?php $comments->author(false); ?></a>: <?php $comments->excerpt(35, '...'); ?></li>
        <?php endwhile; ?>
        </ul>
    </section>

    <section class="widget">
		<h3 class="widget-title">分类</h3>
        <?php $this->widget('Widget_Metas_Category_List')->listCategories('wrapClass=widget-list'); ?>
	</section>

    <section class="widget">
		<h3 class="widget-title">归档</h3>
        <ul class="widget-list">
            <?php $this->widget('Widget_Contents_Post_Date', 'type=year&format=Y')
            ->parse('<li><a href="{permalink}">&nbsp;-&nbsp;&nbsp;{date}</a></li>'); ?>
        </ul>
	</section>

	<section class="widget">
		<h3 class="widget-title">其它</h3>
        <ul class="widget-list">
            <?php if($this->user->hasLogin()): ?>
				<li class="last"><a href="<?php $this->options->adminUrl(); ?>" data-no-instant><?php _e('进入后台'); ?> (<?php $this->user->screenName(); ?>)</a></li>
                <li><a href="<?php $this->options->logoutUrl(); ?>" data-no-instant><?php _e('退出'); ?></a></li>
            <?php else: ?>
                <li class="last"><a href="<?php $this->options->adminUrl('login.php'); ?>" data-no-instant><?php _e('登录'); ?></a></li>
            <?php endif; ?>
            <li><a href="<?php $this->options->feedUrl(); ?>"><?php _e('文章 RSS'); ?></a></li>
            <li><a href="<?php $this->options->commentsFeedUrl(); ?>"><?php _e('评论 RSS'); ?></a></li>
            <li><a href="http://www.typecho.org">Typecho</a></li>
        </ul>
	</section>

</div>
