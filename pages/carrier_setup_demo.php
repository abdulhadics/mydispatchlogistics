<?php
$page_title = 'Carrier Setup - MyDispatch';
$page_description = 'Join MyDispatch as a carrier and start earning more with better loads.';
$body_class = 'carrier-setup-page';

include 'includes/header_demo.php';
include 'includes/navigation_demo.php';
?>

<div class="carrier-setup-container">
    <div class="carrier-setup-header">
        <h1 class="carrier-setup-title">Join as a Carrier</h1>
        <p class="carrier-setup-subtitle">
            Get started with MyDispatch and access premium loads, better rates, and 24/7 support.
        </p>
    </div>

    <div class="setup-steps">
        <div class="steps-header">
            <h2>Simple 3-Step Setup Process</h2>
            <p>Get up and running in minutes</p>
        </div>
        
        <div class="steps-grid">
            <div class="step-card">
                <div class="step-number">1</div>
                <h3>Create Account</h3>
                <p>Sign up with your basic information and verify your email address.</p>
                <ul>
                    <li>Company information</li>
                    <li>Contact details</li>
                    <li>Email verification</li>
                </ul>
            </div>
            
            <div class="step-card">
                <div class="step-number">2</div>
                <h3>Upload Documents</h3>
                <p>Submit required documents for verification and compliance.</p>
                <ul>
                    <li>MC/DOT numbers</li>
                    <li>Insurance certificates</li>
                    <li>Driver licenses</li>
                </ul>
            </div>
            
            <div class="step-card">
                <div class="step-number">3</div>
                <h3>Start Hauling</h3>
                <p>Get matched with premium loads and start earning immediately.</p>
                <ul>
                    <li>Load matching</li>
                    <li>Dispatch support</li>
                    <li>Payment processing</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="registration-form">
        <div class="form-card">
            <h2>Get Started Today</h2>
            <p>Fill out the form below to begin your carrier application</p>
            
            <form class="carrier-form">
                <div class="form-section">
                    <h3>Company Information</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Company Name *</label>
                            <input type="text" class="form-input" placeholder="Your Company Name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">MC Number</label>
                            <input type="text" class="form-input" placeholder="MC-123456">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">DOT Number</label>
                            <input type="text" class="form-input" placeholder="123456">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Years in Business</label>
                            <select class="form-input">
                                <option>Select years</option>
                                <option>Less than 1 year</option>
                                <option>1-2 years</option>
                                <option>3-5 years</option>
                                <option>5+ years</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>Contact Information</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Primary Contact *</label>
                            <input type="text" class="form-input" placeholder="Full Name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email Address *</label>
                            <input type="email" class="form-input" placeholder="email@company.com" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Phone Number *</label>
                            <input type="tel" class="form-input" placeholder="(555) 123-4567" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">City, State</label>
                            <input type="text" class="form-input" placeholder="Dallas, TX">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>Fleet Information</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Number of Trucks</label>
                            <select class="form-input">
                                <option>Select number</option>
                                <option>1-5 trucks</option>
                                <option>6-10 trucks</option>
                                <option>11-25 trucks</option>
                                <option>25+ trucks</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Equipment Type</label>
                            <select class="form-input">
                                <option>Select equipment</option>
                                <option>Dry Van</option>
                                <option>Flatbed</option>
                                <option>Refrigerated</option>
                                <option>Tanker</option>
                                <option>Container</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Operating Areas</label>
                        <textarea class="form-input" rows="3" placeholder="List the states or regions you typically operate in..."></textarea>
                    </div>
                </div>

                <div class="form-section">
                    <h3>Additional Information</h3>
                    <div class="form-group">
                        <label class="form-label">How did you hear about us?</label>
                        <select class="form-input">
                            <option>Select option</option>
                            <option>Google Search</option>
                            <option>Referral</option>
                            <option>Social Media</option>
                            <option>Trade Publication</option>
                            <option>Other</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Additional Comments</label>
                        <textarea class="form-input" rows="3" placeholder="Tell us anything else you'd like us to know..."></textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-paper-plane"></i>
                        Submit Application
                    </button>
                    <p class="form-note">
                        By submitting this form, you agree to our terms of service and privacy policy.
                    </p>
                </div>
            </form>
        </div>
    </div>

    <div class="benefits-section">
        <h2>Why Choose MyDispatch?</h2>
        <div class="benefits-grid">
            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <h4>Higher Rates</h4>
                <p>Access to premium freight with better rates than the open market.</p>
            </div>
            
            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h4>Fast Payment</h4>
                <p>Quick pay options and reliable payment processing within 24-48 hours.</p>
            </div>
            
            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h4>24/7 Support</h4>
                <p>Round-the-clock dispatch support and customer service.</p>
            </div>
            
            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="fas fa-route"></i>
                </div>
                <h4>Smart Matching</h4>
                <p>AI-powered load matching based on your preferences and history.</p>
            </div>
        </div>
    </div>
</div>

<style>
.carrier-setup-page {
    background: #0a0a0a;
    min-height: 100vh;
    padding-top: 2rem;
}

.carrier-setup-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.carrier-setup-header {
    text-align: center;
    margin-bottom: 4rem;
}

.carrier-setup-title {
    font-size: 3rem;
    font-weight: 800;
    background: linear-gradient(135deg, #ffffff 0%, #a855f7 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 1rem;
}

.carrier-setup-subtitle {
    font-size: 1.25rem;
    color: #a3a3a3;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

.setup-steps {
    margin-bottom: 4rem;
}

.steps-header {
    text-align: center;
    margin-bottom: 3rem;
}

.steps-header h2 {
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.steps-header p {
    color: #a3a3a3;
    font-size: 1.125rem;
}

.steps-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.step-card {
    background: rgba(23, 23, 23, 0.6);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 16px;
    padding: 2rem;
    text-align: center;
    position: relative;
}

.step-number {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 800;
    color: white;
    margin: 0 auto 1.5rem;
}

.step-card h3 {
    color: white;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.step-card p {
    color: #a3a3a3;
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.step-card ul {
    list-style: none;
    padding: 0;
    text-align: left;
}

.step-card li {
    color: #e5e5e5;
    margin-bottom: 0.5rem;
    padding-left: 1.5rem;
    position: relative;
}

.step-card li::before {
    content: '✓';
    color: #10b981;
    position: absolute;
    left: 0;
    font-weight: bold;
}

.registration-form {
    margin-bottom: 4rem;
}

.form-card {
    background: rgba(23, 23, 23, 0.6);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 16px;
    padding: 3rem;
}

.form-card h2 {
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    text-align: center;
}

.form-card p {
    color: #a3a3a3;
    text-align: center;
    margin-bottom: 3rem;
}

.carrier-form {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.form-section {
    border-bottom: 1px solid rgba(38, 38, 38, 0.8);
    padding-bottom: 2rem;
}

.form-section:last-child {
    border-bottom: none;
}

.form-section h3 {
    color: white;
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1rem;
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
    min-height: 100px;
}

.form-actions {
    text-align: center;
    margin-top: 2rem;
}

.btn-lg {
    padding: 16px 32px;
    font-size: 1.125rem;
    margin-bottom: 1rem;
}

.form-note {
    color: #a3a3a3;
    font-size: 0.875rem;
    margin: 0;
}

.benefits-section {
    text-align: center;
}

.benefits-section h2 {
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 3rem;
}

.benefits-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.benefit-item {
    background: rgba(23, 23, 23, 0.6);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
}

.benefit-item:hover {
    border-color: rgba(139, 92, 246, 0.5);
    transform: translateY(-2px);
}

.benefit-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    margin: 0 auto 1rem;
}

.benefit-item h4 {
    color: white;
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.benefit-item p {
    color: #a3a3a3;
    line-height: 1.6;
}

@media (max-width: 768px) {
    .carrier-setup-container {
        padding: 0 1rem;
    }
    
    .carrier-setup-title {
        font-size: 2rem;
    }
    
    .carrier-setup-subtitle {
        font-size: 1rem;
    }
    
    .steps-grid {
        grid-template-columns: 1fr;
    }
    
    .form-card {
        padding: 2rem 1.5rem;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .benefits-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php include 'includes/footer.php'; ?>
