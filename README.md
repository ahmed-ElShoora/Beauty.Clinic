# Booking Site for Beauty Clinc

# Architecture Decisions
1. **MVC + Service Layer**: Controllers handle requests only, business logic moved to Services for clean and scalable code
2. **Form Requests** : Used for validation to keep controllers clean.
3. **Admin Panal**: Admin Control Panel for change and display data in site and ....

## Set Up Project :
1. composer install
2. cp .env.example .env
3. php artisan key:generate
4. setUp db info
4. php artisan migrate
5. php artisan db:seed

## run project
1. in terminal 1 : php artisan serve --port=8000

## user for test
1. email = admin@admin.com
2. password = password