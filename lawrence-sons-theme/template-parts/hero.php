<?php
/**
 * Template Part: Hero
 */
$hero_img = lns_get( 'lns_hero_image' );
$bg_style = $hero_img
    ? sprintf( 'background-image:url(%s);', esc_url( $hero_img ) )
    : "background-image:url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1920&q=80');";
?>
<section id="home" class="hero" style="<?php echo esc_attr( $bg_style ); ?>">
    <div class="hero-overlay" aria-hidden="true"></div>

    <div class="container">
        <div class="hero-content">
            <span class="hero-badge">Trusted Exterior Specialists</span>

            <h1>
                BUILT RIGHT.<br>
                <span>EVERY TIME.</span>
            </h1>

            <p class="hero-text">
                Transform your home's exterior with expert craftsmanship.
                From siding and roofing to windows and doors &mdash; we deliver
                lasting durability and unmatched curb appeal.
            </p>

            <div class="hero-buttons">
                <a href="#contact" class="btn btn-primary">
                    GET A QUOTE
                    <?php echo lns_icon( 'arrow-right' ); ?>
                </a>
                <a href="#projects" class="btn btn-outline-white">
                    <?php echo lns_icon( 'play' ); ?>
                    VIEW PROJECTS
                </a>
            </div>

            <div class="hero-stats">
                <div class="hero-stat">
                    <div class="hero-stat-val">25+</div>
                    <div class="hero-stat-label">Years Experience</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-val">500+</div>
                    <div class="hero-stat-label">Projects Completed</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-val">100%</div>
                    <div class="hero-stat-label">Satisfaction</div>
                </div>
            </div>
        </div>
    </div>
</section>
