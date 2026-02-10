<?php
/**
 * Template Part: Recent Projects
 *
 * Swap the placeholder image URLs for real project photos.
 */
$projects = [
    [
        'title'    => 'Modern Siding Overhaul',
        'location' => 'Katy, TX',
        'tag'      => 'Siding',
        'image'    => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=800&q=80',
    ],
    [
        'title'    => 'Complete Roof Replacement',
        'location' => 'Sugar Land, TX',
        'tag'      => 'Roofing',
        'image'    => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800&q=80',
    ],
    [
        'title'    => 'Window & Door Upgrade',
        'location' => 'The Woodlands, TX',
        'tag'      => 'Windows & Doors',
        'image'    => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800&q=80',
    ],
];
?>
<section id="projects" class="section bg-gray">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Our Work</span>
            <h2 class="section-title">RECENT PROJECTS</h2>
            <p class="section-desc">
                Browse our latest exterior renovation projects. Each one reflects
                our commitment to quality materials, precise craftsmanship, and
                homeowner satisfaction.
            </p>
        </div>

        <div class="grid-3">
            <?php foreach ( $projects as $proj ) : ?>
                <div class="project-card">
                    <div class="project-card-img">
                        <img
                            src="<?php echo esc_url( $proj['image'] ); ?>"
                            alt="<?php echo esc_attr( $proj['title'] ); ?>"
                            loading="lazy"
                            width="800" height="600"
                        >
                        <span class="project-card-tag"><?php echo esc_html( $proj['tag'] ); ?></span>
                    </div>
                    <div class="project-card-body">
                        <h3><?php echo esc_html( $proj['title'] ); ?></h3>
                        <div class="project-card-loc">
                            <?php echo lns_icon( 'map-pin' ); ?>
                            <?php echo esc_html( $proj['location'] ); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="section-cta">
            <a href="#projects" class="btn btn-primary">
                EXPLORE OUR PROJECTS
                <?php echo lns_icon( 'arrow-right' ); ?>
            </a>
        </div>
    </div>
</section>
