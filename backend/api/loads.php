<?php
// Load Management API
session_start();
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../functions/helpers_simple.php';

header('Content-Type: application/json');

// Require authentication
if (!isLoggedIn()) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$user = getUserInfo();
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

try {
    $db = getDB();
    
    switch ($method) {
        case 'GET':
            handleGetLoads($db, $user);
            break;
            
        case 'POST':
            handleCreateLoad($db, $input, $user);
            break;
            
        case 'PUT':
            handleUpdateLoad($db, $input, $user);
            break;
            
        case 'DELETE':
            handleDeleteLoad($db, $_GET['id'] ?? null, $user);
            break;
            
        default:
            throw new Exception('Method not allowed');
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

function handleGetLoads($db, $user) {
    $id = $_GET['id'] ?? null;
    
    if ($id) {
        // Get single load
        $sql = "SELECT l.*, 
                       c.name as customer_name, 
                       d.name as driver_name,
                       dis.name as dispatcher_name
                FROM loads l
                LEFT JOIN users c ON l.customer_id = c.id
                LEFT JOIN users d ON l.driver_id = d.id
                LEFT JOIN users dis ON l.dispatcher_id = dis.id
                WHERE l.id = ?";
        
        // Add role-based filtering
        if ($user['role'] === 'driver') {
            $sql .= " AND (l.driver_id = ? OR l.status = 'available')";
            $stmt = $db->prepare($sql);
            $stmt->execute([$id, $user['id']]);
        } elseif ($user['role'] === 'customer') {
            $sql .= " AND l.customer_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$id, $user['id']]);
        } else {
            $stmt = $db->prepare($sql);
            $stmt->execute([$id]);
        }
        
        $load = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$load) {
            throw new Exception('Load not found');
        }
        
        echo json_encode(['success' => true, 'load' => $load]);
    } else {
        // Get all loads with role-based filtering
        $limit = $_GET['limit'] ?? 100;
        $offset = $_GET['offset'] ?? 0;
        $status = $_GET['status'] ?? null;
        
        $sql = "SELECT l.*, 
                       c.name as customer_name, 
                       d.name as driver_name,
                       dis.name as dispatcher_name
                FROM loads l
                LEFT JOIN users c ON l.customer_id = c.id
                LEFT JOIN users d ON l.driver_id = d.id
                LEFT JOIN users dis ON l.dispatcher_id = dis.id
                WHERE 1=1";
        
        $params = [];
        
        // Role-based filtering
        if ($user['role'] === 'driver') {
            $sql .= " AND (l.driver_id = ? OR l.status = 'available')";
            $params[] = $user['id'];
        } elseif ($user['role'] === 'customer') {
            $sql .= " AND l.customer_id = ?";
            $params[] = $user['id'];
        }
        
        if ($status) {
            $sql .= " AND l.status = ?";
            $params[] = $status;
        }
        
        $sql .= " ORDER BY l.created_at DESC LIMIT ? OFFSET ?";
        $params[] = $limit;
        $params[] = $offset;
        
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $loads = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Get total count
        $countSql = "SELECT COUNT(*) as total FROM loads WHERE 1=1";
        $countParams = [];
        
        if ($user['role'] === 'driver') {
            $countSql .= " AND (driver_id = ? OR status = 'available')";
            $countParams[] = $user['id'];
        } elseif ($user['role'] === 'customer') {
            $countSql .= " AND customer_id = ?";
            $countParams[] = $user['id'];
        }
        
        if ($status) {
            $countSql .= " AND status = ?";
            $countParams[] = $status;
        }
        
        $countStmt = $db->prepare($countSql);
        $countStmt->execute($countParams);
        $total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
        
        echo json_encode(['success' => true, 'loads' => $loads, 'total' => $total]);
    }
}

function handleCreateLoad($db, $input, $user) {
    // Only admin and customers can create loads
    if ($user['role'] !== 'admin' && $user['role'] !== 'customer') {
        throw new Exception('Unauthorized to create loads');
    }
    
    $load_number = $input['load_number'] ?? 'LD-' . date('Ymd') . '-' . rand(1000, 9999);
    $pickup_location = $input['pickup_location'] ?? '';
    $delivery_location = $input['delivery_location'] ?? '';
    $pickup_date = $input['pickup_date'] ?? '';
    $delivery_date = $input['delivery_date'] ?? '';
    $weight = $input['weight'] ?? null;
    $miles = $input['miles'] ?? null;
    $rate = $input['rate'] ?? 0;
    $equipment_type = $input['equipment_type'] ?? '';
    $special_requirements = $input['special_requirements'] ?? '';
    $customer_id = $user['role'] === 'customer' ? $user['id'] : ($input['customer_id'] ?? null);
    $dispatcher_id = $user['role'] === 'admin' ? $user['id'] : null;
    
    if (empty($pickup_location) || empty($delivery_location) || empty($pickup_date) || empty($delivery_date)) {
        throw new Exception('Pickup location, delivery location, and dates are required');
    }
    
    if ($rate <= 0) {
        throw new Exception('Rate must be greater than 0');
    }
    
    // Check if load number already exists
    $stmt = $db->prepare("SELECT id FROM loads WHERE load_number = ?");
    $stmt->execute([$load_number]);
    if ($stmt->fetch()) {
        $load_number = 'LD-' . date('Ymd') . '-' . rand(1000, 9999);
    }
    
    $stmt = $db->prepare("INSERT INTO loads (load_number, pickup_location, delivery_location, pickup_date, delivery_date, weight, miles, rate, equipment_type, special_requirements, customer_id, dispatcher_id, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'available', NOW())");
    $result = $stmt->execute([$load_number, $pickup_location, $delivery_location, $pickup_date, $delivery_date, $weight, $miles, $rate, $equipment_type, $special_requirements, $customer_id, $dispatcher_id]);
    
    if ($result) {
        $loadId = $db->lastInsertId();
        echo json_encode(['success' => true, 'message' => 'Load created successfully', 'load_id' => $loadId]);
    } else {
        throw new Exception('Failed to create load');
    }
}

function handleUpdateLoad($db, $input, $user) {
    $id = $input['id'] ?? null;
    
    if (!$id) {
        throw new Exception('Load ID is required');
    }
    
    // Check if load exists and user has permission
    $stmt = $db->prepare("SELECT * FROM loads WHERE id = ?");
    $stmt->execute([$id]);
    $load = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$load) {
        throw new Exception('Load not found');
    }
    
    // Permission check
    if ($user['role'] !== 'admin' && $load['customer_id'] != $user['id'] && $load['driver_id'] != $user['id']) {
        throw new Exception('Unauthorized to update this load');
    }
    
    $updates = [];
    $params = [];
    
    // Drivers can only update status and assign themselves
    if ($user['role'] === 'driver') {
        if (isset($input['status'])) {
            $updates[] = "status = ?";
            $params[] = $input['status'];
        }
        if (isset($input['assign_to_me']) && $input['assign_to_me']) {
            $updates[] = "driver_id = ?";
            $updates[] = "status = 'assigned'";
            $params[] = $user['id'];
        }
    } else {
        // Admin and customers can update all fields
        if (isset($input['pickup_location'])) {
            $updates[] = "pickup_location = ?";
            $params[] = $input['pickup_location'];
        }
        if (isset($input['delivery_location'])) {
            $updates[] = "delivery_location = ?";
            $params[] = $input['delivery_location'];
        }
        if (isset($input['pickup_date'])) {
            $updates[] = "pickup_date = ?";
            $params[] = $input['pickup_date'];
        }
        if (isset($input['delivery_date'])) {
            $updates[] = "delivery_date = ?";
            $params[] = $input['delivery_date'];
        }
        if (isset($input['weight'])) {
            $updates[] = "weight = ?";
            $params[] = $input['weight'];
        }
        if (isset($input['miles'])) {
            $updates[] = "miles = ?";
            $params[] = $input['miles'];
        }
        if (isset($input['rate'])) {
            $updates[] = "rate = ?";
            $params[] = $input['rate'];
        }
        if (isset($input['equipment_type'])) {
            $updates[] = "equipment_type = ?";
            $params[] = $input['equipment_type'];
        }
        if (isset($input['special_requirements'])) {
            $updates[] = "special_requirements = ?";
            $params[] = $input['special_requirements'];
        }
        if (isset($input['status'])) {
            $updates[] = "status = ?";
            $params[] = $input['status'];
        }
        if (isset($input['driver_id'])) {
            $updates[] = "driver_id = ?";
            $params[] = $input['driver_id'];
        }
    }
    
    if (empty($updates)) {
        throw new Exception('No fields to update');
    }
    
    $updates[] = "updated_at = NOW()";
    $params[] = $id;
    
    $sql = "UPDATE loads SET " . implode(', ', $updates) . " WHERE id = ?";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute($params);
    
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Load updated successfully']);
    } else {
        throw new Exception('Failed to update load');
    }
}

function handleDeleteLoad($db, $id, $user) {
    if (!$id) {
        throw new Exception('Load ID is required');
    }
    
    // Only admin can delete loads
    if ($user['role'] !== 'admin') {
        throw new Exception('Unauthorized to delete loads');
    }
    
    $stmt = $db->prepare("DELETE FROM loads WHERE id = ?");
    $result = $stmt->execute([$id]);
    
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Load deleted successfully']);
    } else {
        throw new Exception('Failed to delete load');
    }
}
?>

