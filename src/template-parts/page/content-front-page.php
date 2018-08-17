<?php $picture = empty(get_option('poster')) ? '' : esc_attr( get_option('poster')); ?>

<div class="mdc-layout-grid">
    <div class="mdc-layout-grid__inner">

        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1-tablet mdc-layout-grid__cell--span-2-desktop offset_cell"></div>
        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-2-desktop offset_cell_ipad-pro" style="display: none"></div>
        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-phone mdc-layout-grid__cell--span-6-tablet mdc-card">
            <div class="mdc-card__media">
                <img src="<?php echo $picture; ?>" style="width: 100%; height: 100%;" alt="" />
            </div>
        </div>
        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1-tablet offset_cell"></div>

        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-1-tablet offset_cell"></div>
        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-phone mdc-layout-grid__cell--span-6-tablet mdc-layout-grid__cell--span-4-desktop mdc-card">
                <h2 class="mdc-typography--headline"><?php the_title(); ?></h2>
                <hr class="mdc-list-divider">
                <p class="mdc-typography--body1">
                    <?php echo $post->post_content ?>
                <!--div class="mdc-card__actions">
                    <div class="mdc-card__action-buttons">
                        <button class="mdc-button mdc-button--raised mdc-card__action mdc-card__action--button">Mehr</button>
                    </div>

                     style="background: none; box-shadow: none"

                </div-->

        </div>
    </div>
</div>