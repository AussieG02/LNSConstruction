<!-- ============================================================== -->
<!--  FOOTER                                                        -->
<!-- ============================================================== -->
<footer id="contact" class="site-footer" role="contentinfo">
    <div class="container">
        <div class="footer-grid">
            <!-- Brand -->
            <div class="footer-brand">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo" style="margin-bottom:12px;">
                    <div class="nav-logo-icon">
                        <?php echo lns_icon( 'home' ); ?>
                    </div>
                    <div class="nav-logo-text">
                        <span class="nav-logo-name" style="color:#fff;">Lawrence &amp; Sons</span>
                        <span class="nav-logo-sub" style="color:var(--gray-500);">Exterior Renovation</span>
                    </div>
                </a>
                <p>Family-owned exterior renovation specialists. Trusted by homeowners for over 25 years to deliver quality siding, roofing, windows, and more.</p>
            </div>

            <!-- Company -->
            <div class="footer-col">
                <h4>Company</h4>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#about">About Us</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#projects">Our Projects</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#services">Services</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#faq">FAQ</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#contact">Contact</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div class="footer-col">
                <h4>Services</h4>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#services">Siding &amp; Cladding</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#services">Roofing &amp; Gutters</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#services">Windows &amp; Doors</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#services">Exterior Trim &amp; Finishes</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#services">Soffit &amp; Fascia</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="footer-col">
                <h4>Contact Us</h4>
                <ul class="footer-contact">
                    <li>
                        <?php echo lns_icon( 'phone' ); ?>
                        <span><?php echo esc_html( lns_get( 'lns_phone', '(905) 555-0123' ) ); ?></span>
                    </li>
                    <li>
                        <?php echo lns_icon( 'mail' ); ?>
                        <span><?php echo esc_html( lns_get( 'lns_email', 'info@lawrenceandsons.com' ) ); ?></span>
                    </li>
                    <li>
                        <?php echo lns_icon( 'map-pin' ); ?>
                        <span><?php echo esc_html( lns_get( 'lns_service_area', 'Serving the Greater Houston, TX Area' ) ); ?></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bottom bar -->
    <div class="container">
        <div class="footer-bottom">
            <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> Lawrence &amp; Sons Exterior Renovation. All rights reserved.</p>
            <div class="footer-bottom-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
