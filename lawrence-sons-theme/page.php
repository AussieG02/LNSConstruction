<?php
/**
 * Template: Generic Page
 *
 * Used for pages like "Get a Quote" where the [get_quote_form] shortcode lives.
 */
get_header();
?>

<div class="page-wrap">
    <div class="container">
        <?php while ( have_posts() ) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php
get_footer();
