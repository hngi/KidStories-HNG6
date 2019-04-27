# Kidstories
Kid Stories

# Guide to Contribute
1. Fork the repo to your GitHub account
2. Clone to repo to your local
3. Checkout BE
```
git checkout BE
```
4. Set up your project. **(See the Initial Set Up section below)**
5. Make your changes
6. Push your changes to your repo
7. Make a PR to the project repo, select compare across forks
8. In the dropdown section, select the BE branch
9. Make the PR

# Initial Set Up
1. Create .env file by running; create .env.example file manually if not found
```
cp .env.example .env
```
2. Install dependencies
```
composer install
```
3. Update .env with your database details
```
DB_DATABASE=YOUR_DATABASE_NAME
DB_USERNAME=YOUR_DATABASE_USERNAME
DB_PASSWORD=YOUR_DATABASE_PASSWORD
```
4. Generate laravel application key
```
php artisan key:generate
```
5. Migrate tables
```
php artisan migrate
```
6. Create encryption keys for [Laravel Passport](https://laravel.com/docs/5.8/passport)
```
php artisan passport:install
```
7. Start server
```
php artisan serve
```
8. Test to see if API is up. Launch Postman or Insomia and send a GET request to
```
http://localhost:8000/api/v1/test
```
You should get a response:
```
{
  "message": "You are set!"
}
```
