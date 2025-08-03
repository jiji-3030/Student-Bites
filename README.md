# 📚 Student Bites

**College Recipes** is a student-friendly blog platform where users can share and discover easy, affordable, and quick meals tailored for college life. Whether you're on a budget, rushing between classes, or stuck with leftovers — there's a recipe here for you.

---

## ✨ Project Highlights

* 📝 Create, edit, and delete recipe posts
* 👨‍🍳 Public blog page to browse all recipes
* 🧠 Categories include:

  * ⚡ Quick Recipes
  * 🥗 No-Cook Meals
  * ♻️ Leftover Hacks
  * 💸 Budget Meals
  * ✋ 5-Ingredient Recipes
* 🌈 Unique theme per category (color-coded UI)
* 👤 Show author (username) per post
* ✅ Only post owners can delete
* 🔍 Filter recipes by category
* 🖌️ Clean Tailwind CSS design

---

## 🛠️ Built With

* Laravel 11
* MySQL
* Tailwind CSS
* Alpine.js
* Blade Templates
* Pest (Testing Framework)

---

## 🚀 Getting Started

1. **Clone the Repository**

   ```bash
   git clone https://github.com/jiji-3030/mini-blog.git
   cd mini-blog
   ```

2. **Install Dependencies**

   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Set Up Environment File**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure your `.env` file with your database credentials**

5. **Run Migrations and Seeders**

   ```bash
   php artisan migrate --seed
   ```

6. **Serve the Application**

   ```bash
   php artisan serve
   ```

   Visit [http://localhost:8000](http://localhost:8000) in your browser.

---

## ✅ Features Overview

| Feature               | Description                                   |
| --------------------- | --------------------------------------------- |
| 🧑‍🍳 Recipe Posting  | Users can create and manage their own recipes |
| 🧭 Category Filtering | Easily browse recipes by type                 |
| 🛡️ Authorization     | Only recipe owners can delete posts           |
| 🎨 Dynamic Themes     | Each category has a unique style              |
| 📱 Responsive         | Mobile-friendly design with Tailwind CSS      |

---

## 📂 Folder Structure

```
app/
resources/views/
routes/web.php
database/seeders/
```

---

## 🧪 Testing

```bash
php artisan test
```

Or using Pest:

```bash
./vendor/bin/pest
```
