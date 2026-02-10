<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ============================================================== -->
<!--  NAVBAR                                                        -->
<!-- ============================================================== -->
<header class="site-header" role="banner">
    <div class="container">
        <div class="nav-inner">
            <!-- Logo -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo" aria-label="<?php bloginfo( 'name' ); ?> — Home">
                <div class="nav-logo-icon">
                    <?php echo lns_icon( 'home' ); ?>
                </div>
                <div class="nav-logo-text">
                    <span class="nav-logo-name">Lawrence &amp; Sons</span>
                    <span class="nav-logo-sub">Exterior Renovation</span>
                </div>
            </a>

            <!-- Desktop nav -->
            <nav class="nav-links" aria-label="Primary navigation">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>#home">Home</a>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>#services">Services</a>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>#projects">Projects</a>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>#about">About</a>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>#faq">FAQ</a>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>#contact">Contact</a>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>#contact" class="btn btn-primary btn-sm">Get a Quote</a>
            </nav>

            <!-- Mobile toggle -->
            <button class="nav-toggle" id="navToggle" aria-label="Open menu" aria-expanded="false" aria-controls="navMobile">
                <span class="nav-toggle-open"><?php echo lns_icon( 'menu' ); ?></span>
                <span class="nav-toggle-close" style="display:none;"><?php echo lns_icon( 'x' ); ?></span>
            </button>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="nav-mobile" id="navMobile" role="navigation" aria-label="Mobile navigation">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>#home">Home</a>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>#services">Services</a>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>#projects">Projects</a>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>#about">About</a>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>#faq">FAQ</a>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>#contact">Contact</a>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>#contact" class="btn btn-primary btn-sm">Get a Quote</a>
    </div>
</header>
