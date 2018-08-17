<?php
/*
Template Name: fs-theme
*/
?>


<?php $picture = empty(get_option('poster')) ? '' : esc_attr( get_option('poster')); ?>

    <main>
        <div class="mdc-toolbar-fixed-adjust">
            <div id="content">
                <div class="mdc-layout-grid">
                    <div class="mdc-layout-grid__inner" >
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--span-12-tablet">
                            <div class="mdc-card">
                                <div style="background: url('<?php echo $picture; ?>'); width: 475px; height: 336px;"></div>
                            </div>
                        </div>
                        <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--span-12-tablet">
                            <div class="mdc-card" style="">
                                <h2 class="mdc-typography--headline">Hello News</h2>
                                <hr class="mdc-list-divider">
                                <p class="mdc-typography--body1">
                                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
                                    invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
                                    accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata
                                    sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur
                                    sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna
                                    aliquyam erat, sed diam voluptua.
                                <div class="mdc-card__actions">
                                    <div class="mdc-card__action-buttons">
                                        <button class="mdc-button mdc-button--raised mdc-card__action mdc-card__action--button">Mehr</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
