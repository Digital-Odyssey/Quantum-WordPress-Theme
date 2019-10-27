<?php

/**

 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))

		die ('Please do not load this page directly. Thanks!');

	if (post_password_required()) {
    ?>

    <p class="nocomments"><?php esc_attr_e('This post is password protected. Enter the password to view comments.', 'quantumtheme'); ?></p>

    <?php
    return;
}

global $id;
$id = $post->ID;

?>



<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>

	<div class="pm-comment-header">
        <h3 id="comments"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h3>
    </div>
     
    <div class="navigation">
        <div class="alignleft"><?php previous_comments_link() ?></div>
        <div class="alignright"><?php next_comments_link() ?></div>
    </div>
     
    <ol class="commentlist" style="margin:0; padding:0;">
        <?php wp_list_comments('callback=pm_ln_mytheme_comment'); ?>
    </ol>
     
    <div class="navigation">
        <div class="alignleft"><?php previous_comments_link() ?></div>
        <div class="alignright"><?php next_comments_link() ?></div>
    </div>
<?php else : // this is displayed if there are no comments so far ?>
 
<?php if ('open' == $post->comment_status) : ?>
<!-- If comments are open, but there are no comments. -->
 
	<?php else : // comments are closed ?>
    <!-- If comments are closed. -->
    <p class="nocomments">Comments are closed.</p>
     
<?php endif; ?>

<?php endif; ?>
 
<?php if ('open' == $post->comment_status) : ?>
 
<div id="respond">

    <div class="pm-comment-header">
        <h3><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h3>
        <!--<div class="pm-comment-header-block"></div>-->
    </div>
 
     
    <div class="cancel-comment-reply" style="margin-bottom:15px;">
        <small><?php cancel_comment_reply_link(); ?></small>
    </div>
 
	<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
        <p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php esc_attr_e('logged in', 'quantumtheme'); ?></a> <?php esc_attr_e('to post a comment.', 'quantumtheme'); ?></p>
    <?php else : ?>
 
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="comment-form">
     
		<?php if ( $user_ID ) : ?>
        
        <?php 
			$user = wp_get_current_user();
		?>
         
        <p><?php esc_attr_e('Logged in as', 'quantumtheme'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo esc_attr($user->display_name); ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php esc_attr_e('Log out of this account','quantumtheme'); ?>"><?php esc_attr_e('Log out', 'quantumtheme'); ?> &raquo;</a></p>
         
        <?php else : ?>
         
        <p><input type="text" name="author" placeholder="<?php esc_attr_e('Name *', 'quantumtheme'); ?>" id="author" class="respond_author pm-comment-form-textfield" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> /></p>
         
        <p><input type="text" name="email" placeholder="<?php esc_attr_e('Email *', 'quantumtheme'); ?>" id="email" class="respond_email pm-comment-form-textfield" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
        </p>
         
        <p><input type="text" name="url" placeholder="<?php esc_attr_e('Website', 'quantumtheme'); ?>" id="url" class="respond_url pm-comment-form-textfield" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
        </p>
         
        <?php endif; ?>
         
        <!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
         
        <p><textarea name="comment" placeholder="<?php esc_attr_e('Comment...', 'quantumtheme'); ?>" id="comment" class="respond_comment pm-comment-form-textarea" cols="100" rows="10" tabindex="4"></textarea></p>
         
        <p><input name="submit" type="submit" id="submit" class="pm-rounded-submit-btn" tabindex="5" value="<?php esc_attr_e('Submit Comment', 'quantumtheme') ?>" />
        <?php comment_id_fields(); ?>
        </p>
        <?php do_action('comment_form', $post->ID); ?>
     
    </form>
 
	<?php endif; // If registration required and not logged in ?>
    
</div>
 
<?php endif; // if you delete this the sky will fall on your head ?>