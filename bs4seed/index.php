<?php
/* Index file */
    get_header();
?>

<main class="container bs4seed-main">
    <?php 
        if (have_posts()) :
            while(have_posts()) :
                the_post();
                    the_content();
            endwhile;
        endif;
    ?>
</main>

<?php get_footer(); ?> 