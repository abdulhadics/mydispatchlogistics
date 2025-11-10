<?php
// Messages management section
$db = getDB();
$messages = [];
$error = '';

try {
    $stmt = $db->prepare("
        SELECT m.*, 
               s.name as sender_name,
               s.email as sender_email,
               r.name as recipient_name,
               r.email as recipient_email
        FROM messages m
        LEFT JOIN users s ON m.sender_id = s.id
        LEFT JOIN users r ON m.recipient_id = r.id
        ORDER BY m.created_at DESC
        LIMIT 100
    ");
    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $error = "Failed to load messages: " . $e->getMessage();
}
?>

<div class="admin-section">
    <div class="section-header">
        <h2 class="section-title">
            <i class="fas fa-envelope"></i>
            Message Management
        </h2>
    </div>

    <?php if ($error): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span><?php echo htmlspecialchars($error); ?></span>
        </div>
    <?php endif; ?>

    <!-- Messages Table -->
    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Read</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($messages)): ?>
                    <tr>
                        <td colspan="8" class="text-center">No messages found</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($messages as $message): ?>
                        <tr class="<?php echo $message['is_read'] ? '' : 'unread'; ?>">
                            <td><?php echo $message['id']; ?></td>
                            <td>
                                <div class="user-info">
                                    <div><?php echo htmlspecialchars($message['sender_name'] ?? 'N/A'); ?></div>
                                    <div class="user-email"><?php echo htmlspecialchars($message['sender_email'] ?? ''); ?></div>
                                </div>
                            </td>
                            <td>
                                <div class="user-info">
                                    <div><?php echo htmlspecialchars($message['recipient_name'] ?? 'N/A'); ?></div>
                                    <div class="user-email"><?php echo htmlspecialchars($message['recipient_email'] ?? ''); ?></div>
                                </div>
                            </td>
                            <td><?php echo htmlspecialchars($message['subject'] ?? 'No subject'); ?></td>
                            <td>
                                <div class="message-preview">
                                    <?php echo htmlspecialchars(substr($message['message'], 0, 50)); ?>
                                    <?php echo strlen($message['message']) > 50 ? '...' : ''; ?>
                                </div>
                            </td>
                            <td>
                                <?php if ($message['is_read']): ?>
                                    <span class="read-badge read">Read</span>
                                <?php else: ?>
                                    <span class="read-badge unread">Unread</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo date('M j, Y H:i', strtotime($message['created_at'])); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-outline" onclick="viewMessage(<?php echo $message['id']; ?>)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteMessage(<?php echo $message['id']; ?>)">
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
.unread {
    background: rgba(139, 92, 246, 0.05);
}

.user-info {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.user-email {
    font-size: 0.875rem;
    color: #737373;
}

.message-preview {
    max-width: 200px;
    font-size: 0.875rem;
    color: #a3a3a3;
}

.read-badge {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 500;
}

.read-badge.read {
    background: rgba(16, 185, 129, 0.1);
    color: #6ee7b7;
}

.read-badge.unread {
    background: rgba(139, 92, 246, 0.1);
    color: #c4b5fd;
}
</style>

<script>
function viewMessage(messageId) {
    alert('View Message ' + messageId + ' - To be implemented with modal');
}

function deleteMessage(messageId) {
    if (confirm('Are you sure you want to delete this message?')) {
        alert('Delete Message ' + messageId + ' - To be implemented with backend API');
    }
}
</script>

