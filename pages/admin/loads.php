<?php
// Loads management section
$db = getDB();
$loads = [];
$error = '';

try {
    $stmt = $db->prepare("
        SELECT l.*, 
               c.name as customer_name, 
               d.name as driver_name,
               dis.name as dispatcher_name
        FROM loads l
        LEFT JOIN users c ON l.customer_id = c.id
        LEFT JOIN users d ON l.driver_id = d.id
        LEFT JOIN users dis ON l.dispatcher_id = dis.id
        ORDER BY l.created_at DESC
        LIMIT 100
    ");
    $stmt->execute();
    $loads = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $error = "Failed to load loads: " . $e->getMessage();
}
?>

<div class="admin-section">
    <div class="section-header">
        <h2 class="section-title">
            <i class="fas fa-truck"></i>
            Load Management
        </h2>
        <button class="btn btn-primary" onclick="showAddLoadModal()">
            <i class="fas fa-plus"></i>
            Add Load
        </button>
    </div>

    <?php if ($error): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span><?php echo htmlspecialchars($error); ?></span>
        </div>
    <?php endif; ?>

    <!-- Loads Table -->
    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Load #</th>
                    <th>Route</th>
                    <th>Dates</th>
                    <th>Rate</th>
                    <th>Status</th>
                    <th>Customer</th>
                    <th>Driver</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($loads)): ?>
                    <tr>
                        <td colspan="8" class="text-center">No loads found</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($loads as $load): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($load['load_number']); ?></strong></td>
                            <td>
                                <div class="route-info">
                                    <div class="route-from"><?php echo htmlspecialchars($load['pickup_location']); ?></div>
                                    <i class="fas fa-arrow-right"></i>
                                    <div class="route-to"><?php echo htmlspecialchars($load['delivery_location']); ?></div>
                                </div>
                            </td>
                            <td>
                                <div class="date-info">
                                    <div>Pickup: <?php echo date('M j, Y', strtotime($load['pickup_date'])); ?></div>
                                    <div>Delivery: <?php echo date('M j, Y', strtotime($load['delivery_date'])); ?></div>
                                </div>
                            </td>
                            <td><strong><?php echo formatCurrency($load['rate']); ?></strong></td>
                            <td>
                                <span class="status-badge status-<?php echo $load['status']; ?>">
                                    <?php echo ucfirst(str_replace('_', ' ', $load['status'])); ?>
                                </span>
                            </td>
                            <td><?php echo htmlspecialchars($load['customer_name'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($load['driver_name'] ?? 'Unassigned'); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-outline" onclick="editLoad(<?php echo $load['id']; ?>)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteLoad(<?php echo $load['id']; ?>)">
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



<script>
    function showAddLoadModal() {
        alert('Add Load functionality - To be implemented with backend API');
    }

    function editLoad(loadId) {
        alert('Edit Load ' + loadId + ' - To be implemented with backend API');
    }

    function deleteLoad(loadId) {
        if (confirm('Are you sure you want to delete this load?')) {
            alert('Delete Load ' + loadId + ' - To be implemented with backend API');
        }
    }
</script>