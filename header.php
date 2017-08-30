<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 , user-scalable=no">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类[%s]下的文章'),
            'search'    =>  _t('包含关键字[%s]的文章'),
            'tag'       =>  _t('包含标签[%s]的文章'),
            'author'    =>  _t('%s发布的文章'),
            'date'      => _t('%s发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>

    <link rel="stylesheet" href="<?php getUrl('style.css'); ?>">
    <link rel="shortcut icon" href="<?php getUrl('img/fav.icon') ?>">

    <?php $this->header();$menu=''; ?>
</head>
<body>
<div id="header" class="animated">
    <h1>
        <a href="<?php $this->options->siteUrl(); ?>">
            <?php $this->options->title(); ?>
        </a>
        <span class="description">
            <?php $this->options->description(); ?>
        </span>
    </h1>
    <div id="nav">
        <div class="menu">
            <span>&nbsp;</span>
            <span>&nbsp;</span>
            <span>&nbsp;</span>
        </div>
        <ul>
            <li>
                <a<?php if($this->is('index')): ?> class="current"<?php endif; ?> href="<?php $this->options->siteUrl(); ?>">
                    <?php _e('首页'); ?>
                </a>
            </li>
            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php while($pages->next()): ?>
                <li>
                    <a<?php if($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?> href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</div>
<div id="main">