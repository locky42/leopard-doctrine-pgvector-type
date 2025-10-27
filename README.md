# Leopard Doctrine PGVector Type

This project provides a custom Doctrine type for integrating PGVector, a PostgreSQL extension for vector similarity search, into your PHP applications.

## Features

- Seamless integration of PGVector with Doctrine ORM.
- Support for storing and querying vector data.
- Easy configuration and usage.

## Requirements

- PHP 8.3 or higher
- PostgreSQL with PGVector extension installed
- Doctrine ORM

## Installation

Install the package via Composer:

```bash
composer require locky42/leopard-doctrine-pgvector-type
```

## Usage

1. **Update your entity mapping** to use the `vector` type:

```php
#[ORM\Entity]
class ExampleEntity
{
    #[ORM\Column(type: "vector", options: ["dimension" => 1536], nullable: true)]
    private ?array $embedding = null;
}
```

2. **Run migrations** to apply changes to your database schema.
Use `orm:schema-tool:update` command

## Contributing

Contributions are welcome! Please submit a pull request or open an issue for discussion.

## License

This project is licensed under the [UOS License](LICENSE).
