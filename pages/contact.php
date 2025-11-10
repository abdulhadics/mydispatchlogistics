<?php
$page_title = 'Contact Us - MyDispatch';
$page_description = 'Get in touch with MyDispatch for professional truck dispatch and logistics services.';
$body_class = 'contact-page';

$success_message = '';
$error_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    // Basic validation
    if (empty($name) || empty($email) || empty($message)) {
        $error_message = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Please enter a valid email address.';
    } else {
        try {
            $db = getDB();
            $stmt = $db->prepare("INSERT INTO contact_messages (name, email, phone, subject, message, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
            $result = $stmt->execute([$name, $email, $phone, $subject, $message]);
            
            if ($result) {
                $success_message = 'Thank you for your message! We will get back to you within 24 hours.';
                // Clear form data
                $_POST = [];
            } else {
                $error_message = 'Sorry, there was an error sending your message. Please try again.';
            }
        } catch (Exception $e) {
            $error_message = 'Sorry, there was an error sending your message. Please try again.';
        }
    }
}

include 'includes/header.php';
?>

<div class="contact-container">
    <div class="contact-header">
        <h1 class="contact-title">Get In Touch</h1>
        <p class="contact-subtitle">
            Ready to boost your trucking business? Contact us today for a free consultation 
            and discover how MyDispatch can help maximize your earnings.
        </p>
    </div>

    <div class="contact-content">
        <!-- Contact Form -->
        <div class="contact-form-section">
            <div class="form-card">
                <h2 class="form-title">
                    <i class="fas fa-envelope"></i>
                    Send us a Message
                </h2>
                
                <?php if ($success_message): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <span><?php echo htmlspecialchars($success_message); ?></span>
                    </div>
                <?php endif; ?>
                
                <?php if ($error_message): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <span><?php echo htmlspecialchars($error_message); ?></span>
                    </div>
                <?php endif; ?>
                
                <form method="POST" class="contact-form">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name" class="form-label">Full Name *</label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                class="form-input" 
                                placeholder="Enter your full name"
                                value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"
                                required
                            >
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address *</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                class="form-input" 
                                placeholder="Enter your email"
                                value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                                required
                            >
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input 
                                type="tel" 
                                id="phone" 
                                name="phone" 
                                class="form-input" 
                                placeholder="Enter your phone number"
                                value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>"
                            >
                        </div>
                        
                        <div class="form-group">
                            <label for="subject" class="form-label">Subject</label>
                            <select id="subject" name="subject" class="form-input">
                                <option value="">Select a subject</option>
                                <option value="General Inquiry" <?php echo (($_POST['subject'] ?? '') === 'General Inquiry') ? 'selected' : ''; ?>>General Inquiry</option>
                                <option value="Load Dispatching" <?php echo (($_POST['subject'] ?? '') === 'Load Dispatching') ? 'selected' : ''; ?>>Load Dispatching</option>
                                <option value="Fleet Management" <?php echo (($_POST['subject'] ?? '') === 'Fleet Management') ? 'selected' : ''; ?>>Fleet Management</option>
                                <option value="Payment Processing" <?php echo (($_POST['subject'] ?? '') === 'Payment Processing') ? 'selected' : ''; ?>>Payment Processing</option>
                                <option value="Technical Support" <?php echo (($_POST['subject'] ?? '') === 'Technical Support') ? 'selected' : ''; ?>>Technical Support</option>
                                <option value="Partnership" <?php echo (($_POST['subject'] ?? '') === 'Partnership') ? 'selected' : ''; ?>>Partnership</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="message" class="form-label">Message *</label>
                        <textarea 
                            id="message" 
                            name="message" 
                            class="form-input" 
                            rows="6" 
                            placeholder="Tell us about your needs and how we can help..."
                            required
                        ><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-full">
                        <i class="fas fa-paper-plane"></i>
                        Send Message
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Contact Information -->
        <div class="contact-info-section">
            <div class="info-card">
                <h2 class="info-title">
                    <i class="fas fa-info-circle"></i>
                    Contact Information
                </h2>
                
                <div class="contact-methods">
                    <div class="contact-method">
                        <div class="method-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="method-content">
                            <h3>Phone</h3>
                            <p>+1 (555) 123-4567</p>
                            <span>Available 24/7</span>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <div class="method-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="method-content">
                            <h3>Email</h3>
                            <p>info@mydispatch.com</p>
                            <span>Response within 24 hours</span>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <div class="method-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="method-content">
                            <h3>Address</h3>
                            <p>123 Logistics Way<br>Dallas, TX 75201</p>
                            <span>Headquarters</span>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <div class="method-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="method-content">
                            <h3>Business Hours</h3>
                            <p>Monday - Friday: 8AM - 6PM<br>Saturday: 9AM - 4PM</p>
                            <span>Central Time</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="quick-links-card">
                <h3 class="links-title">Quick Links</h3>
                <div class="links-grid">
                    <a href="?page=services" class="quick-link">
                        <i class="fas fa-truck"></i>
                        <span>Our Services</span>
                    </a>
                    <a href="?page=pricing" class="quick-link">
                        <i class="fas fa-dollar-sign"></i>
                        <span>Pricing</span>
                    </a>
                    <a href="?page=carrier-setup" class="quick-link">
                        <i class="fas fa-user-plus"></i>
                        <span>Carrier Setup</span>
                    </a>
                    <a href="?page=signup" class="quick-link">
                        <i class="fas fa-rocket"></i>
                        <span>Get Started</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.contact-page {
    background: #0a0a0a;
    min-height: 100vh;
    padding-top: 2rem;
}

.contact-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.contact-header {
    text-align: center;
    margin-bottom: 4rem;
}

.contact-title {
    font-size: 3rem;
    font-weight: 800;
    background: linear-gradient(135deg, #ffffff 0%, #a855f7 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 1rem;
}

.contact-subtitle {
    font-size: 1.25rem;
    color: #a3a3a3;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

.contact-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 3rem;
    margin-bottom: 4rem;
}

.form-card,
.info-card,
.quick-links-card {
    background: rgba(23, 23, 23, 0.6);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 16px;
    padding: 2rem;
}

.form-title,
.info-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: white;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.contact-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-label {
    color: #e5e5e5;
    font-weight: 500;
    font-size: 0.875rem;
}

.form-input {
    padding: 12px 16px;
    background: rgba(23, 23, 23, 0.8);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 8px;
    color: white;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-input:focus {
    outline: none;
    border-color: #a855f7;
    box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.1);
}

.form-input::placeholder {
    color: #737373;
}

textarea.form-input {
    resize: vertical;
    min-height: 120px;
}

.btn-full {
    width: 100%;
    padding: 16px;
    font-size: 1.125rem;
}

.contact-methods {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.contact-method {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.method-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: white;
    flex-shrink: 0;
}

.method-content h3 {
    color: white;
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.method-content p {
    color: #e5e5e5;
    margin-bottom: 0.25rem;
    line-height: 1.4;
}

.method-content span {
    color: #a3a3a3;
    font-size: 0.875rem;
}

.quick-links-card {
    margin-top: 2rem;
}

.links-title {
    color: white;
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
}

.links-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.quick-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 12px 16px;
    background: rgba(38, 38, 38, 0.5);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 8px;
    color: #a3a3a3;
    text-decoration: none;
    transition: all 0.3s ease;
}

.quick-link:hover {
    background: rgba(139, 92, 246, 0.1);
    border-color: #a855f7;
    color: #a855f7;
}

.quick-link i {
    font-size: 1.125rem;
}

@media (max-width: 768px) {
    .contact-container {
        padding: 0 1rem;
    }
    
    .contact-title {
        font-size: 2rem;
    }
    
    .contact-subtitle {
        font-size: 1rem;
    }
    
    .contact-content {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .links-grid {
        grid-template-columns: 1fr;
    }
    
    .form-card,
    .info-card,
    .quick-links-card {
        padding: 1.5rem;
    }
}
</style>

<?php include 'includes/footer.php'; ?>
