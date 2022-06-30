# Techband challenge

## Technologies
- Laravel
- Sanctum
- Vue
- Vuetify

## Usage
Clone the repository

For backend:

1. Run `composer install`
2. Copy `.env.example` file to `.env` on the root folder.
3. Fill `DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD` values in `.env`.
4. Run `php artisan key:generate`
5. Run `php artisan migrate`
6. Run `php artisan db:seed`
7. Run `php artisan serve`

For frontend:

1. Run `npm install`.
2. Run `npm run dev`.
3. Open app on `127.0.0.1:8000`
4. As admin (`127.0.0.1:8000/admin`) login with email "admin@mail.com" and password "password"
5. As user (`127.0.0.1:8000/`) login with email "test@mail.com" and password "password" or sign up
