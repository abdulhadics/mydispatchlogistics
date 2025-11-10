<?php
// Vehicles management section
$db = getDB();
$vehicles = [];
$error = '';

try {
    $stmt = $db->prepare("
        SELECT v.*, u.name as owner_name, u.email as owner_email
        FROM vehicles v
        LEFT JOIN users u ON v.owner_id = u.id
        ORDER BY v.created_at DESC
        LIMIT 100
    ");
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $error = "Failed to load vehicles: " . $e->getMessage();
}
?>

<div class="admin-section">
    <div class="section-header">
        <h2 class="section-title">
            <i class="fas fa-car"></i>
            Vehicle Management
        </h2>
        <button class="btn btn-primary" onclick="showAddVehicleModal()">
            <i class="fas fa-plus"></i>
            Add Vehicle
        </button>
    </div>

    <?php if ($error): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span><?php echo htmlspecialchars($error); ?></span>
        </div>
    <?php endif; ?>

    <!-- Vehicles Table -->
    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vehicle Info</th>
                    <th>Owner</th>
                    <th>Type</th>
                    <th>License Plate</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($vehicles)): ?>
                    <tr>
                        <td colspan="7" class="text-center">No vehicles found</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($vehicles as $vehicle): ?>
                        <tr>
                            <td><?php echo $vehicle['id']; ?></td>
                            <td>
                                <div class="vehicle-info">
                                    <strong><?php echo htmlspecialchars($vehicle['make'] . ' ' . $vehicle['model']); ?></strong>
                                    <span class="vehicle-year"><?php echo $vehicle['year']; ?></span>
                                </div>
                            </td>
                            <td>
                                <div class="owner-info">
                                    <div><?php echo htmlspecialchars($vehicle['owner_name'] ?? 'N/A'); ?></div>
                                    <div class="owner-email"><?php echo htmlspecialchars($vehicle['owner_email'] ?? ''); ?></div>
                                </div>
                            </td>
                            <td>
                                <span class="type-badge">
                                    <?php echo ucfirst($vehicle['vehicle_type']); ?>
                                </span>
                            </td>
                            <td><?php echo htmlspecialchars($vehicle['license_plate'] ?? 'N/A'); ?></td>
                            <td>
                                <span class="status-badge status-<?php echo str_replace('_', '-', $vehicle['status']); ?>">
                                    <?php echo ucfirst(str_replace('_', ' ', $vehicle['status'])); ?>
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-outline" onclick="editVehicle(<?php echo $vehicle['id']; ?>)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteVehicle(<?php echo $vehicle['id']; ?>)">
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

<style>
.vehicle-info {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.vehicle-year {
    font-size: 0.875rem;
    color: #737373;
}

.owner-info {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.owner-email {
    font-size: 0.875rem;
    color: #737373;
}

.status-available {
    background: rgba(16, 185, 129, 0.1);
    color: #6ee7b7;
}

.status-in-use {
    background: rgba(59, 130, 246, 0.1);
    color: #93c5fd;
}

.status-maintenance {
    background: rgba(245, 158, 11, 0.1);
    color: #fcd34d;
}

.status-out-of-service {
    background: rgba(239, 68, 68, 0.1);
    color: #fca5a5;
}
</style>

<script>
function showAddVehicleModal() {
    alert('Add Vehicle functionality - To be implemented with backend API');
}

function editVehicle(vehicleId) {
    alert('Edit Vehicle ' + vehicleId + ' - To be implemented with backend API');
}

function deleteVehicle(vehicleId) {
    if (confirm('Are you sure you want to delete this vehicle?')) {
        alert('Delete Vehicle ' + vehicleId + ' - To be implemented with backend API');
    }
}
</script>

