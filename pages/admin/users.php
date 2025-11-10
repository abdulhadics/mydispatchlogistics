<?php
// Users management section
$db = getDB();
$users = [];

try {
    $stmt = $db->prepare("SELECT * FROM users ORDER BY created_at DESC LIMIT 50");
    $stmt->execute();
    $users = $stmt->fetchAll();
} catch (Exception $e) {
    $error = "Failed to load users: " . $e->getMessage();
}
?>

<div class="admin-section">
    <div class="section-header">
        <h2 class="section-title">
            <i class="fas fa-users"></i>
            User Management
        </h2>
        <button class="btn btn-primary" onclick="showAddUserModal()">
            <i class="fas fa-plus"></i>
            Add User
        </button>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span><?php echo htmlspecialchars($error); ?></span>
        </div>
    <?php endif; ?>

    <!-- Users Table -->
    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="7" class="text-center">No users found</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td>
                                <div class="user-info">
                                    <strong><?php echo htmlspecialchars($user['name']); ?></strong>
                                    <?php if ($user['company']): ?>
                                        <span class="user-company"><?php echo htmlspecialchars($user['company']); ?></span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td>
                                <span class="role-badge role-<?php echo $user['role']; ?>">
                                    <?php echo ucfirst($user['role']); ?>
                                </span>
                            </td>
                            <td>
                                <span class="status-badge status-<?php echo $user['status']; ?>">
                                    <?php echo ucfirst($user['status']); ?>
                                </span>
                            </td>
                            <td><?php echo date('M j, Y', strtotime($user['created_at'])); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-outline" onclick="editUser(<?php echo $user['id']; ?>)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteUser(<?php echo $user['id']; ?>)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add/Edit User Modal -->
<div id="userModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Add User</h3>
            <button class="modal-close" onclick="closeModal('userModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form id="userForm" class="modal-body">
            <input type="hidden" id="userId" name="user_id">
            
            <div class="form-row">
                <div class="form-group">
                    <label for="userName" class="form-label">Full Name</label>
                    <input type="text" id="userName" name="name" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label for="userEmail" class="form-label">Email</label>
                    <input type="email" id="userEmail" name="email" class="form-input" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="userRole" class="form-label">Role</label>
                    <select id="userRole" name="role" class="form-input" required>
                        <option value="">Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="driver">Driver</option>
                        <option value="customer">Customer</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="userStatus" class="form-label">Status</label>
                    <select id="userStatus" name="status" class="form-input" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="userPhone" class="form-label">Phone</label>
                <input type="tel" id="userPhone" name="phone" class="form-input">
            </div>
            
            <div class="form-group">
                <label for="userCompany" class="form-label">Company</label>
                <input type="text" id="userCompany" name="company" class="form-input">
            </div>
            
            <div class="form-group">
                <label for="userPassword" class="form-label">Password</label>
                <input type="password" id="userPassword" name="password" class="form-input">
                <small class="form-help">Leave blank to keep current password</small>
            </div>
        </form>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-outline" onclick="closeModal('userModal')">Cancel</button>
            <button type="submit" form="userForm" class="btn btn-primary">Save User</button>
        </div>
    </div>
</div>

<style>
.admin-section {
    width: 100%;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: white;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.table-container {
    overflow-x: auto;
    border-radius: 12px;
    border: 1px solid rgba(38, 38, 38, 0.8);
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
    background: rgba(23, 23, 23, 0.6);
}

.admin-table th,
.admin-table td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid rgba(38, 38, 38, 0.8);
}

.admin-table th {
    background: rgba(38, 38, 38, 0.8);
    color: white;
    font-weight: 600;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.admin-table td {
    color: #a3a3a3;
}

.admin-table tbody tr:hover {
    background: rgba(38, 38, 38, 0.3);
}

.user-info {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.user-company {
    font-size: 0.875rem;
    color: #737373;
}

.role-badge,
.status-badge {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.role-admin {
    background: rgba(239, 68, 68, 0.1);
    color: #fca5a5;
}

.role-driver {
    background: rgba(59, 130, 246, 0.1);
    color: #93c5fd;
}

.role-customer {
    background: rgba(16, 185, 129, 0.1);
    color: #6ee7b7;
}

.status-active {
    background: rgba(16, 185, 129, 0.1);
    color: #6ee7b7;
}

.status-inactive {
    background: rgba(107, 114, 128, 0.1);
    color: #9ca3af;
}

.status-pending {
    background: rgba(245, 158, 11, 0.1);
    color: #fcd34d;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.btn-sm {
    padding: 6px 12px;
    font-size: 0.875rem;
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(4px);
    z-index: 1000;
    align-items: center;
    justify-content: center;
}

.modal.active {
    display: flex;
}

.modal-content {
    background: rgba(23, 23, 23, 0.95);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 16px;
    width: 90%;
    max-width: 600px;
    max-height: 90vh;
    overflow-y: auto;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 2rem;
    border-bottom: 1px solid rgba(38, 38, 38, 0.8);
}

.modal-header h3 {
    color: white;
    font-size: 1.25rem;
    font-weight: 600;
}

.modal-close {
    background: none;
    border: none;
    color: #a3a3a3;
    font-size: 1.25rem;
    cursor: pointer;
    padding: 4px;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.modal-close:hover {
    background: rgba(38, 38, 38, 0.8);
    color: white;
}

.modal-body {
    padding: 2rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1rem;
}

.form-help {
    color: #737373;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    padding: 1.5rem 2rem;
    border-top: 1px solid rgba(38, 38, 38, 0.8);
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .section-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .modal-content {
        width: 95%;
        margin: 1rem;
    }
    
    .modal-header,
    .modal-body,
    .modal-footer {
        padding: 1rem;
    }
}
</style>

<script>
function showAddUserModal() {
    document.getElementById('modalTitle').textContent = 'Add User';
    document.getElementById('userForm').reset();
    document.getElementById('userId').value = '';
    document.getElementById('userModal').classList.add('active');
}

function editUser(userId) {
    // In a real implementation, you'd fetch user data via AJAX
    document.getElementById('modalTitle').textContent = 'Edit User';
    document.getElementById('userId').value = userId;
    document.getElementById('userModal').classList.add('active');
    
    // Pre-populate form with user data
    // This would be done via AJAX call to get user details
}

function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        // In a real implementation, you'd make an AJAX call to delete the user
        showAlert('User deleted successfully', 'success');
    }
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.remove('active');
}

// Handle form submission
document.getElementById('userForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const userId = formData.get('user_id');
    
    // In a real implementation, you'd make an AJAX call to save the user
    showAlert(userId ? 'User updated successfully' : 'User created successfully', 'success');
    closeModal('userModal');
});

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal')) {
        e.target.classList.remove('active');
    }
});
</script>
