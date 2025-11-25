</main>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <div class="footer-logo">
                    <div class="logo-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <span class="logo-text">MyDispatch</span>
                </div>
                <p class="footer-description">
                    Professional truck dispatch and logistics services for owner-operators and fleets across the United
                    States.
                </p>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <div class="footer-section">
                <h3 class="footer-title">Services</h3>
                <ul class="footer-links">
                    <li><a href="?page=services">Load Dispatching</a></li>
                    <li><a href="?page=services">Fleet Management</a></li>
                    <li><a href="?page=services">Real-time Tracking</a></li>
                    <li><a href="?page=services">Payment Processing</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3 class="footer-title">Company</h3>
                <ul class="footer-links">
                    <li><a href="?page=about">About Us</a></li>
                    <li><a href="?page=contact">Contact</a></li>
                    <li><a href="?page=blog">Blog</a></li>
                    <li><a href="?page=pricing">Pricing</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3 class="footer-title">Support</h3>
                <ul class="footer-links">
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Documentation</a></li>
                    <li><a href="#">API Reference</a></li>
                    <li><a href="#">Status Page</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p class="copyright">
                    &copy; <?php echo date('Y'); ?> MyDispatch Logistics. All rights reserved.
                </p>
                <div class="footer-legal">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Cookie Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- JavaScript -->
<script src="<?php echo $base_path ?? ''; ?>/assets/js/main.js"></script>
<script src="<?php echo $base_path ?? ''; ?>/assets/js/auth.js"></script>

<!-- CSRF Token for AJAX requests -->
<script>
    window.csrfToken = '<?php echo generateCSRFToken(); ?>';
</script>

<!-- Password Toggle Function -->
<script>
    function togglePasswordVisibility(fieldId) {
        const field = document.getElementById(fieldId);
        const button = field.parentNode.querySelector('.password-toggle');
        const icon = button.querySelector('i');

        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
</body>

</html>