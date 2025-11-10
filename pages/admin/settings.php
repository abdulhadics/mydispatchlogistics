<?php
// Settings management section
$db = getDB();
$settings = [];
$error = '';
$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_settings'])) {
    try {
        foreach ($_POST['settings'] as $key => $value) {
            $stmt = $db->prepare("
                INSERT INTO settings (setting_key, setting_value, updated_at) 
                VALUES (?, ?, NOW())
                ON DUPLICATE KEY UPDATE setting_value = ?, updated_at = NOW()
            ");
            $stmt->execute([$key, $value, $value]);
        }
        $success = 'Settings updated successfully!';
    } catch (Exception $e) {
        $error = "Failed to update settings: " . $e->getMessage();
    }
}

try {
    $stmt = $db->prepare("SELECT * FROM settings ORDER BY setting_key");
    $stmt->execute();
    $settings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Convert to key-value array
    $settingsArray = [];
    foreach ($settings as $setting) {
        $settingsArray[$setting['setting_key']] = $setting;
    }
} catch (Exception $e) {
    $error = "Failed to load settings: " . $e->getMessage();
}
?>

<div class="admin-section">
    <div class="section-header">
        <h2 class="section-title">
            <i class="fas fa-cog"></i>
            System Settings
        </h2>
    </div>

    <?php if ($success): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span><?php echo htmlspecialchars($success); ?></span>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span><?php echo htmlspecialchars($error); ?></span>
        </div>
    <?php endif; ?>

    <!-- Settings Form -->
    <form method="POST" class="settings-form">
        <input type="hidden" name="update_settings" value="1">
        
        <div class="settings-group">
            <h3 class="settings-group-title">General Settings</h3>
            
            <div class="form-group">
                <label for="site_name" class="form-label">Site Name</label>
                <input 
                    type="text" 
                    id="site_name" 
                    name="settings[site_name]" 
                    class="form-input" 
                    value="<?php echo htmlspecialchars($settingsArray['site_name']['setting_value'] ?? 'MyDispatch Logistics'); ?>"
                >
            </div>
            
            <div class="form-group">
                <label for="site_email" class="form-label">Contact Email</label>
                <input 
                    type="email" 
                    id="site_email" 
                    name="settings[site_email]" 
                    class="form-input" 
                    value="<?php echo htmlspecialchars($settingsArray['site_email']['setting_value'] ?? 'info@mydispatch.com'); ?>"
                >
            </div>
            
            <div class="form-group">
                <label for="site_phone" class="form-label">Contact Phone</label>
                <input 
                    type="tel" 
                    id="site_phone" 
                    name="settings[site_phone]" 
                    class="form-input" 
                    value="<?php echo htmlspecialchars($settingsArray['site_phone']['setting_value'] ?? '+1 (555) 123-4567'); ?>"
                >
            </div>
        </div>

        <div class="settings-group">
            <h3 class="settings-group-title">Business Settings</h3>
            
            <div class="form-group">
                <label for="currency" class="form-label">Default Currency</label>
                <select id="currency" name="settings[currency]" class="form-input">
                    <option value="USD" <?php echo ($settingsArray['currency']['setting_value'] ?? 'USD') === 'USD' ? 'selected' : ''; ?>>USD ($)</option>
                    <option value="EUR" <?php echo ($settingsArray['currency']['setting_value'] ?? '') === 'EUR' ? 'selected' : ''; ?>>EUR (€)</option>
                    <option value="GBP" <?php echo ($settingsArray['currency']['setting_value'] ?? '') === 'GBP' ? 'selected' : ''; ?>>GBP (£)</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="timezone" class="form-label">Timezone</label>
                <select id="timezone" name="settings[timezone]" class="form-input">
                    <option value="America/New_York" <?php echo ($settingsArray['timezone']['setting_value'] ?? 'America/New_York') === 'America/New_York' ? 'selected' : ''; ?>>Eastern Time (ET)</option>
                    <option value="America/Chicago" <?php echo ($settingsArray['timezone']['setting_value'] ?? '') === 'America/Chicago' ? 'selected' : ''; ?>>Central Time (CT)</option>
                    <option value="America/Denver" <?php echo ($settingsArray['timezone']['setting_value'] ?? '') === 'America/Denver' ? 'selected' : ''; ?>>Mountain Time (MT)</option>
                    <option value="America/Los_Angeles" <?php echo ($settingsArray['timezone']['setting_value'] ?? '') === 'America/Los_Angeles' ? 'selected' : ''; ?>>Pacific Time (PT)</option>
                </select>
            </div>
        </div>

        <div class="settings-group">
            <h3 class="settings-group-title">System Settings</h3>
            
            <div class="form-group">
                <label for="maintenance_mode" class="form-label">Maintenance Mode</label>
                <select id="maintenance_mode" name="settings[maintenance_mode]" class="form-input">
                    <option value="false" <?php echo ($settingsArray['maintenance_mode']['setting_value'] ?? 'false') === 'false' ? 'selected' : ''; ?>>Disabled</option>
                    <option value="true" <?php echo ($settingsArray['maintenance_mode']['setting_value'] ?? '') === 'true' ? 'selected' : ''; ?>>Enabled</option>
                </select>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Save Settings
            </button>
            <button type="reset" class="btn btn-outline">
                <i class="fas fa-undo"></i>
                Reset
            </button>
        </div>
    </form>
</div>

<style>
.settings-form {
    max-width: 800px;
}

.settings-group {
    background: rgba(38, 38, 38, 0.5);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2rem;
}

.settings-group-title {
    color: white;
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(38, 38, 38, 0.8);
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    color: #a3a3a3;
    font-size: 0.875rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.form-input {
    width: 100%;
    padding: 12px 16px;
    background: rgba(23, 23, 23, 0.6);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 8px;
    color: white;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-input:focus {
    outline: none;
    border-color: #a855f7;
    background: rgba(23, 23, 23, 0.8);
}

.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
}

.alert-success {
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.3);
    color: #6ee7b7;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}
</style>

