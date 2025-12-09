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
    document.getElementById('userForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        const userId = formData.get('user_id');

        // In a real implementation, you'd make an AJAX call to save the user
        showAlert(userId ? 'User updated successfully' : 'User created successfully', 'success');
        closeModal('userModal');
    });

    // Close modal when clicking outside
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('modal')) {
            e.target.classList.remove('active');
        }
    });
</script>