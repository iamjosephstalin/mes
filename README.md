<p align="center"></p>

<h1 align="center">
   Manufacturing Execution System (MES)
</h1>

<p align="center">A comprehensive Manufacturing Execution System designed to digitize and automate production floor paperwork and operations.</p>

![GitHub](https://img.shields.io/github/license/laravel/laravel)

## Introduction 🚀

**MES (Manufacturing Execution System)** is a production floor management system that transforms traditional paper-based workflows into a digital, automated solution. This system helps manufacturing organizations track and manage their production operations, employee time tracking, machine operations, client management, and more.

### Key Benefits

- **Digital Transformation**: Replace manual paperwork with digital data capture and management
- **Real-time Tracking**: Monitor production operations, employee time, and machine activities in real-time
- **Improved Efficiency**: Streamline workflows and reduce administrative overhead
- **Data Analytics**: Gain insights into production metrics and employee performance
- **Paperless Operations**: Reduce paper usage and improve data accuracy
- **Comprehensive Management**: Handle clients, machines, operations, and workers all in one system

### Built With

- **Laravel** ^10.23 - PHP web framework
- **Laravel Fortify** - Authentication and security
- **Laravel Sanctum** - API authentication
- **PHP** ^8.1
- Modern frontend technologies


## Installation ⚒️

Installing and running the MES application is straightforward. Follow the steps below to get started:

1. Open the terminal in your root directory of the MES Laravel project.
2. Use the following command to install the composer

```bash
composer install
```

3. Run the following command to generate the key

```bash
php artisan key:generate
```

4. By running the following command, you will be able to get all the dependencies in your **node_modules** folder:

```bash
yarn
```

5. To run the project, you need to run the following command in the project directory. It will compile JavaScript and Styles.

```bash
yarn dev
```

6. To serve the application, you need to run the following command in the project directory

```bash
php artisan serve
```

7. Now navigate to the given address, and you will see your application is running.🥳

## Available Tasks 🧑‍💻

**Building for Production:** If you want to run the project and make the build in the production mode then run the following command in the root directory, by default The project will continue to run in the development mode:

```bash
yarn prod
```

## Key Features 📦

### Production Management
- **Machine Operations**: Track and manage machine operations with hourly rates, shift configurations, and detailed notes
- **Operations Tracking**: Monitor production operations across different machines and shifts
- **Multi-Currency Support**: Handle operations with different currencies and pricing
- **Shift Management**: Configure multiple shifts with hours per pay calculations

### Employee Management
- **Time Tracking**: Employee clock in/out system with detailed history
- **Pause Tracking**: Monitor and record break times during work shifts
- **Working Time Calculations**: Automatic calculation of working hours and pause times
- **Comment System**: Add comments for clock in/out and track additional notes
- **User Roles**: Role-based access control with multiple user types

### Client & Business Management
- **Client Management**: Complete client database with contact information, addresses, and tax details
- **VAT Rate Configuration**: Configure and manage VAT rates for different regions
- **Currency Management**: Support for multiple currencies in the system
- **Unit Management**: Manage different units of measurement
- **Additional Fields**: Customizable additional fields for flexible data structure

### Data Organization
- **Tag System**: Organize data with color-coded tags for easy categorization
- **Soft Deletes**: Safe data deletion with ability to restore
- **Audit Trail**: Automatic timestamp tracking for all records
- **Flexible Schema**: Extensible database design for custom requirements

### Authentication & Security
- **Laravel Fortify**: Built-in authentication with two-factor authentication support
- **Laravel Sanctum**: API authentication for secure API access
- **API Key Management**: Generate and manage API keys for external integrations
- **Role-based Permissions**: Granular access control based on user roles

## Technology Stack 🛠️

- **Backend**: Laravel 10.x
- **Frontend**: Bootstrap 5 with modern JavaScript
- **Authentication**: Laravel Fortify with 2FA support
- **API**: Laravel Sanctum for token-based authentication
- **Database**: MySQL/PostgreSQL compatible
- **Language**: PHP 8.1+

## Browser Support 🖥️

At present, we officially aim to support the last two versions of the following browsers:

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Microsoft Edge (latest)
- Opera (latest)

## System Requirements 📋

### Minimum Requirements
- **PHP**: 8.1 or higher
- **Composer**: Latest version
- **Node.js**: 16.x or higher
- **Database**: MySQL 5.7+ or PostgreSQL 10+

### Recommended Requirements
- **PHP**: 8.2 or higher
- **Memory**: 256MB or more
- **Database**: MySQL 8.0+ or PostgreSQL 13+

## Usage 💡

### Setting Up Database

1. Create a MySQL/PostgreSQL database for the application
2. Configure your `.env` file with database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

3. Run migrations to set up the database schema:
```bash
php artisan migrate
```

4. (Optional) Seed the database with initial data:
```bash
php artisan db:seed
```

### Accessing the Application

Once the application is running:
1. Navigate to `http://localhost:8000` (or your configured port)
2. Register a new account or use existing credentials
3. Access the dashboard to start managing your production operations

## Project Structure 📁

```
mes/
├── app/
│   ├── Models/           # Eloquent models
│   ├── Http/
│   │   ├── Controllers/  # Application controllers
│   │   └── Middleware/   # Custom middleware
│   └── Actions/          # Action classes
├── database/
│   ├── migrations/       # Database migrations
│   └── seeders/         # Database seeders
├── resources/
│   ├── views/           # Blade templates
│   ├── css/             # Stylesheets
│   └── js/              # JavaScript files
├── routes/              # Application routes
└── config/             # Configuration files
```

## Contributing 🦸

Contributions are always welcome! Here's how you can help:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/your-feature`)
3. Commit your changes (`git commit -m 'Add some feature'`)
4. Push to the branch (`git push origin feature/your-feature`)
5. Open a Pull Request

### Contribution Guidelines

- Follow PSR-12 coding standards
- Write clear commit messages
- Add tests for new features
- Update documentation as needed
- Ensure all tests pass before submitting

## License ©

- Licensed under [MIT](LICENSE)
