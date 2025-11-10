# MyDispatch Logistics - PHP Version

A professional truck dispatch and logistics management system built with HTML, CSS, PHP, and MySQL. 

## 🚛 Features

- **Modern Dark Theme Design** - Professional, responsive UI with dark theme
- **User Authentication** - Secure login/signup with role-based access
- **Admin Dashboard** - Complete admin panel for managing users and operations
- **Contact System** - Contact form with database storage
- **Responsive Design** - Mobile-first responsive design
- **Database Integration** - MySQL database with proper schema
- **Security Features** - CSRF protection, password hashing, input validation

## 🛠️ Technology Stack

- **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+
- **Styling**: Custom CSS with modern features (Grid, Flexbox, Animations)
- **Icons**: Font Awesome 6
- **Fonts**: Inter (Google Fonts)

## 📋 Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- Modern web browser

## 🚀 Installation

### 1. Clone/Download the Project

```bash
git clone https://github.com/abdulhadics/mydispatchphp.git
cd mydispatchphp
```

### 2. Database Setup

1. Create a MySQL database:
```sql
CREATE DATABASE logistics_db;
```

2. Import the database schema:
```bash
mysql -u your_username -p logistics_db < database/schema.sql
```

### 3. Configuration

1. Copy the config file and update database credentials:
```bash
cp config/config.example.php config/config.php
```

2. Edit `config/config.php`:
```php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'logistics_db');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');

// Application URL
define('APP_URL', 'http://localhost/your-project-folder');
```

### 4. Web Server Setup

#### Using XAMPP/WAMP/MAMP:
1. Copy the project folder to your web server directory
2. Start Apache and MySQL services
3. Access via: `http://localhost/htmlstore-truck-php`

#### Using PHP Built-in Server:
```bash
php -S localhost:8000
```
Access via: `http://localhost:8000`

## 👥 User Roles & Demo Accounts

### Demo Accounts (Built-in)
- **Admin**: `admin@logistics.com` / `admin123`
- **Driver**: `driver@example.com` / `driver123`
- **Customer**: `customer@example.com` / `customer123`

### User Roles
- **Admin**: Full access to admin panel, user management, system settings
- **Driver**: Access to driver dashboard, load management, tracking
- **Customer**: Access to customer portal, shipment tracking, payments

## 📁 Project Structure

```
htmlstore-truck-php/
├── assets/
│   ├── css/
│   │   ├── style.css          # Main stylesheet
│   │   └── responsive.css     # Responsive design
│   ├── js/
│   │   ├── main.js           # Main JavaScript
│   │   └── auth.js           # Authentication functions
│   └── images/               # Static images
├── config/
│   ├── config.php            # Application configuration
│   └── database.php          # Database connection
├── database/
│   └── schema.sql            # Database schema
├── functions/
│   ├── auth.php              # Authentication handler
│   └── logout.php            # Logout handler
├── includes/
│   ├── header.php            # Page header
│   ├── footer.php            # Page footer
│   └── navigation.php        # Navigation menu
├── pages/
│   ├── home.php              # Homepage
│   ├── login.php             # Login page
│   ├── signup.php            # Registration page
│   ├── contact.php           # Contact page
│   ├── dashboard.php         # User dashboard
│   └── admin/                # Admin panel
│       ├── index.php         # Admin dashboard
│       ├── users.php         # User management
│       ├── loads.php         # Load management
│       └── ...
├── index.php                 # Main entry point
└── README.md                 # This file
```

## 🎨 Design Features

### Modern UI Elements
- **Dark Theme**: Professional dark color scheme
- **Gradient Backgrounds**: Subtle gradients and effects
- **Glass Morphism**: Backdrop blur effects
- **Smooth Animations**: CSS transitions and hover effects
- **Typography**: Modern Inter font family
- **Icons**: Font Awesome 6 icon set

### Responsive Design
- Mobile-first approach
- Flexible grid layouts
- Responsive navigation
- Touch-friendly interface
- Optimized for all screen sizes

## 🔐 Security Features

- **Password Hashing**: Secure password storage using PHP's `password_hash()`
- **CSRF Protection**: Cross-site request forgery protection
- **Input Validation**: Server-side input validation
- **SQL Injection Prevention**: Prepared statements
- **Session Management**: Secure session handling
- **XSS Protection**: Output escaping

## 📱 Pages & Features

### Public Pages
- **Homepage**: Hero section, features, testimonials, CTA
- **Services**: Service offerings and descriptions
- **Pricing**: Pricing plans and packages
- **Contact**: Contact form and company information
- **Login/Signup**: Authentication pages

### Protected Pages
- **Dashboard**: Role-based user dashboards
- **Admin Panel**: Complete administrative interface
- **User Management**: Add, edit, delete users
- **Load Management**: Manage truck loads and shipments
- **Settings**: System configuration

## 🚀 Deployment

### Production Deployment

1. **Server Requirements**:
   - PHP 7.4+ with extensions: PDO, PDO_MySQL, OpenSSL
   - MySQL 5.7+ or MariaDB 10.2+
   - Apache/Nginx web server
   - SSL certificate (recommended)

2. **Environment Setup**:
   - Set `display_errors = Off` in php.ini
   - Configure proper file permissions
   - Set up database backups
   - Enable HTTPS

3. **Security Considerations**:
   - Change default admin password
   - Update database credentials
   - Configure proper file permissions
   - Set up regular backups

## 🛠️ Development

### Adding New Pages
1. Create new PHP file in `pages/` directory
2. Add route to `index.php`
3. Include header and footer
4. Add navigation link if needed

### Adding New Features
1. Create database tables if needed
2. Add PHP functions in appropriate files
3. Create frontend interface
4. Add JavaScript functionality
5. Test thoroughly

### Database Modifications
1. Create migration SQL files
2. Update schema.sql
3. Test database changes
4. Update documentation

## 📚 Course Requirements Met

This project demonstrates proficiency in:

- **HTML5**: Semantic markup, forms, accessibility
- **CSS3**: Modern styling, responsive design, animations
- **PHP**: Server-side programming, database integration, security
- **MySQL**: Database design, queries, relationships
- **Web Development**: Full-stack development, MVC pattern
- **Security**: Authentication, authorization, input validation
- **Responsive Design**: Mobile-first, cross-browser compatibility

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## 📄 License

This project is created for educational purposes as part of a web technology course.

## 🆘 Support

For questions or issues:
1. Check the documentation
2. Review the code comments
3. Contact your instructor
4. Create an issue in the repository

## 🔄 Future Enhancements

Potential improvements for future development:
- Real-time tracking with WebSockets
- Mobile app integration
- Advanced reporting features
- Payment gateway integration
- Multi-language support
- Advanced analytics dashboard

---

**Note**: This is a converted version of a React/Node.js application, redesigned to use HTML, CSS, PHP, and MySQL for educational purposes. The functionality has been preserved while adapting to the new technology stack.
