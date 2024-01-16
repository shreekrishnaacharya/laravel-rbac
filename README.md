# Sk\LaravelRbac

**Description:**

Empower your Laravel applications with dynamic, real-time, and user-friendly role-based access control (RBAC). Effortlessly manage user permissions by associating roles with specific routes, stored in a database for maximum flexibility and control.

**Features:**

- **Effortless Route Listing:** Automatically lists all defined Laravel routes with your defined guards and stores them in a database table for easy management.
- **Seamless Role Creation:** Create custom roles with specific permissions to tailor access to different user groups.
- **Granular Route Assignment:** Assign individual routes to roles, defining which users can access certain functionalities.
- **Multi-Role User Assignment:** Assign multiple roles to users for flexible permission management.
- **Dynamic Real-Time Authorization:** Enforces access control rules instantly, ensuring users only access authorized routes.
- **User-Friendly Experience:** Streamlines RBAC implementation for a smooth developer experience.

**Installation:**

1. Install via Composer:

    ```bash
   composer require your-vendor-name/your-package-name

2. Publish configuration (if required):

    ```bash
   php artisan vendor:publish --provider="Sk\LaravelRbac"

3. Run database migrations:

    ```bash
   php artisan migrate


Contributing:

We welcome contributions! Please see Contribution Guidelines: https://your-contribution-guidelines-url

License:

Open-source licensed under the MIT license: https://opensource.org/licenses/MIT

Credits:

Developed by Shree Krishna Acharya: https://your-website-url
Built on top of the amazing Laravel framework