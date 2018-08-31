<?php $panik = empty(get_option('panik')) ? '' : esc_attr( get_option('panik')); ?>

<div class="mdc-card" style="grid-area: text">
    <h2 class="mdc-typography--headline">Keine Panik</h2>
    <hr class="mdc-list-divider">
    <p class="mdc-typography--body1">
        <?php echo $post->post_content ?>
    </p>
</div>

<div class="mdc-card" style="grid-area: panik">
    <iframe src="https://docs.google.com/viewer?url=<?php echo $panik; ?>&embedded=true" frameborder="0"></iframe>
</div>