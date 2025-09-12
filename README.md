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

1. **Register the custom type** in your Doctrine configuration:

```php
use Doctrine\DBAL\Types\Type;
use YourNamespace\Doctrine\Types\VectorType;

Type::addType('vector', VectorType::class);
```

2. **Update your entity mapping** to use the `vector` type:

```php
#[ORM\Entity]
class ExampleEntity
{
    #[ORM\Column(type: "vector")]
    private array $embedding;
}
```

3. **Run migrations** to apply changes to your database schema.

## Testing

Run the test suite using PHPUnit:

```bash
vendor/bin/phpunit
```

## Contributing

Contributions are welcome! Please submit a pull request or open an issue for discussion.

## License

This project is licensed under the [MIT License](LICENSE).

## Acknowledgments

Special thanks to the PGVector and Doctrine communities for their amazing tools.
