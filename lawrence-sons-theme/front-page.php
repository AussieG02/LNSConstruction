<?php
/**
 * Template: Front Page (Homepage)
 *
 * To use: set Settings → Reading → "Your homepage displays" to "A static page"
 * and select a page as the homepage.
 */
get_header();

get_template_part( 'template-parts/hero' );
get_template_part( 'template-parts/info-strip' );
get_template_part( 'template-parts/services' );
get_template_part( 'template-parts/projects' );
get_template_part( 'template-parts/about' );
get_template_part( 'template-parts/why-choose' );
get_template_part( 'template-parts/partners' );

get_footer();
