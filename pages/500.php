<?php
$page_title = 'Server Error - MyDispatch';
$page_description = 'An internal server error occurred. Please try again later.';
$body_class = 'error-page';

include 'includes/header.php';
?>

<div class="error-container">
    <div class="error-content">
        <div class="error-icon">
            <i class="fas fa-server"></i>
        </div>
        
        <h1 class="error-title">500</h1>
        <h2 class="error-subtitle">Internal Server Error</h2>
        
        <p class="error-message">
            Something went wrong on our end. We're working to fix this issue.
            Please try again in a few minutes.
        </p>
        
        <div class="error-actions">
            <a href="?page=home" class="btn btn-primary">
                <i class="fas fa-home"></i>
                Go Home
            </a>
            <a href="javascript:location.reload()" class="btn btn-outline">
                <i class="fas fa-redo"></i>
                Try Again
            </a>
        </div>
        
        <div class="error-help">
            <h3>What can you do?</h3>
            <ul>
                <li>Wait a few minutes and try again</li>
                <li>Check if the problem persists</li>
                <li>Contact our support team if the issue continues</li>
                <li>Try accessing a different page</li>
            </ul>
        </div>
        
        <div class="error-contact">
            <p>Still having issues?</p>
            <a href="?page=contact" class="btn btn-secondary">
                <i class="fas fa-envelope"></i>
                Contact Support
            </a>
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
        radial-gradient(circle at 20% 20%, rgba(239, 68, 68, 0.1) 0%, transparent 40%),
        radial-gradient(circle at 80% 80%, rgba(239, 68, 68, 0.05) 0%, transparent 40%);
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
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: white;
    margin: 0 auto 2rem;
    box-shadow: 0 20px 40px rgba(239, 68, 68, 0.3);
}

.error-title {
    font-size: 6rem;
    font-weight: 900;
    background: linear-gradient(135deg, #ffffff 0%, #ef4444 100%);
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

.error-help,
.error-contact {
    background: rgba(23, 23, 23, 0.6);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    text-align: left;
}

.error-help h3,
.error-contact p {
    color: white;
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1rem;
    text-align: center;
}

.error-help ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.error-help li {
    color: #a3a3a3;
    margin-bottom: 0.75rem;
    padding-left: 1.5rem;
    position: relative;
}

.error-help li::before {
    content: '•';
    color: #ef4444;
    position: absolute;
    left: 0;
}

.error-contact {
    text-align: center;
}

.error-contact p {
    margin-bottom: 1rem;
    color: #a3a3a3;
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
    
    .error-help,
    .error-contact {
        padding: 1.5rem;
    }
}
</style>

<?php include 'includes/footer.php'; ?>
