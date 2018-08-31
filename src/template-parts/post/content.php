<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

<div id="post-<?php the_ID(); ?>" class="mdc-card <?php foreach(get_post_class() as $class) echo $class.' '; ?>">
    <div class="mdc-card__media">
        <?php if('' !== get_the_post_thumbnail() && ! is_signle() ) : ?>
            <div class="mdc-card__media-content">

            </div>
        <?php endif; ?>
    </div>
    <div class="mdc-card__main-content">
        <?php the_title('<h1 class="mdc-typography--headline">', '</h1>'); ?>
        <small><?php the_time('l, j. F, Y') ?></small>

        <p class="mdc-typography--body1">
            <?php echo get_the_excerpt(); ?>
        </p>
    </div>
    <hr class="mdc-list-divider">
    <div class="mdc-card__actions">
        <div class="mdc-card__action-buttons">
            <a href="<?php the_permalink(); ?>" class="mdc-button mdc-card__action mdc-card__action--button"><?php _e('Mehr'); ?></a>
        </div>
    </div>
</div>

