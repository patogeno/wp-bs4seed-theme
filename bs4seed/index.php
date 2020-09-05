<?php
/* Index file */
    get_header();
?>

<div class="content-wrapper container">
    <div class="row">
        <main class="bs4seed-main col-12 col-md-8">
            <?php 
                if (have_posts()) :
                    while(have_posts()) :
                        the_post();
                            the_content();
                    endwhile;
                endif;
            ?>
        </main>
        <aside class="bs4seed-aside .d-none col-md-4">
            <?php get_sidebar(); ?> 
        </aside>
    </div>
</div>
<?php get_footer(); ?> 