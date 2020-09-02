<?php
    /* Main Footer File */
?>
        <footer id="bs4seed-footer">
            <div class="container">
                <?php if ( is_active_sidebar( 'footer_widgets' ) ) : ?>
                    <div id="footer-elements" class="row justify-content-around" role="complementary">
                        <?php dynamic_sidebar( 'footer_widgets' ); ?>
                    </div>
                <?php endif; ?>
                <div class="row bottom-row">
                    <div class="col">
                        <p>Boostrap 4 Seed Theme 2020</p>
                    </div>
                </div>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>