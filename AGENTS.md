# AGENTS.md

Guidance for AI coding agents working in this repository.

## Project Overview

PHP library that wraps the [stopforumspam.com](https://www.stopforumspam.com/usage) API.
Namespace: `StopSpam\` (PSR-4, mapped to `src/`).

- Runtime: PHP >= 8.2
- Dependency: `symfony/http-client`
- License: LGPL-3.0-or-later

## Commands

```bash
# Install dependencies
composer install

# Run tests
vendor/bin/phpunit --configuration phpunit.xml.dist

# Code style check/fix
vendor/bin/php-cs-fixer fix --config .php-cs-fixer.dist.php --dry-run --diff
vendor/bin/php-cs-fixer fix --config .php-cs-fixer.dist.php
```

## Code Style

Coding standard is enforced by PHP-CS-Fixer (config: `.php-cs-fixer.dist.php`).
Key rules: `@Symfony`, `@Symfony:risky`, `@PHP8x2Migration`, strict comparison, and
alphabetically ordered imports.
Do not add comments unless asked.

## Conventions

- Source lives in `src/`, tests in `tests/`, following the existing PSR-4 layout.
- Write PHPUnit tests for any behavior changes (see `tests/RequestTest.php` for patterns).
- Keep the public API in line with the `README.md` usage examples.
- Do not commit changes unless explicitly requested.
