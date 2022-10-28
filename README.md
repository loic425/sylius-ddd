# Domain Driven Design and Sylius Resource 2

An example project of **Domain Driven Design** using **Sylius Resource 2** and following the **hexagonal architecture**.

This project is based on [Domain Driven Design and API Platform 3](https://github.com/mtarld/apip-ddd)

This example has been explained during the [API Platform conference 2022](https://api-platform.com/con/2022/conferences/domain-driven-design-with-api-platform-3/)
([slides](https://slides.com/mathiasarlaud/apip-con-ddd-api-p-3), [video](https://www.youtube.com/watch?v=SSQal3Msi9g)).

## Getting started
If you want to try to use and tweak that example, you can follow these steps:

1. Run `git clone https://github.com/loic425/sylius-ddd` to clone the project
2. Run `composer install` to install the project 
3. Run `symfony console doctrine:database:create` to create the database
4. Run `symfony console doctrine:schema:create` to create the schema
5. Run `docker-compose up -d` to run the containers
6. Run `symfony serve -d` to up your local server
7. Visit https://localhost:8000/admin and play with your app!

## Contributing
That implementation is pragmatic and far for being uncriticable.
It's mainly an conceptual approach to use API Platform in order to defer operations to command and query buses.

It could and should be improved, therefore feel free to submit issues and pull requests if something isn't relevant to your use cases or isn't clean enough.

To ensure that the CI will succeed whenever contributing, make sure that either static analysis and tests are successful by running `make ci`

## Authors

[Loïc Frémont](https://github.com/loic425)

For the initial project:
[Mathias Arlaud](https://github.com/mtarld) with the help of [Robin Chalas](https://github.com/chalasr)
