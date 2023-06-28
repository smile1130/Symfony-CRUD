# Symfony App(Simple CRUD)

A web application for managing football teams, players, and player transfers.

## Features

- Display teams and their players with pagination.
- Add new teams and players.
- Facilitate player transfers between teams.

## Requirements

- PHP 8.1 or higher
- Symfony 5.3 or higher
- MySQL or PostgreSQL database

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/your-username/player-app.git
   ```
2. Install dependencies using Composer:

	```bash
	composer install
	```
3. Configure the database connection in the .env file:
	
	```bash
	DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
	```
4. Run database migrations:

	```bash
	php bin/console doctrine:migrations:migrate
	```
5. Start the local development server:
	
	```bash
	symfony server:start
	```

## Contributing

	Contributions are welcome! If you find any issues or have suggestions for improvements, please open an issue or submit a pull request.

## Credits

This project is built using the following technologies and frameworks:

- [Symfony PHP Framework](https://symfony.com/)
- [Doctrine ORM](https://www.doctrine-project.org/)
- [Twig Template Engine](https://twig.symfony.com/)
- [Bootstrap CSS Framework](https://getbootstrap.com/)

Feel free to modify this list to include any additional credits or acknowledgments for libraries, tools, or resources used in your project.
