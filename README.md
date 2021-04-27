# Electronic Bookstore / Elektronické knihkupectví
English version below

# Czech description
## Instalace
Prerekvizity:
- PHP 7.3 nebo vyšší
- Composer
- Databázový server (MySQL nebo PostgreSQL)
- Webový server (Apache2)
- Alternativně je možné použít WAMP/XAMPP stack

Postup instalace:

```
composer install
npm install
npm run dev
cp .env.example .env
php artisan key:generate
php artisan storage:link
php artisan migrate
php artisan db:seed --class=TestSeeder
```

*Pravděpodobně bude nutné manuálně nastavit databázi před zahájením migrace*

Přístup k administraci (pouze s naseedovanou databází): <br>
Email: *admin@admin.com* <br>
Heslo: *password*

## Projekt
Tento prototyp elektronického knihkupectví byl vypracován jako součást praktické části mé bakalářské práce s názvem *Objektový návrh elektronického knihkupectví* na Fakultě aplikované informatiky Univerzity Tomáše Bati ve Zlíně. Součástí projektu je plně funkční katalog knih s možností vyhledávání produktů, funkčním košíkem i objednávkovým procesem. Je také možné přistoupit jak k uživatelské, tak k administrátorské sekci pro správu jednotlivých součástí aplikace. Autentizace je řešena pomocí knihovny Laravel Jetstream, front-endová část je stavěna na TailwindCSS a Laravel Livewire pro interaktivní prvky, jako je například košík.

# English description

## Installation

Requirements:
- PHP 7.3 or higher
- Composer
- Database server (MySQL or PostgreSQL)
- Webserver (Apache2)
- Alternatively, WAMP/XAMPP stack can be used

How to install:

```
composer install
npm install
npm run dev
cp .env.example .env
php artisan key:generate
php artisan storage:link
php artisan migrate
php artisan db:seed --class=TestSeeder
```

*Manual database setup might be needed before running the migrations*

Admin panel access (note that this credentials are only generated with the database seeded as listed above):<br>
Email: *admin@admin.com* <br>
Password: *password*

## Project
This electronic bookstore prototype has been created for my bachelor thesis *Object-Oriented Design of a Bookstore*. This project contains fully functional product catalogue, which provides options to search for books by their names or ISBN. It also features interactive cart and ordering system. The application has user and admin sections for accessing various parts of it's functionality. Laravel Jetstream has been used for authentication in the appliaction. On the front-end, Laravel Livewire and TailwindCSS were used.
