## Installation

Clone the repository
```ssh
# Clone the repo
git clone git@github.com:justsanjit/jumbleberry.git

# create environment file and set database configuration
cd jumbleberry
cp .env.example .env

# Install dependencides
composer install
npm install
npm run dev

# Run migrations
php artisan migrate --seed

# Start queue
php artisan queue:work
```
