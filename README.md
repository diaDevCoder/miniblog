# 📝 Blog API & Frontend (Demo Project)

This project is a simple **Blog application** built with Laravel.  
It supports **authentication**, **CRUD for blog posts**, and **public access to posts**.  

## 🎯 Features

### Core Requirements
- ✅ User registration & login (**session-based auth using sanctum**)
- ✅ Authenticated users can:
  - Create, update, delete, and view their own blog posts
- ✅ Blog posts have:
  - Title
  - Body
  - Author (linked to user)
  - Created & updated timestamps
- ✅ Public users can:
  - View all posts
  - View a single post

### ⭐ Bonus
- 🔍 Search posts by title/body
- 📄 Pagination on posts list
- 🎨 Simple frontend (Blade/HTML/CSS/JS)
  - Public post listing
  - Single post page
  - Authenticated form to create posts

---

## ⚙️ Requirements

- PHP >= 8.1  
- Composer >= 2.0  
- MySQL 
---

## 🚀 Setup Instructions

### 1. Clone Repository
```bash
git clone https://github.com/diaDevCoder/miniblog.git
cd miniblog
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Setup
Copy `.env.example` to `.env`:
```bash
cp .env.example .env
```

Update your `.env` with database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=miniblog_db
DB_USERNAME=root
DB_PASSWORD=
```
Import the miniblog_db.sql file form the database directory

set laravel application key:
```bash
php artisan key:generate
```

### 4. Run Migrations If you don't want to use the exported file. Ignore if you have already imported the db file.
```bash
php artisan migrate
```

(Optional) Seed some dummy data:
```bash
php artisan db:seed
```

### 5. Start Development Server
```bash
php artisan serve
```

App will be available at:
```
http://127.0.0.1:8000
```

---

## 📡 API Endpoints

| Method | Endpoint                 | Description                  | Auth |
|--------|--------------------------|------------------------------|------|
| POST   | `/api/user/register`     | Register a new user          | ❌   |
| POST   | `/api/user/login`        | Login user                   | ❌   |
| GET    | `/api/posts`             | List all posts               | ❌   |
| GET    | `/api/posts/{id}`        | View single post             | ❌   |
| POST   | `/api/user/posts`        | Create new post              | ✅   |
| PUT    | `/api/user/posts/{id}`   | Update own post              | ✅   |
| DELETE | `/api/user/posts/{id}`   | Delete own post              | ✅   |
| GET    | `/api/posts?search=term` | Search posts                 | ❌   |
| GET    | `/api/posts?page=2`      | Paginated posts              | ❌   |

---

## 🧪 Testing the API

- Use the documentation from postman
https://documenter.getpostman.com/view/35111721/2sB3HtEbb5
```

## 📜 License

MIT License – feel free to use for learning and assessments.
