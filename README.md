# 🎓 Random Eigo - English Learning Management System

A comprehensive **Laravel 12** bilingual (English/Japanese) learning management system with role-based dashboards for administrators (teachers) and students. Features modern, mobile-responsive interfaces with complete authentication, language switching, and dynamic content management.

---

## 📋 Table of Contents

- [Features](#-features)
- [Screenshots](#-screenshots)
- [Technology Stack](#-technology-stack)
- [System Requirements](#-system-requirements)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Database Setup](#-database-setup)
- [Usage](#-usage)
- [Project Structure](#-project-structure)
- [Translation System](#-translation-system)
- [Routes Documentation](#-routes-documentation)
- [Development Workflow](#-development-workflow)
- [Testing](#-testing)
- [Deployment](#-deployment)
- [Troubleshooting](#-troubleshooting)
- [Contributing](#-contributing)
- [License](#-license)

---

## ✨ Features

### 🔐 Authentication & Authorization
- **Role-Based Access Control (RBAC)**: Two distinct roles - `admin` (teachers) and `student`
- **Secure Authentication**: Laravel's built-in authentication with password hashing
- **Role-Based Redirects**: Automatic routing to appropriate dashboards after login
- **Middleware Protection**: `CheckRole` middleware for route-level access control
- **Remember Me**: Optional persistent login sessions
- **Logout Confirmation**: JavaScript confirmation dialog before logout

### 🌍 Multi-Language Support
- **Bilingual System**: Full English and Japanese language support
- **Live Language Switching**: Toggle between languages without page reload
- **Persistent Language Preference**: User language choice stored in database and session
- **60+ Translation Keys**: Comprehensive coverage across all interfaces
- **Locale Middleware**: Automatic locale detection from user preferences

### 📱 Mobile-Responsive Design
- **Mobile-First Approach**: Optimized for all screen sizes
- **Responsive Breakpoints**: 
  - Desktop: 1024px+
  - Tablet: 768px - 1024px
  - Mobile: 480px - 768px
  - Ultra-compact: < 480px
- **Hamburger Menu**: Slide-in sidebar navigation for mobile devices
- **Touch-Friendly UI**: Large tap targets and optimized spacing
- **Adaptive Grid Layouts**: Stats and content grids auto-adjust to screen size

### 👨‍🏫 Admin Dashboard (Teacher Portal)
- **Statistics Overview**:
  - Lessons Conducted (monthly)
  - Total Students (active count)
  - Assignments to Grade (pending)
  - Student Rating (average)
- **Today's Schedule**: List of scheduled classes with times and descriptions
- **Announcements Section**: Important updates and notices
- **Navigation Menu**:
  - Dashboard
  - Schedule Management
  - Lesson Materials
  - Students Management
  - Accounts/Revenue
  - Profile Settings
- **Light Theme**: Clean white interface with green (#00B86B) accents

### 👨‍🎓 Student Dashboard (Student Portal)
- **User Profile Section**: Avatar with initials and level display
- **Progress Bar**: Visual course completion tracker
- **Statistics Overview**:
  - Lessons Completed
  - Credits Remaining
  - Certificates Earned
  - Current Level (CEFR scale)
  - Course Progress (percentage)
- **Upcoming Lessons**: Teacher info, date, and time
- **Quick Actions**: Book Lesson, View Materials, Track Progress, Contact Support
- **Navigation Menu**:
  - Dashboard
  - Book a Lesson
  - Lesson History
  - Courses & Payment
  - Materials
  - Certificates
  - Profile
  - Contact Us
- **Dark Theme**: Modern dark sidebar (#2D3748) with orange (#FF8A00) accents

### 🎨 UI/UX Features
- **Lucide Icons**: Clean SVG icons throughout the interface
- **Smooth Animations**: CSS transitions for interactive elements
- **Active State Highlighting**: Visual feedback for current page
- **Notification System**: Badge indicators for unread notifications
- **Dynamic Content**: Controller-driven data with `@forelse` loops
- **Empty States**: Friendly messages when no data is available
- **Gradient Accents**: Modern gradient backgrounds on key elements
- **Box Shadow Effects**: Subtle depth for cards and components

---

## 🖼️ Screenshots

The application features two distinct dashboard designs:

### Admin Dashboard (Teacher)
- Light theme with green accents
- Stats grid with 4 key metrics
- Today's schedule and announcements side-by-side
- Mobile-responsive with hamburger menu

### Student Dashboard
- Dark sidebar with orange accents
- User profile with progress tracking
- Upcoming lessons with teacher avatars
- Quick action buttons for common tasks

---

## 🛠️ Technology Stack

### Backend
- **Framework**: Laravel 12.0
- **PHP Version**: 8.2+
- **Database**: MySQL/MariaDB
- **Authentication**: Laravel's built-in Auth system
- **Templating**: Blade Engine
- **Dependencies**:
  - `laravel/framework ^12.0`
  - `laravel/tinker ^2.10`

### Frontend
- **Build Tool**: Vite 7.0.7
- **CSS Framework**: Tailwind CSS 4.0.0
- **HTTP Client**: Axios 1.11.0
- **Icons**: Lucide Icons (inline SVG)
- **JavaScript**: Vanilla JS for interactions

### Development Tools
- **Code Quality**: Laravel Pint (PHP CS Fixer)
- **Testing**: PHPUnit 11.5
- **Local Development**: Laravel Sail (Docker)
- **Fake Data**: Faker PHP
- **Process Management**: Concurrently 9.0.1

---

## 💻 System Requirements

- **PHP**: 8.2 or higher
- **Composer**: Latest version
- **Node.js**: 18.x or higher
- **NPM**: 9.x or higher
- **MySQL**: 8.0+ or MariaDB 10.3+
- **Web Server**: Apache/Nginx
- **Git**: For version control

### PHP Extensions Required
- BCMath
- Ctype
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PDO
- Tokenizer
- XML

---

## 📦 Installation

### 1. Clone the Repository

```bash
git clone <repository-url> random_eigo
cd random_eigo
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Environment Configuration

Copy the example environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

### 5. Configure Database

Edit `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=random_eigo
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Run Migrations

```bash
php artisan migrate
```

### 7. Seed Database (Optional)

Create test users:

```bash
php artisan db:seed
```

This creates:
- **Admin**: `admin@gmail.com` / `admin123`
- **Student**: `student@gmail.com` / `student123`

### 8. Build Frontend Assets

For development:

```bash
npm run dev
```

For production:

```bash
npm run build
```

### 9. Start Development Server

```bash
php artisan serve
```

Application will be available at `http://localhost:8000`

---

## ⚙️ Configuration

### Application Settings

Edit `config/app.php`:

```php
'name' => env('APP_NAME', 'Random Eigo'),
'locale' => 'ja', // Default language
'fallback_locale' => 'en',
'faker_locale' => 'en_US',
```

### Database Configuration

Edit `config/database.php` for advanced database settings.

### Session Configuration

Edit `config/session.php` for session driver and lifetime settings.

### Locale Middleware

The application uses `SetLocale` middleware to automatically set the user's preferred language:

1. **Session**: Checks session for saved locale
2. **User Preference**: Falls back to authenticated user's locale
3. **Default**: Uses Japanese (`ja`) as default

---

## 🗄️ Database Setup

### Tables Created

#### Users Table
- `id` - Primary key
- `name` - User full name
- `email` - Unique email address
- `password` - Hashed password
- `role` - Enum: `student` (default) or `admin`
- `locale` - User's preferred language (`ja` default)
- `remember_token` - For "Remember Me" functionality
- `timestamps` - Created/Updated timestamps

#### Password Reset Tokens Table
- `email` - Primary key
- `token` - Reset token
- `created_at` - Token creation timestamp

#### Sessions Table
- `id` - Session ID (primary key)
- `user_id` - Associated user
- `ip_address` - Client IP
- `user_agent` - Browser information
- `payload` - Session data
- `last_activity` - Last activity timestamp

### Seeders

The `DatabaseSeeder` creates two test users:

**Admin User:**
```php
Email: admin@gmail.com
Password: admin123
Role: admin
```

**Student User:**
```php
Email: student@gmail.com
Password: student123
Role: student
```

---

## 🚀 Usage

### Accessing the Application

1. **Landing Page**: Visit `http://localhost:8000`
2. **Login**: Click "Login" button
3. **Test Credentials**:
   - Admin: `admin@gmail.com` / `admin123`
   - Student: `student@gmail.com` / `student123`

### User Flows

#### Admin (Teacher) Flow
1. Login with admin credentials
2. Redirected to `/admin/dashboard`
3. View statistics, schedule, and announcements
4. Navigate to schedule, materials, students, accounts, or profile
5. Switch language using globe icon in topbar
6. Logout with confirmation

#### Student Flow
1. Login with student credentials
2. Redirected to `/student/dashboard`
3. View stats, upcoming lessons, and quick actions
4. Navigate to book lessons, view history, access materials, certificates
5. Track progress with visual progress bar
6. Switch language using globe icon in topbar
7. Logout with confirmation

#### Registration Flow
1. Click "Register" on landing page
2. Fill in name, email, password, and password confirmation
3. Automatically assigned `student` role
4. Redirected to student dashboard
5. Password visibility toggle available

### Language Switching

Click the globe icon in the topbar to switch between English and Japanese. The preference is:
- Saved to session
- Updated in user's database record
- Applied immediately across all pages

---

## 📁 Project Structure

```
random_eigo/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── ScheduleController.php
│   │   │   │   ├── MaterialController.php
│   │   │   │   ├── StudentController.php
│   │   │   │   ├── AccountController.php
│   │   │   │   └── ProfileController.php
│   │   │   ├── Student/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── LessonController.php
│   │   │   │   ├── MaterialController.php
│   │   │   │   └── ProfileController.php
│   │   │   ├── AuthController.php
│   │   │   └── LanguageController.php
│   │   └── Middleware/
│   │       ├── CheckRole.php
│   │       └── SetLocale.php
│   └── Models/
│       └── User.php
│
├── bootstrap/
│   ├── app.php              # Application bootstrap with middleware aliases
│   └── cache/
│
├── config/
│   ├── app.php              # Application configuration
│   ├── auth.php             # Authentication configuration
│   ├── database.php         # Database configuration
│   └── session.php          # Session configuration
│
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   └── 0001_01_01_000002_create_jobs_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
│
├── public/
│   ├── index.php            # Application entry point
│   └── icon/                # Favicon and icons
│
├── resources/
│   ├── css/
│   │   └── app.css          # Main CSS file
│   ├── js/
│   │   ├── app.js           # Main JavaScript file
│   │   └── bootstrap.js     # Laravel Echo and Axios setup
│   ├── lang/
│   │   ├── en/
│   │   │   └── messages.php # English translations
│   │   └── ja/
│   │       └── messages.php # Japanese translations
│   └── views/
│       ├── admin/
│       │   ├── layouts/
│       │   │   ├── app.blade.php      # Admin main layout
│       │   │   └── sidebar.blade.php  # Admin sidebar
│       │   └── pages/
│       │       ├── dashboard.blade.php
│       │       ├── schedule.blade.php
│       │       ├── materials.blade.php
│       │       ├── students.blade.php
│       │       ├── accounts.blade.php
│       │       └── profile.blade.php
│       ├── student/
│       │   ├── layouts/
│       │   │   ├── app.blade.php      # Student main layout
│       │   │   └── sidebar.blade.php  # Student sidebar
│       │   └── pages/
│       │       ├── dashboard.blade.php
│       │       ├── book-lesson.blade.php
│       │       ├── lesson-history.blade.php
│       │       ├── courses.blade.php
│       │       ├── materials.blade.php
│       │       ├── certificates.blade.php
│       │       ├── profile.blade.php
│       │       └── contact.blade.php
│       ├── welcome.blade.php          # Landing page
│       ├── login.blade.php            # Login form
│       └── register.blade.php         # Registration form
│
├── routes/
│   ├── web.php              # General web routes
│   ├── admin.php            # Admin-specific routes
│   ├── student.php          # Student-specific routes
│   └── console.php          # Artisan console routes
│
├── tests/
│   ├── Feature/
│   │   └── ExampleTest.php
│   └── Unit/
│       └── ExampleTest.php
│
├── .env                     # Environment configuration (create from .env.example)
├── .env.example             # Example environment file
├── composer.json            # PHP dependencies
├── package.json             # Node dependencies
├── phpunit.xml              # PHPUnit configuration
├── vite.config.js           # Vite build configuration
└── README.md                # This file
```

---

## 🌐 Translation System

### Language Files

The application uses Laravel's translation system with two language files:

**English**: `resources/lang/en/messages.php`
**Japanese**: `resources/lang/ja/messages.php`

### Translation Keys

Over 60+ translation keys cover:

- **Landing Page**: Hero section, features, testimonials, CTA buttons
- **Authentication**: Login, register, forgot password forms
- **Admin Dashboard**: Stats labels, schedule, announcements, navigation
- **Student Dashboard**: Stats, lessons, progress, quick actions, navigation
- **Common**: Logout confirmation, language switcher, empty states

### Using Translations in Blade

```blade
<!-- Simple translation -->
{{ __('messages.dashboard') }}

<!-- Translation with parameters -->
{{ __('messages.welcome_back', ['name' => $user->name]) }}

<!-- Translation with choice (pluralization) -->
{{ trans_choice('messages.students', $count) }}
```

### Adding New Translations

1. Add key to `resources/lang/en/messages.php`:
```php
'new_key' => 'English text',
```

2. Add corresponding key to `resources/lang/ja/messages.php`:
```php
'new_key' => '日本語テキスト',
```

3. Use in Blade template:
```blade
{{ __('messages.new_key') }}
```

### Language Switching

The `LanguageController` handles language switching:

```php
public function switch($locale)
{
    if (in_array($locale, ['en', 'ja'])) {
        App::setLocale($locale);
        Session::put('locale', $locale);
        
        // Update user preference
        if (Auth::check()) {
            Auth::user()->update(['locale' => $locale]);
        }
    }
    
    return redirect()->back();
}
```

---

## 🛣️ Routes Documentation

### Public Routes (web.php)

| Method | URI | Action | Description |
|--------|-----|--------|-------------|
| GET | `/` | Welcome page | Landing page |
| GET | `/login` | Show login form | Authentication |
| POST | `/login` | Process login | Authenticate user |
| GET | `/register` | Show register form | Registration |
| POST | `/register` | Process registration | Create new user |
| POST | `/logout` | Logout user | End session |
| GET | `/lang/{locale}` | Switch language | Change language (en/ja) |

### Admin Routes (admin.php)

**Middleware**: `auth`, `role:admin`
**Prefix**: `/admin`
**Name Prefix**: `admin.`

| Method | URI | Action | Description |
|--------|-----|--------|-------------|
| GET | `/admin/dashboard` | Dashboard | Admin dashboard overview |
| GET | `/admin/schedule` | Schedule index | View schedule |
| POST | `/admin/schedule` | Store schedule | Create new schedule |
| PUT | `/admin/schedule/{id}` | Update schedule | Edit schedule |
| DELETE | `/admin/schedule/{id}` | Delete schedule | Remove schedule |
| GET | `/admin/materials` | Materials index | View materials |
| POST | `/admin/materials` | Store material | Upload material |
| DELETE | `/admin/materials/{id}` | Delete material | Remove material |
| GET | `/admin/students` | Students index | View all students |
| GET | `/admin/students/{id}` | Show student | View student details |
| PUT | `/admin/students/{id}` | Update student | Edit student info |
| GET | `/admin/accounts` | Accounts index | Revenue tracking |
| GET | `/admin/profile` | Show profile | View admin profile |
| PUT | `/admin/profile` | Update profile | Edit admin profile |

### Student Routes (student.php)

**Middleware**: `auth`, `role:student`
**Prefix**: `/student`
**Name Prefix**: `student.`

| Method | URI | Action | Description |
|--------|-----|--------|-------------|
| GET | `/student/dashboard` | Dashboard | Student dashboard overview |
| GET | `/student/lessons/book` | Show book lesson | Booking form |
| POST | `/student/lessons/book` | Store lesson | Create booking |
| GET | `/student/lessons/history` | Lesson history | View past lessons |
| GET | `/student/courses` | Courses | View courses & payment |
| GET | `/student/materials` | Materials index | Access materials |
| GET | `/student/materials/download/{id}` | Download material | Download file |
| GET | `/student/certificates` | Certificates | View earned certificates |
| GET | `/student/profile` | Show profile | View student profile |
| PUT | `/student/profile` | Update profile | Edit student profile |
| GET | `/student/contact` | Contact form | Contact support |

---

## 🔧 Development Workflow

### Custom Composer Scripts

```bash
# Setup: Install all dependencies and prepare environment
composer setup

# Development: Run migrations, seed data, start servers concurrently
composer dev

# Testing: Run PHPUnit tests
composer test
```

### NPM Scripts

```bash
# Development mode with hot reload
npm run dev

# Build for production
npm run build

# Preview production build
npm run preview
```

### Artisan Commands

```bash
# Database
php artisan migrate              # Run migrations
php artisan migrate:fresh        # Drop all tables and re-run migrations
php artisan migrate:fresh --seed # Fresh migration with seeding
php artisan db:seed              # Run database seeders

# Cache
php artisan cache:clear          # Clear application cache
php artisan config:clear         # Clear config cache
php artisan route:clear          # Clear route cache
php artisan view:clear           # Clear compiled views

# Code Quality
./vendor/bin/pint                # Format code with Laravel Pint

# Development
php artisan serve                # Start development server
php artisan tinker               # Interactive shell
```

### Git Workflow

```bash
# Create feature branch
git checkout -b feature/new-feature

# Stage changes
git add .

# Commit with descriptive message
git commit -m "Add: new feature description"

# Push to remote
git push origin feature/new-feature

# Create pull request (GitHub/GitLab)
```

---

## 🧪 Testing

### Running Tests

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/ExampleTest.php

# Run tests with coverage
php artisan test --coverage
```

### Writing Tests

```php
<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_admin_dashboard()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        $response = $this->actingAs($admin)
                         ->get('/admin/dashboard');
        
        $response->assertStatus(200);
    }

    public function test_student_cannot_access_admin_dashboard()
    {
        $student = User::factory()->create(['role' => 'student']);
        
        $response = $this->actingAs($student)
                         ->get('/admin/dashboard');
        
        $response->assertStatus(403);
    }
}
```

---

## 🚢 Deployment

### Production Checklist

1. **Environment Configuration**
```bash
# Set APP_ENV to production
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

2. **Optimize Application**
```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

3. **Database Migration**
```bash
php artisan migrate --force
```

4. **File Permissions**
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

5. **Web Server Configuration**

**Apache (.htaccess)**:
Already included in Laravel's public directory.

**Nginx**:
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /var/www/random_eigo/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

6. **SSL Certificate**
```bash
# Using Certbot (Let's Encrypt)
sudo certbot --nginx -d yourdomain.com
```

### Deployment Platforms

- **Laravel Forge**: Automated server management
- **Laravel Vapor**: Serverless deployment
- **Heroku**: Platform as a Service
- **DigitalOcean**: VPS deployment
- **AWS**: EC2, RDS, S3 integration

---

## 🔍 Troubleshooting

### Common Issues

#### 1. **White Screen / 500 Error**

**Solution:**
```bash
# Check logs
tail -f storage/logs/laravel.log

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Regenerate autoload
composer dump-autoload

# Check file permissions
chmod -R 775 storage bootstrap/cache
```

#### 2. **Assets Not Loading (404 on CSS/JS)**

**Solution:**
```bash
# Rebuild assets
npm run build

# Check public path in .env
APP_URL=http://localhost:8000

# Verify Vite configuration
php artisan config:clear
```

#### 3. **Database Connection Error**

**Solution:**
```bash
# Verify .env database credentials
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=random_eigo
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Test connection
php artisan migrate:status

# Create database if missing
mysql -u root -p
CREATE DATABASE random_eigo;
```

#### 4. **Middleware "role" Not Found**

**Solution:**
Ensure `bootstrap/app.php` has middleware alias:
```php
$middleware->alias([
    'role' => \App\Http\Middleware\CheckRole::class,
]);
```

#### 5. **Language Not Switching**

**Solution:**
```bash
# Clear session
php artisan session:table
php artisan migrate

# Verify SetLocale middleware is registered
# Check bootstrap/app.php:
$middleware->web(append: [
    \App\Http\Middleware\SetLocale::class,
]);
```

#### 6. **Composer Install Fails**

**Solution:**
```bash
# Update Composer
composer self-update

# Clear Composer cache
composer clear-cache

# Install with verbose output
composer install -vvv
```

#### 7. **NPM Install Fails**

**Solution:**
```bash
# Clear NPM cache
npm cache clean --force

# Delete node_modules and lock file
rm -rf node_modules package-lock.json

# Reinstall
npm install
```

---

## 🤝 Contributing

Contributions are welcome! Please follow these guidelines:

### Development Setup

1. Fork the repository
2. Clone your fork: `git clone https://github.com/yourusername/random_eigo.git`
3. Create a branch: `git checkout -b feature/amazing-feature`
4. Make your changes
5. Run tests: `php artisan test`
6. Format code: `./vendor/bin/pint`
7. Commit: `git commit -m 'Add: amazing feature'`
8. Push: `git push origin feature/amazing-feature`
9. Open a Pull Request

### Code Standards

- **PHP**: Follow PSR-12 coding standards (use Laravel Pint)
- **JavaScript**: ES6+ syntax, consistent formatting
- **CSS**: Use Tailwind CSS classes when possible
- **Blade**: Keep logic minimal, use components
- **Commits**: Use conventional commit messages (Add:, Fix:, Update:, Remove:)

### Pull Request Guidelines

- Provide clear description of changes
- Include screenshots for UI changes
- Update documentation if needed
- Add tests for new features
- Ensure all tests pass
- Keep PR focused on a single feature/fix

---

## 📄 License

This project is licensed under the MIT License.

```
MIT License

Copyright (c) 2025 Random Eigo

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

---

## 📞 Support

For questions, issues, or feature requests:

- **GitHub Issues**: [Open an issue](https://github.com/yourusername/random_eigo/issues)
- **Email**: support@randomeigo.com
- **Documentation**: [Wiki](https://github.com/yourusername/random_eigo/wiki)

---

## 🎯 Roadmap

### Planned Features

- [ ] Real-time notifications with Laravel Echo
- [ ] Payment integration (Stripe/PayPal)
- [ ] Video conferencing integration (Zoom/Jitsi)
- [ ] Certificate generation system
- [ ] Email notifications for lessons
- [ ] Advanced scheduling system with calendar
- [ ] Student performance analytics
- [ ] Material library with search/filter
- [ ] Mobile app (React Native)
- [ ] API for third-party integrations
- [ ] Multi-currency support
- [ ] Advanced reporting dashboard
- [ ] Automated lesson reminders
- [ ] Student feedback system
- [ ] Course curriculum builder

---

## 🙏 Acknowledgments

- **Laravel**: The PHP Framework For Web Artisans
- **Tailwind CSS**: A utility-first CSS framework
- **Lucide**: Beautiful & consistent icon toolkit
- **Vite**: Next generation frontend tooling
- **Community**: All contributors and supporters

---

## 📊 Project Statistics

- **Laravel Version**: 12.0
- **PHP Version**: 8.2+
- **Total Routes**: 30+
- **Controllers**: 14
- **Middleware**: 2 custom
- **Translation Keys**: 60+
- **Database Tables**: 3
- **Blade Components**: 20+
- **CSS Framework**: Tailwind CSS 4.0
- **Lines of Code**: ~5,000+

---

**Built with ❤️ for English language learners**

---

*Last Updated: January 2025*
