<?php
/**
 * Template Part: About Us
 */
$highlights = [
    [
        'icon'  => 'award',
        'title' => 'Over 25 Years Experience',
        'desc'  => 'Decades of proven expertise in exterior renovation projects across the whole Houston, TX.',
    ],
    [
        'icon'  => 'package',
        'title' => 'Best Materials',
        'desc'  => 'We only use top-tier, manufacturer-certified products for lasting results.',
    ],
    [
        'icon'  => 'shield',
        'title' => 'Professional Standards',
        'desc'  => 'Every job meets or exceeds industry codes and manufacturer specifications.',
    ],
];

$features = [
    [ 'icon' => 'badge',    'label' => 'Licensed & Insured' ],
    [ 'icon' => 'wrench',   'label' => 'Warranty-Backed Work' ],
    [ 'icon' => 'sparkles', 'label' => 'Clean Jobsite Promise' ],
];
?>
<section id="about" class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Who We Are</span>
            <h2 class="section-title">ABOUT US</h2>
        </div>

        <div class="about-grid">
            <!-- Left column -->
            <div class="about-left">
                <h3>Your Trusted Exterior Renovation Partner</h3>
                <p>
                    Lawrence &amp; Sons is a family-owned exterior renovation company
                    with over 25 years of hands-on experience. We specialize in
                    transforming homes with premium siding, roofing, windows, doors,
                    and gutters &mdash; delivering results that protect your investment and
                    enhance curb appeal.
                </p>
                <p>
                    From the first consultation to the final walkthrough, our team is
                    committed to transparent communication, meticulous workmanship, and
                    leaving your property better than we found it. We treat every home
                    like it's our own.
                </p>
            </div>

            <!-- Right column: highlights -->
            <div class="about-highlights">
                <?php foreach ( $highlights as $hl ) : ?>
                    <div class="about-hl">
                        <div class="about-hl-icon">
                            <?php echo lns_icon( $hl['icon'] ); ?>
                        </div>
                        <div>
                            <h4><?php echo esc_html( $hl['title'] ); ?></h4>
                            <p><?php echo esc_html( $hl['desc'] ); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Feature tiles -->
        <div class="about-features">
            <?php foreach ( $features as $feat ) : ?>
                <div class="about-feat">
                    <?php echo lns_icon( $feat['icon'] ); ?>
                    <span><?php echo esc_html( $feat['label'] ); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
