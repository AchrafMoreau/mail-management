# 📧 Mail Management Dashboard

Welcome to the **Mail Management Dashboard**! This application is designed to streamline and simplify mail handling with an intuitive interface and robust functionality. Built with the power of **Laravel**, it offers a seamless experience for managing, organizing, and tracking your correspondence.

---

## 🌟 Features
- 📬 **Inbox Management:** Effortlessly view, organize, and filter emails.
- 🗄️ **Categorization:** Tag and categorize emails for easy retrieval.
- 📊 **Analytics:** Gain insights with comprehensive email activity statistics.
- 🛡️ **Security:** Built-in authentication and role-based access control.

---

## 🖥️ Tech Stack
- **Frontend:** Blade templates with Bootstrap.
- **Backend:** Laravel 11.
- **Database:** MySQL .
- **Authentication:** Laravel Breeze.

---

## 🚀 Getting Started

### Prerequisites
Make sure you have the following installed:
- 🐘 PHP 8.1 or newer
- 🐬 MySQL 8.0
- 🐳 Composer
- 🛠️ Node.js & NPM

### Installation Steps
1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/mail-management-dashboard.git
   cd mail-management-dashboard

    # Install Dependencies :
    composer install
    npm install

    # Set up the environment file:
    cp .env.example .env

    # Generate the application key:
    php artisan key:generate

    # Run migrations and seeders:
    php artisan migrate --seed

    # Run the application
    php artisan serve
    ```
2. You can access the applicaiotn via : http://localhost:8000