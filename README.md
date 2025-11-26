# MyDispatch Logistics - Laravel Version

A professional truck dispatch and logistics management system built with **Laravel 11**, PHP, and MySQL.

## 🚛 Features

- **Modern Dark Theme Design** - Professional, responsive UI with dark theme
- **User Authentication** - Secure login/signup with Laravel Auth
- **Admin Dashboard** - Complete admin panel for managing users, carriers, and messages
- **Contact System** - Contact form with database storage via Eloquent ORM
- **Carrier Setup** - Dedicated carrier application system
- **Interactive 3D Elements** - Three.js integration for 3D truck visualization
- **Responsive Design** - Mobile-first responsive design
- **Database Integration** - MySQL database with Laravel Migrations
- **Security Features** - CSRF protection, password hashing, input validation

## 🛠️ Technology Stack

- **Framework**: Laravel 11
- **Language**: PHP 8.2+
- **Database**: MySQL 8.0+
- **Frontend**: Blade Templates, HTML5, CSS3, JavaScript (Vanilla + Three.js)
- **Styling**: Custom CSS with modern features (Grid, Flexbox, Animations)
- **Icons**: Font Awesome 6
- **Fonts**: Inter (Google Fonts)

## 📋 Requirements

- PHP 8.2 or higher
- Composer
- MySQL 8.0 or higher
- Web server (Apache/Nginx) or Laravel Sail
- Modern web browser

## 🚀 Installation

### 1. Clone/Download the Project

```bash
git clone https://github.com/abdulhadics/mydispatch-laravel.git
cd mydispatch-laravel
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Environment Setup

Copy the example environment file and configure your database:

```bash
cp .env.example .env
```

Edit `.env` file with your database credentials:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_truck
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Application Key & Migrations

Generate the application key and run database migrations:

```bash
php artisan key:generate
php artisan migrate
```

### 5. Run the Application

Start the local development server:

```bash
php artisan serve
```

Access via: `http://localhost:8000`

## 👥 User Roles & Demo Accounts

### Demo Accounts (Seeded)
- **Admin**: `admin@logistics.com` / `password`
- **Driver**: `driver@example.com` / `password`
- **Customer**: `customer@example.com` / `password`

### User Roles
- **Admin**: Full access to admin panel, user management, system settings
- **Driver**: Access to driver dashboard, load management, tracking
- **Customer**: Access to customer portal, shipment tracking, payments

## 📁 Project Structure

```
laravel_app/
├── app/
│   ├── Http/Controllers/  # Application logic
│   ├── Models/            # Eloquent data models
│   └── ...
├── database/
│   ├── migrations/        # Database schema definitions
│   └── seeders/           # Data seeders
├── public/
│   ├── assets/            # Static assets (CSS, JS, Images)
│   └── ...
├── resources/
│   ├── views/             # Blade templates
│   └── ...
├── routes/
│   ├── web.php            # Web routes
│   └── ...
├── .env                   # Environment configuration
└── composer.json          # Dependency definitions
```

## 🎨 Design Features

### Modern UI Elements
- **Dark Theme**: Professional dark color scheme
- **Gradient Backgrounds**: Subtle gradients and effects
- **Glass Morphism**: Backdrop blur effects
- **Smooth Animations**: CSS transitions and hover effects
- **3D Graphics**: Interactive Three.js truck model

### Responsive Design
- Mobile-first approach
- Flexible grid layouts
- Responsive navigation
- Touch-friendly interface

## 🔐 Security Features

- **Authentication**: Laravel's built-in authentication system
- **CSRF Protection**: Automatic CSRF token verification
- **Input Validation**: Form request validation
- **SQL Injection Prevention**: Eloquent ORM parameter binding
- **XSS Protection**: Blade template escaping

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## 📄 License

This project is created for educational purposes.

## 🆘 Support

For questions or issues, please check the Laravel documentation or contact the repository owner.
