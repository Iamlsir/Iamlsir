<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
</div>
<div class="clearfix"></div>
<footer id="footer">
    &copy; 2012-<?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>. All Rights Reserved. Powered by <a href="http://www.typecho.org" target="_blank">Typecho</a>&nbsp;&nbsp;已默默运行<span id="runtime"></span>.
    <div class="tool">
        <a id="backtop">
            <i class="fa fa-angle-double-up"></i>
        </a>
        <a id="gobottom">
            <i class="fa fa-angle-double-down"></i>
        </a>
    </div>
    <div id="circle"></div>
    <div id="circle1"></div>
</footer>
<?php $this->footer(); ?>
<script>
    var options = {};
    options.scroll = 0;
    options.scrollTop = 0;
    options.themeUrl = '<?php $this->options->themeUrl(); ?>';
</script>
<script type="application/javascript" src="<?php $this->options->themeUrl('js/jQuery.min.js') ?>" data-no-instant></script>
<script type="application/javascript" src="<?php $this->options->themeUrl('js/jQuery.pjax.js') ?>" data-no-instant></script>
<!--<script type="application/javascript" src="--><?php //$this->options->themeUrl('js/instantclick.min.js') ?><!--" data-no-instant></script>-->
<script type="application/javascript" src="<?php $this->options->themeUrl('js/script.js') ?>"></script>
</body>
</html>