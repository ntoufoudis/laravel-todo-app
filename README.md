## Getting Started
To run this project locally, follow these steps:
1. Clone the repository
```angular2html
git clone https://github.com/ntoufoudis/.git
```
2. Navigate to the project directory:
```angular2html
cd todo-app
```
3. Install dependencies:
```angular2html
composer install
npm install
```
4. Create .env file:
```
cp .env.example .env
```
5. Generate application key:
```angular2html
php artisan key:generate
```
6. Configure database connection in the .env file:
```angular2html
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```
7. Run database migrations:
```angular2html
php artisan migrate
```
8. Compile assets:
```angular2html
npm run dev
```
9. Start development server:
```angular2html
php artisan serve
```
10. Visit http://localhost:8000 to access the application
