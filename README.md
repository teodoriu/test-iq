# Laravel Upgrade Challenge

This is a **technical assessment** for Laravel developers. Your task is to **analyze and upgrade a Laravel 10 application to Laravel 12**, while ensuring that everything continues to work as expected.

---

## 🧠 Objective

Upgrade this Laravel 10 application to Laravel 12 and refactor/update the code where necessary to meet modern standards and best practices.

---

## 🔍 Evaluation Criteria

- ✅ Correct and complete upgrade to Laravel 12
- ✅ Clean, PSR-12-compliant code
- ✅ Functional application after upgrade
- ✅ Fixed or updated deprecated features or breaking changes
- ✅ Ability to identify and resolve upgrade blockers
- ✅ Passing automated tests

## 🚀 Setup Instructions

```bash
git clone https://github.com/teodoriu/test-iq
cd test-iq

# Create your .env file
cp .env.example .env

# Install dependencies
composer install
npm install && npm run build

# Set up the database
php artisan migrate
php artisan db:seed

# Run the queue
php artisan queue:work

# Run the app
php artisan serve

🎯 Your Task

Check TASKS.md

Commit your changes cleanly and provide clear commit messages

Submit a link to your Git repository

💡 Tips

Review the Laravel 11 Upgrade Guide and Laravel 12 upgrade notes

You may refactor for clarity, but don't add extra features

Feel free to add comments where you make non-trivial changes

Good luck! 🍀