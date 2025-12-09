# MyDispatch Logistics - System Architecture & Functionality Breakdown

## 1. System Overview
MyDispatch is a comprehensive logistics management platform designed to connect Shippers (Customers), Carriers (Drivers), and Dispatchers (Admins). The system facilitates load creation, assignment, tracking, and payment processing within a unified dashboard environment.

---

## 2. User Roles & Relationships

### 👑 Admin (Dispatcher/Manager)
*   **Access Level**: Full System Access
*   **Key Responsibilities**:
    *   **User Management**: Create, edit, delete, and approve Users (Drivers/Customers).
    *   **Load Management**: Assign Drivers to Customer Loads.
    *   **System Configuration**: Manage Categories and Business Rules.
    *   **Oversight**: View global analytics (Revenue, Total Loads, Active Users).
*   **Database Relationships**:
    *   `hasMany` **Rules** (created_by)
    *   `hasMany` **Loads** (as dispatcher_id)

### 🏢 Customer (Shipper)
*   **Access Level**: Restricted (Own Data Only)
*   **Key Responsibilities**:
    *   **Load Creation**: Request new shipments.
    *   **Tracking**: Monitor status of their own goods.
    *   **History**: View past shipments and costs.
*   **Database Relationships**:
    *   `hasMany` **Loads** (as customer_id)
    *   `hasMany` **SentMessages** / **ReceivedMessages**

### 🚚 Driver (Carrier)
*   **Access Level**: Restricted (Own Assignments Only)
*   **Key Responsibilities**:
    *   **Load Execution**: Accept and deliver assigned loads.
    *   **Fleet Management**: Manage their Vehicles.
    *   **Earnings**: View Payments and Revenue.
*   **Database Relationships**:
    *   `hasMany` **Loads** (as driver_id)
    *   `hasMany` **Vehicles** (as owner_id)
    *   `hasMany` **Payments** (as driver_id)

---

## 3. Core Functionalities & Modules

### A. Dashboard Module (`DashboardController`)
*   **Dynamic Routing**: Serves different views based on User Role.
*   **Admin View**:
    *   Real-time stats: Total Users, Active Loads, Revenue, Active Rules.
    *   Quick Actions: Manage Users, Categories, Rules.
    *   Analytics: Users by Role, Loads by Status.
*   **Driver View**:
    *   Active Load status.
    *   Recent Payments.
    *   Vehicle status.
*   **Customer View**:
    *   Active Shipment tracking.
    *   Recent Load history.

### B. Load Management (`LoadController`)
*   **CRUD Operations**: Create, Read, Update, Delete loads.
*   **Status Workflow**: `Pending` -> `Dispatched` -> `In Transit` -> `Delivered`.
*   **Assignment**: Links a `Customer` (Owner) with a `Driver` (Carrier) and `Admin` (Dispatcher).

### C. Admin Tools
*   **User Management** (`UserController`):
    *   Full CRUD for system users.
    *   Role assignment and status control (Active/Inactive).
*   **Rules Engine** (`RuleController`):
    *   Define business logic (Safety, Compliance, Operational).
    *   Set severity levels (Low, Medium, High, Critical).
*   **Category Management** (`CategoryController`):
    *   Manage service types (FTL, LTL, Refrigerated, etc.).

### D. Notification System
*   **Real-time Alerts**: Bell icon with unread count.
*   **Poling**: Auto-fetches new notifications every 30 seconds.
*   **Types**: Success, Warning, Error, Info.
*   **Toast Messages**: Immediate feedback for user actions.

### E. Tracking System (`TrackingController`)
*   **Integration**: Connects to Shippo API (or fallback to USPS).
*   **Public Access**: Allows tracking without login via Tracking Number.
*   **Visual Timeline**: Shows shipment history and current status.

---

## 4. Database Schema & Relationships

### Users Table
| Column | Type | Description |
|--------|------|-------------|
| `id` | PK | Unique User ID |
| `role` | Enum | 'admin', 'customer', 'driver' |
| `company` | String | Business Name |
| `mc_number` | String | Motor Carrier Number (for Drivers) |

### Loads Table
| Column | Type | Relationship | Description |
|--------|------|--------------|-------------|
| `id` | PK | - | Load ID |
| `customer_id` | FK | `belongsTo User` | Who owns the freight |
| `driver_id` | FK | `belongsTo User` | Who is moving it |
| `dispatcher_id`| FK | `belongsTo User` | Who assigned it |
| `status` | Enum | - | Current state |

### Rules Table
| Column | Type | Relationship | Description |
|--------|------|--------------|-------------|
| `id` | PK | - | Rule ID |
| `created_by` | FK | `belongsTo User` | Admin who created it |
| `type` | Enum | - | Safety, Compliance, etc. |

### Notifications Table
| Column | Type | Relationship | Description |
|--------|------|--------------|-------------|
| `id` | PK | - | Notification ID |
| `user_id` | FK | `belongsTo User` | Recipient |
| `read_at` | Timestamp| - | Read status |

---

## 5. Code Structure

### Controllers (`app/Http/Controllers`)
*   `DashboardController`: Main entry point for authenticated users.
*   `LoadController`: Core logistics logic.
*   `UserController`: Admin user management.
*   `RuleController`: Admin business rules.
*   `CategoryController`: Admin service categories.
*   `TrackingController`: Public tracking page logic.
*   `NotificationController`: API endpoints for notification polling.

### Views (`resources/views`)
*   `layouts/`: Master templates (`app.blade.php`, `guest.blade.php`).
*   `admin/`: Admin-specific pages (`users`, `rules`, `categories`).
*   `loads/`: Load management forms and lists.
*   `dashboard.blade.php`: Role-based dashboard UI.

### Assets
*   `public/assets/css/style.css`: Custom styling (Dark mode aesthetic).
*   `public/assets/js/main.js`: Global JS, Modals, AJAX helpers.

---

## 6. Security & Best Practices
*   **Authentication**: Laravel Breeze (Guard-based auth).
*   **Authorization**: Role-based checks in Controllers (`if ($user->role === 'admin')`).
*   **Validation**: Strict Request validation for all forms.
*   **CSRF Protection**: Global CSRF token management for AJAX and Forms.
