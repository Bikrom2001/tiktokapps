<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Class -30

- [Class -30](#class--30)
  - [Project Setup](#project-setup)
  - [Home & Contact Routes](#home--contact-routes)
  - [Contact View](#contact-view)
  - [Basic Controller Setup](#basic-controller-setup)
  - [Passing Data From Controller To Route](#passing-data-from-controller-to-route)
  - [Showing User Data In The View](#showing-user-data-in-the-view)
  - [Showing Multiple Users](#showing-multiple-users)
  - [Migrate The Users Table](#migrate-the-users-table)
  - [Factories & Seeders — 30 Fake Users](#factories--seeders--30-fake-users)
  - [Show Real Database Data In The UI](#show-real-database-data-in-the-ui)
  - [Styling The Table With Bootstrap](#styling-the-table-with-bootstrap)
  - [Project Structure](#project-structure)
  - [Final Output](#final-output)

This README follows the actual **commit history** of the project — every section below matches one real commit, in the same order they were built. This is a **Laravel** project (PHP), not Django — routing, controllers, views (Blade templates), migrations, factories, and seeders all follow Laravel's own conventions.

## Project Setup

- Install Laravel via Composer (this project uses Laravel `^13.17`)

  ```sh
  composer create-project laravel/laravel tiktokapps
  cd tiktokapps
  ```

- Copy the example environment file and generate the app key

  ```sh
  cp .env.example .env
  php artisan key:generate
  ```

- Set up the database connection in [.env](./.env.example) (this project uses the default SQLite setup that comes with a fresh Laravel install)

- Run the local dev server

  ```sh
  php artisan serve
  ```

---
[⬆️ Go to Context](#class--30)

## Home & Contact Routes

- Laravel's routing is defined in [routes/web.php](./routes/web.php), not with a separate `urls.py` app-level file like Django — a single file maps URLs directly to either a closure or a controller method

  ```php
  use Illuminate\Support\Facades\Route;

  Route::get('/', function () {
      return view('welcome');
  });

  Route::get("/contact", function(){
      return view('contact');
  });
  ```

- `Route::get('/', function () { ... })` — the home page (`/`) returns Laravel's default `welcome` view, untouched from the fresh install
- `Route::get("/contact", ...)` — a new route added for a simple contact page, using an inline closure (no controller needed yet at this point) that just returns the `contact` view

---
[⬆️ Go to Context](#class--30)

## Contact View

- A plain Blade template created at [resources/views/contact.blade.php](./resources/views/contact.blade.php)

  ```html
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <title>User files</title>
  </head>
  <body>
      <h3>Contact us Page</h3>
  </body>
  </html>
  ```

- `.blade.php` is Laravel's templating engine — similar role to Django's `.html` templates, but with `{{ }}` for output and `@` directives (`@foreach`, `@if`, etc.) instead of `{% %}`

---
[⬆️ Go to Context](#class--30)

## Basic Controller Setup

- Instead of putting logic directly in `routes/web.php`, a dedicated Controller is generated to handle the `/user` route

  ```sh
  php artisan make:controller UserController
  ```

- This creates [app/Http/Controllers/UserController.php](./app/Http/Controllers/UserController.php) — Laravel's equivalent of a Django `views.py` function, but organized as a class with methods

  ```php
  <?php

  namespace App\Http\Controllers;

  class UserController extends Controller
  {
      //
  }
  ```

- The route is then pointed at the controller instead of a closure, in [routes/web.php](./routes/web.php)

  ```php
  use App\Http\Controllers\UserController;

  Route::get("/user", [UserController::class, 'showUser']);
  ```

---
[⬆️ Go to Context](#class--30)

## Passing Data From Controller To Route

- A `showUser` method is added to the controller and a matching [user.blade.php](./resources/views/user.blade.php) view is created

  ```php
  class UserController extends Controller
  {
      public function showUser(){
          return view('user');
      }
  }
  ```

- At this stage, the view is shown with static/placeholder content first — real database data comes in a later commit

---
[⬆️ Go to Context](#class--30)

## Showing User Data In The View

- The controller starts passing actual data into the view using `compact()`, Laravel's shorthand for building a data array from variable names

  ```php
  public function showUser(){
      $users = User::get();

      return view('user', compact('users'));
  }
  ```

- `User::get()` — Laravel's Eloquent ORM equivalent of Django's `Model.objects.all()`, fetches every row from the `users` table
- `compact('users')` — turns the `$users` variable into `['users' => $users]` automatically, so it becomes available inside the Blade template as `$users`

---
[⬆️ Go to Context](#class--30)

## Showing Multiple Users

- [user.blade.php](./resources/views/user.blade.php) loops through `$users` with Blade's `@foreach` directive and renders one table row per user

  ```blade
  <table class="table">
      <thead>
          <tr>
              <th>SL</th>
              <th>Name</th>
              <th>Email</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($users as $key => $user)
              <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                      <a href="">Edit</a>
                      <a href="">Delete</a>
                  </td>
              </tr>
          @endforeach
      </tbody>
  </table>
  ```

- `@foreach ($users as $key => $user)` — same idea as Django's `{% for %}`, but Blade also gives an easy `$key` index directly in the loop, used here for the serial number column (`$key + 1`, since `$key` starts at `0`)
- `{{ $user->name }}` — Blade's output syntax, equivalent to Django's `{{ user.name }}`, but with `->` instead of `.` for accessing model attributes (standard PHP object syntax)

---
[⬆️ Go to Context](#class--30)

## Migrate The Users Table

- Laravel ships with a `users` table migration by default — running it creates the actual database table this whole feature depends on

  ```sh
  php artisan migrate
  ```

- This runs [database/migrations/0001_01_01_000000_create_users_table.php](./database/migrations/0001_01_01_000000_create_users_table.php), which defines the table's columns (`id`, `name`, `email`, `password`, timestamps, etc.)

> [!NOTE]
> Before this commit, `User::get()` in the controller had nothing to fetch — the `users` table didn't exist yet in the database.

---
[⬆️ Go to Context](#class--30)

## Factories & Seeders — 30 Fake Users

- Instead of manually typing in test data, Laravel's **Factories** generate realistic fake data, and **Seeders** run that factory to insert it into the database
- [database/factories/UserFactory.php](./database/factories/UserFactory.php) defines what a fake user looks like

  ```php
  public function definition(): array
  {
      return [
          'name' => fake()->name(),
          'email' => fake()->unique()->safeEmail(),
          'email_verified_at' => now(),
          'password' => static::$password ??= Hash::make('password'),
          'remember_token' => Str::random(10),
      ];
  }
  ```

- `fake()->name()` / `fake()->unique()->safeEmail()` — uses the Faker library bundled with Laravel to generate a random realistic name and a guaranteed-unique email each time
- [database/seeders/DatabaseSeeder.php](./database/seeders/DatabaseSeeder.php) is where the factory actually gets called to create records

  ```php
  public function run(): void
  {
      User::factory(30)->create();

      // User::factory()->create([
      //     'name' => 'Test User',
      //     'email' => 'test@example.com',
      // ]);
  }
  ```

- `User::factory(30)->create()` — runs the factory **30 times**, inserting 30 fake users into the `users` table in one go (this is where "Class -30" and the 30 fake users line up)
- Run the seeder:

  ```sh
  php artisan db:seed
  ```

> [!NOTE]
> The very next commit ("factories and seeders comment now") comments this line back out, so it doesn't insert another 30 rows every time `db:seed` is re-run by accident — a common habit once the data has already been seeded once.

---
[⬆️ Go to Context](#class--30)

## Show Real Database Data In The UI

- With migrations run and 30 fake users seeded, `showUser()`'s existing `User::get()` call (from [Showing User Data In The View](#showing-user-data-in-the-view)) now returns **real rows from the database** instead of an empty collection — no controller code changes were needed at this point, since the data-fetching logic was already written ahead of the data actually existing

---
[⬆️ Go to Context](#class--30)

## Styling The Table With Bootstrap

- The final commit adds Bootstrap 5 (via CDN, loaded from [getbootstrap.com](https://getbootstrap.com)) to [user.blade.php](./resources/views/user.blade.php) for a clean, readable table

  ```html
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  ...
  <table class="table table-bordered table-striped table-hover">
  ```

- `table-bordered` — adds borders around every cell
- `table-striped` — alternating row background colors for readability
- `table-hover` — highlights a row on mouse hover

---
[⬆️ Go to Context](#class--30)

## Project Structure

```txt
tiktokapps/
├── app/
│   ├── Http/Controllers/
│   │   └── UserController.php     # showUser()
│   └── Models/
│       └── User.php
├── database/
│   ├── factories/
│   │   └── UserFactory.php          # fake user data definition
│   ├── migrations/
│   │   └── ..._create_users_table.php
│   └── seeders/
│       └── DatabaseSeeder.php         # User::factory(30)->create()
├── resources/
│   └── views/
│       ├── welcome.blade.php
│       ├── contact.blade.php
│       └── user.blade.php              # user list table (Bootstrap styled)
├── routes/
│   └── web.php                          # /, /contact, /user routes
├── .env.example
├── composer.json
└── artisan
```

---
[⬆️ Go to Context](#class--30)

## Final Output

- `http://127.0.0.1:8000/` → Laravel's default welcome page
- `http://127.0.0.1:8000/contact` → Simple contact page
- `http://127.0.0.1:8000/user` → Table of 30 seeded fake users (Name, Email, Edit/Delete placeholder links), styled with Bootstrap

**Flow:** Set up routes → controller → view → migrate `users` table → seed 30 fake users via factory → display them in a styled table

---
[⬆️ Go to Context](#class--30)
