# Plog Post

My first Laravel project — a blog-style application built with **Laravel 13**.

## About

This is a learning project where I'm building out a blog app from scratch and getting hands-on with core Laravel concepts: models, relationships, authentication, and authorization.

## Features

- **Users, Posts, and Comments** — core models with relationships between them
- **Authentication** via Laravel's built-in session-based auth
- **Authorization** using Gates and Policies
- **Soft deletes & cascade logic** handled through model `booted()` events
- Seeders and factories for test data
- Query filtering on the posts listing

## Stack

- Laravel 13
- PHP
- Session-based auth (Laravel default)
- MySQL

## Roadmap

- Build a **React** frontend
- Currently also experimenting with a Blade/Bootstrap frontend alongside it

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

## Notes

This is a learning project — first real dive into Laravel — so the code evolves as I pick up new concepts along the way.
