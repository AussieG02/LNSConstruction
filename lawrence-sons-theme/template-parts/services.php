<?php
/**
 * Template Part: Services
 */
$services = [
    [
        'icon'  => 'layers',
        'title' => 'Siding & Exterior Cladding',
        'desc'  => 'Upgrade your home\'s protection and appearance with premium vinyl, fiber cement, or engineered wood siding installed by certified professionals.',
    ],
    [
        'icon'  => 'cloud-rain',
        'title' => 'Roofing & Gutters',
        'desc'  => 'From full roof replacements to seamless gutter systems, we safeguard your home against the elements with materials built to last.',
    ],
    [
        'icon'  => 'door-open',
        'title' => 'Windows, Doors & Exterior Finishes',
        'desc'  => 'Boost energy efficiency and curb appeal with expertly installed windows, entry doors, and exterior trim and finish work.',
    ],
];
?>
<section id="services" class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">What We Do</span>
            <h2 class="section-title">OUR SERVICES</h2>
            <p class="section-desc">
                We specialize in exterior renovation services that protect your
                investment and elevate your home's appearance. Every project is backed
                by quality materials and expert workmanship.
            </p>
        </div>

        <div class="grid-3">
            <?php foreach ( $services as $svc ) : ?>
                <div class="service-card">
                    <div class="service-card-icon">
                        <?php echo lns_icon( $svc['icon'] ); ?>
                    </div>
                    <h3><?php echo esc_html( $svc['title'] ); ?></h3>
                    <p><?php echo esc_html( $svc['desc'] ); ?></p>
                    <div class="service-card-footer">
                        <a href="#contact" class="service-card-link">
                            Learn More
                            <?php echo lns_icon( 'arrow-right' ); ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="section-cta">
            <a href="#services" class="btn btn-primary">
                VIEW ALL SERVICES
                <?php echo lns_icon( 'arrow-right' ); ?>
            </a>
        </div>
    </div>
</section>
