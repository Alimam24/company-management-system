## Retail Management Dashboard

WP2 is a web-based retail management system built with **Laravel** and **Blade** that provides a centralized dashboard for managing employees, customers, products, warehouses, and stores. It offers role/department-based access, quick actions for daily operations, and a clean, modern interface for monitoring key business metrics.

### Features

- **Dashboard Overview**
  - Personalized welcome message for logged-in employees.
  - High-level statistics for:
    - Total employees
    - Total customers
    - Total products
    - Retail stores
    - Warehouses
- **Role/Department-Based Access**
  - Conditional access to modules based on the user’s department (HR, Sales/Marketing, Inventory, Warehousing, etc.) and his role in the department (manager/ employee).
  - Tailored quick actions for each department (e.g. Add Employee, Add Customer, Add Product).
- **Entity Management**
  - **Employees**: Create, update, and manage employee records, including assignment to their respective departments.
  - **Customers**: Register and manage customer profiles, assign promotional offers, and link VIP customers to dedicated marketing employees.
  - **Products**:Maintain and manage the product catalog, including product details and availability.
  - **Stores**: Manage retail store locations, associate stores with warehouses, and handle product transfers from warehouses to stores.
  - **Warehouses**: Manage warehouse facilities, inventory levels, and stock locations.
  - **Departments**: Manage organizational departments (for admins).
- **Modern UI / UX**
  - Responsive layout using Tailwind.
  - Card-based stats, quick action tiles, and intuitive navigation.

### Tech Stack

- **Backend**: PHP 8.4, Laravel 12
- **Frontend**: Blade templates, Tailwind-style utility classes
- **Database**: Sqlite
- **Environment**: PHP 8.4,vscode, laravel Herd, Composer

### Getting Started

#### Prerequisites

- **PHP** >= 8.4
- **Composer**
- **Node.js & npm**
- **Git**
- **Laravel Herd**
- **Any database gui that support sqlite**

#### Installation

1. **Clone the repository**

  
   git clone https://github.com/Alimam24/company-management-system.git
   cd company-management-system
   2. **Install PHP dependencies**

  
   composer install

   3. **Install front-end dependencies (optional or just use the cdn for tailwind)**

  
   npm install
   npm run build   # or: npm run dev

   4. **Environment configuration**

  
   cp .env.example .env
      - Update database credentials in `.env`:
     - `DB_DATABASE`
     - `DB_USERNAME`
     - `DB_PASSWORD`
   - Set `APP_NAME`, `APP_URL`

5. **Generate application key**

  
   php artisan key:generate
   6. **Run migrations and seeders**

  
   php artisan migrate
   # php artisan db:seed   
   7. **Serve the application**

  
   php artisan serve
      The app will be accessible at `http://127.0.0.1:8000` by default.

### Usage

Here is a **clean, ready-to-paste README text** (no explanations, no extras):

---

## 🔐 Authentication & Access Control

Access to the system is restricted to company employees only so there is no registration form.
For demonstration purposes, the following credentials can be used to log in:

| Department                   | Username    |
| ---------------------------- | ----------- |
| Headquarters                 | `head`      |
| Human Resources              | `employee`  |
| Marketing & Customer Contact | `customer`  |
| Retail Store Management      | `store`     |
| Warehouse Management         | `warehouse` |
| Product Management           | `product`   |

**Password (for all accounts):**

```
password
```

### Manager Access

To log in as a manager, add the letter **`M`** before the username.
Example:

```
Memployee
```

Each user account is linked to an employee record and a department.
The assigned department controls module visibility, permissions, and available quick actions.

---


- **Dashboard**
  - View real-time counts for employees, customers, products, stores, and warehouses.
  - Use the **Quick Actions** section to:
    - Add employees, customers, products, stores, warehouses.
    - Access department management (for admins).
    - Manage marketing offers and other department-specific features.

- **Navigation**
  - Use the main navigation/menu to move between modules: Employees, Customers, Products, Stores, Warehouses, Departments, Marketing Offers, etc.

### Project Structure 

- `app/` – Laravel application logic (models, controllers, services).
- `resources/views/` – Blade templates for the UI.
  - `home.blade.php` – Main dashboard view.
- `routes/` – Route definitions (web and API).
- `database/migrations/` – Database table definitions.
- `public/` – Public assets (built CSS/JS, images).

### Environment & Configuration

- All application-level configuration is managed via the `.env` file and `config/` files.
- Common settings:
  - `APP_ENV`, `APP_DEBUG`, `APP_URL`
  - Database connection settings
  - Mail configuration (for notifications, if used)
  - Queue and cache drivers, if enabled

### Contributing

Contributions are welcome. To contribute:

1. Fork the repository.
2. Create a new branch for your feature or bug fix:
  
   git checkout -b feature/my-new-feature
   3. Commit your changes with clear messages.
4. Open a Pull Request describing your changes and any context.


### Contact

For questions, suggestions, or support:

- **Author**: MHD Walid Alimam
- **Email**: walid.alimam24@gmail.com
- **GitHub**: https://github.com/Alimam24
