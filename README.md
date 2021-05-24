# TrackTik Back-End Challenge

## How was it organized?

### Folder Structure

The folder structure is separated as follows:

- app
    - Console
        - Command: Commands of project
    - Entities: Objects of Electronic Items
    - Helpers: Auxiliar classes
    - Interfaces: Interfaces of the project
    - Services: Project business rules
- storage: Place to file stored
- testes: Unit tests
- vendor: Third library files
- application.php: The initial application file
- composer.json : Dependency manager

### Stack

The main stack where this code was developed contained:

- Ubuntu 20.04
- PHP 8.0.5
- Composer
- PHPUnit
- Console

## How to execute?

Follow these steps to run this project:

* Install the dependencies
    - composer-install

* Execute this command
    - php application.php command:shopping

* In the root directory, execute this command to run the tests
    - ./vendor/bin/phpunit tests