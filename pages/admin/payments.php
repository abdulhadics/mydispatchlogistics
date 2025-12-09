<?php
// Payments management section
$db = getDB();
$payments = [];
$error = '';

try {
    $stmt = $db->prepare("
        SELECT p.*, 
               l.load_number,
               d.name as driver_name
        FROM payments p
        LEFT JOIN loads l ON p.load_id = l.id
        LEFT JOIN users d ON p.driver_id = d.id
        ORDER BY p.created_at DESC
        LIMIT 100
    ");
    $stmt->execute();
    $payments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $error = "Failed to load payments: " . $e->getMessage();
}
?>

<div class="admin-section">
    <div class="section-header">
        <h2 class="section-title">
            <i class="fas fa-credit-card"></i>
            Payment Management
        </h2>
        <button class="btn btn-primary" onclick="showAddPaymentModal()">
            <i class="fas fa-plus"></i>
            Add Payment
        </button>
    </div>

    <?php if ($error): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span><?php echo htmlspecialchars($error); ?></span>
        </div>
    <?php endif; ?>

    <!-- Payments Table -->
    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Load #</th>
                    <th>Driver</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($payments)): ?>
                    <tr>
                        <td colspan="8" class="text-center">No payments found</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($payments as $payment): ?>
                        <tr>
                            <td><?php echo $payment['id']; ?></td>
                            <td><?php echo htmlspecialchars($payment['load_number'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($payment['driver_name'] ?? 'N/A'); ?></td>
                            <td><strong><?php echo formatCurrency($payment['amount']); ?></strong></td>
                            <td>
                                <span class="type-badge type-<?php echo $payment['payment_type']; ?>">
                                    <?php echo ucfirst($payment['payment_type']); ?>
                                </span>
                            </td>
                            <td>
                                <span class="status-badge status-<?php echo $payment['status']; ?>">
                                    <?php echo ucfirst($payment['status']); ?>
                                </span>
                            </td>
                            <td><?php echo date('M j, Y', strtotime($payment['created_at'])); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-outline" onclick="editPayment(<?php echo $payment['id']; ?>)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary"
                                        onclick="processPayment(<?php echo $payment['id']; ?>)">
                                        <i class="fas fa-check"></i>
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



<script>
    function showAddPaymentModal() {
        alert('Add Payment functionality - To be implemented with backend API');
    }

    function editPayment(paymentId) {
        alert('Edit Payment ' + paymentId + ' - To be implemented with backend API');
    }

    function processPayment(paymentId) {
        if (confirm('Mark this payment as completed?')) {
            alert('Process Payment ' + paymentId + ' - To be implemented with backend API');
        }
    }
</script>