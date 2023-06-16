# Bike_Challenge_Alen_Huric

Run the following command to install the necessary dependencies using Composer:
composer install

Install the Symfony CLI by visiting https://symfony.com/download and following the installation instructions. Once installed, start the Symfony server with the following command:
symfony server:start

Install the required database on your machine. If you're using MySQL with Docker, execute the following command to start the MySQL container:
docker-compose up -d
Remember to modify the database name, username, or password in the .env file according to your setup.

Once the database is running, create the necessary database tables by running the following command:
php bin/console doctrine:migrations:migrate
You can also use the short form: d:m:m.

To load dummy data into your database for testing purposes, use the following command:
php bin/console doctrine:fixtures:load
Again, you can use the short form: d:f:l.

By following these steps, you will have successfully installed the dependencies, started the Symfony server, set up the database, and loaded any required dummy data.
