<?php
/**
 * Fallback template (required by WordPress).
 * Redirects to front-page for this single-page site.
 */
get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>
        <div class="page-wrap">
            <div class="container">
                <h1><?php the_title(); ?></h1>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    <?php endwhile;
else : ?>
    <div class="page-wrap">
        <div class="container">
            <h1>Nothing found</h1>
            <p>It looks like nothing was found at this location.</p>
        </div>
    </div>
<?php endif;

get_footer();
