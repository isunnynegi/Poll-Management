# Poll Management System (Laravel 13 + Livewire + Reverb)

A complete real-time Poll Management System built with clean architecture (Repository + Service Layer).

## Features
- **Admin Panel**: Register, Login, Dashboard, Poll CRUD.
- **Real-time Results**: Live progress bars updating via WebSockets (Laravel Reverb).
- **Secure Voting**: Restricts multiple votes via IP (guests) or User ID (logged-in).
- **UUIDs**: All database tables use UUIDs as primary keys.
- **Audit Fields**: Every record tracked with `created_by`, `updated_by`, and `deleted_by`.

## Setup Instructions

1. **Clone & Install**
   ```bash
   composer install
   npm install
   ```

2. **Environment Configuration**
   - Copy `.env.example` to `.env`.
   - Configure your database (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
   - Run `php artisan key:generate`.

3. **Database Migrations**
   ```bash
   php artisan migrate
   ```

4. **Start the Application**
   ```bash
   # Terminal 1: Dev Server
   php artisan serve

   # Terminal 2: WebSockets (Reverb)
   php artisan reverb:start

   # Terminal 3: Asset Bundling
   npm run build
   ```

## How to Test Real-time Voting
1. Create a poll in the admin dashboard.
2. Open the public poll link in two different browsers (or one browser and one incognito).
3. Vote in one window.
4. Watch the status bar update immediately in the other window without refreshing!

## Running Tests
```bash
php artisan test
```

## Architecture
- **Repositories**: `app/Repositories` - Abstract data access.
- **Services**: `app/Services` - Business logic and orchestration.
- **Livewire**: `app/Livewire` - Interactive UI components.
- **Models**: `app/Models` - Eloquent models with UUID and Audit traits.
