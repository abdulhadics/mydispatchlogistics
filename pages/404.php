<?php
$page_title = 'Page Not Found - MyDispatch';
$page_description = 'The page you are looking for could not be found.';
$body_class = 'error-page';

include 'includes/header.php';
?>

<div class="error-container">
    <div class="error-content">
        <div class="error-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        
        <h1 class="error-title">404</h1>
        <h2 class="error-subtitle">Page Not Found</h2>
        
        <p class="error-message">
            Sorry, the page you are looking for doesn't exist or has been moved.
        </p>
        
        <div class="error-actions">
            <a href="?page=home" class="btn btn-primary">
                <i class="fas fa-home"></i>
                Go Home
            </a>
            <a href="javascript:history.back()" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i>
                Go Back
            </a>
        </div>
        
        <div class="error-suggestions">
            <h3>Popular Pages:</h3>
            <ul>
                <li><a href="?page=services">Our Services</a></li>
                <li><a href="?page=contact">Contact Us</a></li>
                <li><a href="?page=login">Sign In</a></li>
                <li><a href="?page=signup">Sign Up</a></li>
            </ul>
        </div>
    </div>
</div>

<style>
.error-page {
    background: #0a0a0a;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.error-page::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 20%, rgba(139, 92, 246, 0.1) 0%, transparent 40%),
        radial-gradient(circle at 80% 80%, rgba(139, 92, 246, 0.05) 0%, transparent 40%);
    pointer-events: none;
}

.error-container {
    position: relative;
    z-index: 2;
    text-align: center;
    max-width: 600px;
    padding: 2rem;
}

.error-icon {
    width: 120px;
    height: 120px;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: white;
    margin: 0 auto 2rem;
    box-shadow: 0 20px 40px rgba(139, 92, 246, 0.3);
}

.error-title {
    font-size: 6rem;
    font-weight: 900;
    background: linear-gradient(135deg, #ffffff 0%, #a855f7 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 1rem;
    line-height: 1;
}

.error-subtitle {
    font-size: 2rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
}

.error-message {
    font-size: 1.25rem;
    color: #a3a3a3;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.error-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-bottom: 3rem;
    flex-wrap: wrap;
}

.error-suggestions {
    background: rgba(23, 23, 23, 0.6);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 16px;
    padding: 2rem;
    text-align: left;
}

.error-suggestions h3 {
    color: white;
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1rem;
    text-align: center;
}

.error-suggestions ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.error-suggestions li {
    margin-bottom: 0.75rem;
}

.error-suggestions a {
    color: #a3a3a3;
    text-decoration: none;
    transition: color 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.error-suggestions a:hover {
    color: #a855f7;
}

.error-suggestions a::before {
    content: '→';
    color: #a855f7;
}

@media (max-width: 768px) {
    .error-container {
        padding: 1rem;
    }
    
    .error-title {
        font-size: 4rem;
    }
    
    .error-subtitle {
        font-size: 1.5rem;
    }
    
    .error-icon {
        width: 80px;
        height: 80px;
        font-size: 2rem;
    }
    
    .error-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .error-actions .btn {
        width: 100%;
        max-width: 300px;
    }
}
</style>

<?php include 'includes/footer.php'; ?>
