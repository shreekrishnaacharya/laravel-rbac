# Skacharya\LaravelRbac

**Description:**

Empower your Laravel applications with dynamic, real-time, and user-friendly role-based access control (RBAC). Effortlessly manage user permissions by associating roles with specific routes, stored in a database for maximum flexibility and control. With this rbac will not only dynamically customize user premission but also customize application interface as runtime. You do not even need to write much code on backend as well as on frontend as all premission are check based on route and associated role assignrd to user which is managed at backend and the ant designed react interface provides you easyto use interface where you can create roles assign roles to user and define the premission for each route to role. You can even manage group of route you want to inforce rbac or hide the route which you do not want to include in rbac.

**Features:**

- **Effortless Route Listing:** Automatically lists all defined Laravel routes for easy management.
- **Seamless Role Creation:** Create custom roles with specific permissions to tailor access to different user groups.
- **Granular Route Assignment:** Assign individual routes to roles, defining which users can access certain functionalities.
- **Multi-Role User Assignment:** Assign multiple roles to users for flexible permission management.
- **Dynamic Real-Time Authorization:** Enforces access control rules instantly, ensuring users only access authorized routes.
- **User-Friendly Experience:** Streamlines RBAC implementation with less code to write for a smooth developer experience.
- **Customize the user interface bynamically:** Hide or show the navigation button 

**Installation:**

1. Install via Composer:

    ```bash
   composer require skacharya/laravel-rbac:*

2. Publish configuration (if required):

    ```bash
   php artisan vendor:publish --provider="Skacharya\LaravelRbac\SkRbacServiceProvider"
   //or for indivisual vendor dir
   //eg for view
   php artisan vendor:publish --tag="skrbac_view"
   //for public
   php artisan vendor:publish --tag="skrbac_public"
   //for config
   php artisan vendor:publish --tag="skrbac_config"
   ```

3. Run database migrations:

    ```bash
   php artisan migrate


**Uses:**

1. Update `skrbac.php`

   Open file skrbac.php inside config folder change and the configuration as per your need.

   - **user_model:**  Define your user model classname that you will use for authentication. example `'user_model'=>App\Models\User::class`
   - **groups:** Add all route group name that needs to be included for rbac. example all route group name starting with `admin.` will be added into rbac route list
   - **routes:** Add complete name of route that you want to be included into rbac route list. Mostly the route that doesnot fall under group defined above option.
   - **except_routes:** Add complete name of route that you want do not want to be included into rbac. Sometime there could be some route inside group that you do not want to include in rbac

   Example :
   ```bash
   return [
    'user_model' => App\Models\User::class,
    'groups' => ['admin.'], //or ['admin.post.'] // can include starting name of route
    'routes' => ['user.post.list'], // must include complete name of route
    'except_routes' => ['admin.logout','admin.dashboard'] // must include complete name of route
    ];

2. Visit url example 'http://localhost:8000/skrbac/home'

   This will list all the role define. Incase of empty list, you can start by adding new roles with create new role button.
   Creating new role, you will enter role name and select assigned user.

3. Once role is created, you can click on key icon and view list of routes. By default all routes are allowed to access to all user. You can allow or denied
   each route by clicking switch buttons.

4. Middleware `\Skacharya\LaravelRbac\Middlewares\RbacFilter::class`

   You can add middleware `\Skacharya\LaravelRbac\Middlewares\RbacFilter::class` to the middleware group. 
   
   Example you can open app\Http\Kernel.php 
   ```bash
       protected $middlewareGroups = [
        'web' => [
        //    ...other middleware
            \Skacharya\LaravelRbac\Middlewares\RbacFilter::class
        ],
    ];
    ```
5. Route setup

   While setting your route follow the practice of grouping your route and giving name to your each route.
   Example :
   ```bash
    Route::group(['prefix' => 'demo', 'as' => 'admin.'], function () {
            Route::get('post', [ExampleController::class, 'index'])->name("post.index");
            Route::post('post', [ExampleController::class, 'store'])->name("post.store");
            Route::get('post/{post}', [ExampleController::class, 'show'])->name("post.show");
            Route::put('post/{post}', [ExampleController::class, 'update'])->name("post.update");
            Route::delete('post/{post}', [ExampleController::class, 'delete'])->name("post.delete");
    });
    ```
    Here 'admin.' is the group name.

6. You can use `\Skacharya\LaravelRbac\SkAccess` class to check if given route is accessable to the current login user or not. For that you can use its static method hasAccess. You can dynamically keep or remove certain route button or a tag depending on the current access of user to that route. This method will return false if user is loggedin and has no access to route else in other all case it return true

    Example :
    ```bash
    @if(SkAccess::hasAccess('demo.post.index'))
        <a href="{{route('demo.post.index')}}">Post</a>
    @endif
    ```


*Notes:* If you want to design you custom view for landing page of rbac. You can define you own route insted of `http://localhost:8000/skrbac/home` and have a div element with id and load js file. ID of div element must be `root`
Example :
Your custom blade file mycustomrbac.blade.php
```bash
@extends('layout/main')
@section('content')
<div id="root"></div>
@endsection
@push('footer_script')
    <script defer="defer" type="module" src="/vendor/laravel-rbac/js/skrbac.js"></script>
@endpush
```
Github:

Want to explor the code for free.

We appreciate your star and fork on github :
https://github.com/shreekrishnaacharya/laravel-rbac

Contributing:

We welcome contributions! Please see Contribution Guidelines: https://github.com/shreekrishnaacharya/laravel-rbac/blob/main/CONTRIBUTING.md

License:

Open-source licensed under the MIT license: https://opensource.org/licenses/MIT

Credits:

Developed by Shree Krishna Acharya: https://www.linkedin.com/in/shree-krishna-acharya/
Built on top of the amazing Laravel framework
