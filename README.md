# Kanban Backend

## Requirements
- PHP 8.3
- Composer
- Docker

## Installation
1. Clone the repository
2. Run `composer install` to install dependencies
3. Copy `.env.example` to `.env` and configure your environment variables
`cp .env.example .env`
4. Run `php artisan key:generate` to generate the application key
5. Run `sail up -d` to start the application to start the application in the background
6. Run `sail artisan migrate` to run the database migrations
