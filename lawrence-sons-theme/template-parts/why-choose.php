<?php
/**
 * Template Part: Why Choose Us
 */
$reasons = [
    [
        'icon'  => 'thumbs-up',
        'title' => 'Quality Craftsmanship',
        'desc'  => 'Our skilled crews deliver precision exterior work using industry-leading techniques and manufacturer-certified installations.',
    ],
    [
        'icon'  => 'clock',
        'title' => 'On Time, On Budget',
        'desc'  => 'We respect your time and investment. Every project includes a clear timeline and transparent pricing with no surprise costs.',
    ],
    [
        'icon'  => 'handshake',
        'title' => 'Customer-First Approach',
        'desc'  => 'From your first call to the final walkthrough, we communicate openly and ensure you\'re thrilled with the result.',
    ],
];
?>
<section id="faq" class="section bg-gray">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">The Difference</span>
            <h2 class="section-title">WHY CHOOSE LAWRENCE &amp; SONS</h2>
            <p class="section-desc">
                Homeowners trust us because we combine old-school work ethic with
                modern materials and methods. Here's what sets us apart.
            </p>
        </div>

        <div class="grid-3">
            <?php foreach ( $reasons as $r ) : ?>
                <div class="why-card">
                    <div class="why-icon">
                        <?php echo lns_icon( $r['icon'] ); ?>
                    </div>
                    <h3><?php echo esc_html( $r['title'] ); ?></h3>
                    <p><?php echo esc_html( $r['desc'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
