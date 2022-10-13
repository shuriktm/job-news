# Test News service

The simple news feed and admin panel based on [Laravel](https://laravel.com/) PHP framework.

It uses only core features (no third party packages) and [Bootstrap](https://getbootstrap.com/) for user interface.

## Installation

- Install [Docker](https://www.docker.com/)
- Clone the repo to the project directory
- Run `docker-compose up` in the project directory

## Usage

### Setup

- Migrations are applied automatically
- Database seeders create items randomly
  - 30 to 50 categories
  - 100 to 200 posts

### News feed

- Open news feed on [localhost:8000](http://localhost:8000/)
- Home page displays all published posts
  - It has categories list on the right side
  - Click on post title to open its page
  - Click on category to open its page with the similar feed
- Posts sorted by `publish_at` timestamp 
  - Posts are visible if `publish_at` timestamp is earlier than now
- URLs use slugs for category and post pages (for SEO needs)

### Manager

- Open admin panel on [localhost:8000/manager](http://localhost:8000/manager)
  - Or just log in to account using navbar menu
- Use the following credentials to log in:
  - Email: `admin@example.com`
  - Password: `admin`
- You can manage categories and posts
  - Create, update, delete and restore
  - Posts, assigned to the deleted category, will be hidden in the news feed
  - You can filter posts by category or title

## Database

- MySQL server is available on IP 127.0.0.1 and port 8006

## Developers

- You can adjust settings in `docker-compose.yml` if it conflicts with your local environment
