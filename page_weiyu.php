<?php
/**
 * 微语
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function weiyu($comments, $options)
{?>
    <li id="<?php $comments->theId(); ?>" class="comment-body<?php
    if ($comments->levels > 0) {
        echo ' comment-child';
        $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
    } else {
        echo ' comment-parent';
    }
    $comments->alt(' comment-odd', ' comment-even');
    ?>">
        <div class="comment-avatar">
            <img class="avatar"  src="<?php echo getAvatar($comments->mail, $options->avatarSize, null,$options->defaultAvatar);?>" width="64">
        </div>
        <div class="comment-meta">
            <span class="comment-meta-author">
                <?php echo $comments->author ?>
            </span>
            <span class="comment-meta-time">
                <?php $comments->date('Y-m-d H:i:s');?>
            </span>
        </div>
        <div class="comment-content" itemprop="commentText">
            <?php $comments->content(); ?>
        </div>
    </li>
    <?php
}
$this->need('header.php'); ?>
    <div class="content">
        <ul class="postlist">
            <li class="posttitle" data-postid="<?php $this->cid() ?>">
                <?php $this->content() ?>
            </li>
            <li class="postcontent weiyu">
                <!--开始-->
                <div id="weiyu">
                    <?php $this->comments()->to($comments); ?>
                    <?php if ($comments->have()): ?>
                        <?php $comments->listComments();
                        $comments->pageNav('&laquo; 前一页', '后一页 &raquo;', 5, '', array('wrapTag' => 'div', 'wrapClass' => 'pageNav','itemTag' => '','currentClass' => 'current',));
                    else: echo 'Nothing';
                    endif; ?>
                </div>
            <!--结束-->
            </li>
            <?php if($this->user->hasLogin()): ?>
            <li id="<?php $this->respondId(); ?>" class="respond">
                <h3 id="response"><?php _e('发表'); ?></h3>
                <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
                    <p>
                        <label for="textarea" class="required ct-cmt"><?php _e('唠叨'); ?></label>
                        <textarea rows="8" cols="50" name="text" id="textarea" class="textarea" required ><?php $this->remember('text'); ?></textarea>
                    </p>
                    <p>
                        <button type="submit" class="button"><?php _e('发表'); ?></button>
                    </p>
                    <div class="clearfix"></div>
                </form>
            </li>
            <?php endif; ?>
        </ul>
        <?php $this->need('sidebar.php'); ?>
    </div>
<?php $this->need('footer.php'); ?>