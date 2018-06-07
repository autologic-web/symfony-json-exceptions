# Symfony JSON Exceptions

[![Build Status](https://travis-ci.org/autologic-web/symfony-json-exceptions.svg?branch=master)](https://travis-ci.org/autologic-web/symfony-json-exceptions) [![StyleCI](https://styleci.io/repos/136459077/shield?branch=master)](https://styleci.io/repos/136459077) [![Maintainability](https://api.codeclimate.com/v1/badges/f84a52fb33300dfa6a3b/maintainability)](https://codeclimate.com/github/autologic-web/symfony-json-exceptions/maintainability) [![Test Coverage](https://api.codeclimate.com/v1/badges/f84a52fb33300dfa6a3b/test_coverage)](https://codeclimate.com/github/autologic-web/symfony-json-exceptions/test_coverage)

### Handle exceptions gracefully in your Symfony APIs.

```bash
$ composer install autologic-web/symfony-json-exceptions
```

Include the bundle in `config/bundles.php` in Symfony 4+ or in `AppKernel.php` in Symfony 2+ and you're done for production.

If you want to use pretty exceptions in dev, add the following to the root level of your config, or a new file in Symfony 4+:

```yaml
autologic_json_exceptions:
    pretty_dev: true
```

Compatible with Symfony 2, 3 & 4. PHP 5.3 to 7.2.

Returns consistently formatted errors with title, detail and status. Not found example:

```json
{
    "errors": [
        {
            "title": "Not found",
            "detail": "No route found for \"GET /api/silly\"",
            "status": 404
        }
    ]
}
```

Credit to [@dannym87](https://github.com/dannym87) for first implementing this in one of our services. It's now a library for re-use.
