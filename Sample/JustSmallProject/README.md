# Challenge Your Self

## Introduction

This small challenge project consists of 3 parts:

1. Writing PHP and SQL
2. Refactoring code
3. Writing unit tests

Having a PHP environment installed and configured is a prerequisite to this project.

## Getting Started

### Install the project dependencies

    # composer install --prefer-dist

Note: If you don't have `composer` installed globally you can follow the instructions here: [Composer download](https://getcomposer.org/download/)

### Running the tests

    # bin/phpunit

### Running the web server

    # php bin/console server:run

You should now be able to visit the web application at [http://localhost:8000/](http://localhost:8000/) in your browser.
Currently it is in a "broken" state as none of the required functionality has been implemented.

## 1. Making the tests pass

After making the failing tests pass you will have implemented all the required features on the site.
You can verify the site is working correctly by browsing it and interacting with it after.

All the code you will need to write is contained to a single file: `Sample\JustSmallProject\Repository\DoctrineMemberRepository`.

No test code should be changed.

The database connection is available within the repository class from the parent class `Repository::getConnection`.

## 2. Refactoring

There is a well tested class `Sample\JustSmallProject\Command\DumpTableStructure` that needs some clean-up.

Go through the code and make any changes you feel would simplify the code and make it more readable.

To run only the `DumpTableStructure` tests use the following command:

    bin/phpunit --filter DumpTableStructure

No test code should be changed.

## 3. Testing

Currently the `Model\Member` class is un-tested. Add some unit tests for it.

    bin/phpunit --filter Member

To check the coverage use the following command:

    bin/phpunit --filter Member --coverage-text

## Other commands

    # bin/console generate:members <number>

## Helpful Resources

[Doctrine DBAL](http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/) - Wrapper for [PHP PDO](http://www.php.net/manual/en/book.pdo.php)
