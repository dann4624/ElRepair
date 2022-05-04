# Elgiganten Repair Admin Panel
## Installation
### Prerequisites
- A webserver such as Apache 
- PHP 8.0 or newer
- MySQL or similar Database
- Composer 2.3.0 or newer

### CLI Commands to Run
#### Install Dependencies
<code>composer install</code>
#### Update Dependencies
<code>composer update</code>
### Create .env File
- For Windows: <code>copy .env.example .env</code>

- For Linux/Mac: <code>cp .env.example .env</code>
#### Generate App Key
<code>php artisan key:generate</code>
#### Update the .env File
In the .env file update the following fields to match your server and database:
- <code>APP_URL</code>
- <code>DB_CONNECTION</code>
- <code>DB_HOST</code>
- <code>DB_PORT</code>
- <code>DB_DATABASE</code>
- <code>DB_USERNAME</code>
- <code>DB_PASSWORD</code>
#### Clear Cache
<code>php artisan cache:clear</code>
#### Update Cache
- <code>php artisan route:cache</code>
- <code>php artisan view:cache</code>
- <code>php artisan config:cache</code>
#### Run Migrations
<code>php artisan migrate</code>
