<?php $picture = empty(get_option('poster')) ? '' : esc_attr( get_option('poster')); ?>


<div class="mdc-card" style="grid-area: poster">
    <img src="<?php echo $picture; ?>" alt="" />
</div>

<div class="mdc-card" style="grid-area: text">
    <h2 class="mdc-typography--headline"><?php the_title(); ?></h2>
    <hr class="mdc-list-divider">
    <p class="mdc-typography--body1">
        <?php echo $post->post_content ?>
    </p>
    <div class="mdc-card__action">
        <div class="mdc-card__action-buttons">
            <a href="https://fsmpi.uni-bayreuth.de/news"><button class="mdc-button mdc-button--raised">Mehr</button></a>
        </div>
    </div>
</div>