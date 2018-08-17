
<?php get_header('mobile'); ?>

<main>
    <div class="mdc-toolbar-fixed-adjust">
        <div id="content">
            <?php get_template_part( 'template-parts/page/content', 'front-page' ); ?>


            </div>
            <!--div class="demo-grid mdc-layout-grid">
                <div class="mdc-layout-grid__inner">
                    <div class="demo-cell mdc-layout-grid__cell mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--span-12-tablet">6 (8 tablet)</div>
                    <div class="demo-cell mdc-layout-grid__cell mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--span-12-tablet">4 (6 tablet)</div>
                </div>
            </div-->
        </div>
    </div>
</main>

<?php get_footer(); ?>