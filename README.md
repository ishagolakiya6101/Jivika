# Jivika Fullstack Platform

Jivika is a fullstack platform inspired by UrbanClap, providing a user interface for service booking and management. This repository contains both the Vue.js-based frontend and the Laravel-based backend for Jivika, enabling users to browse, book, and manage various services.

---

## Project Structure

- [`jivika-frontend/`](jivika-frontend) - Vue.js frontend application
- [`jivika-backend/`](jivika-backend) - Laravel backend/API server

---

## Prerequisites

- [Node.js](https://nodejs.org/) (v12+ recommended)
- [npm](https://www.npmjs.com/)
- [PHP](https://www.php.net/) (v8.0+ recommended)
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/) or compatible database

---

## Setup Instructions

### 1. Backend (Laravel)

**Install dependencies:**
```sh
cd jivika-backend
composer install
```

**Environment setup:**
- Copy `.env.example` to `.env` and update database credentials.
- Generate app key:
  ```sh
  php artisan key:generate
  ```

**Database migration:**
```sh
php artisan migrate
```

**Start backend server:**
```sh
php artisan serve
```
Backend will run at `http://localhost:8000/` by default.

---

### 2. Frontend (Vue.js)

**Install dependencies:**
```sh
cd jivika-frontend
npm install
```

**Development server:**
```sh
npm run serve
```
Frontend will run at `http://localhost:8080/` by default.

**Production build:**
```sh
npm run build
```

**Linting:**
```sh
npm run lint
```

---

## API Integration

- The frontend communicates with the backend via RESTful APIs.
- Update API endpoints in the frontend configuration as per your backend server URL.

---

## Folder Overview

### jivika-frontend

- `src/` - Main Vue.js application source code
- `public/` - Static assets
- `package.json` - Frontend dependencies and scripts

### jivika-backend

- `app/` - Laravel application code
- `routes/` - API and web routes
- `public/` - Public assets
- `database/` - Migrations and seeders
- `composer.json` - Backend dependencies

---

## Usage

1. **Install dependencies for both frontend and backend.**
2. **Configure environment variables for backend.**
3. **Run migrations to set up the database.**
4. **Start both servers and access the platform via the frontend URL.**

---

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

---

## License

This project is licensed under the MIT License.

---

### Customize configuration

See [Vue CLI Configuration Reference](https://cli.vuejs.org/config/) and [Laravel Documentation](https://laravel.com/docs).