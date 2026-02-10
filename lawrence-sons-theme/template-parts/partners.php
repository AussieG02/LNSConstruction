<?php
/**
 * Template Part: We Work With (Partner logos)
 */
$partners = [
    'CertainTeed',
    'James Hardie',
    'GAF',
    'Ply Gem',
    'Andersen',
    'Royal Building',
];
?>
<section class="partners-section">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Our Partners</span>
            <h2 class="section-title">WE WORK WITH</h2>
        </div>

        <div class="partners-grid">
            <?php foreach ( $partners as $name ) : ?>
                <div class="partner-tile">
                    <span><?php echo esc_html( $name ); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
