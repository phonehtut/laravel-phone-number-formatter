# Contributing to Laravel Phone Number Formatter

Thank you for considering contributing to Laravel Phone Number Formatter! This document provides guidelines and instructions for contributing.

## Code of Conduct

By participating in this project, you agree to maintain a respectful and inclusive environment for everyone.

## How Can I Contribute?

### Reporting Bugs

Before creating bug reports, please check the issue list as you might find out that you don't need to create one. When you are creating a bug report, please include as many details as possible:

- **Use a clear and descriptive title**
- **Describe the exact steps to reproduce the problem**
- **Provide specific examples to demonstrate the steps**
- **Describe the behavior you observed after following the steps**
- **Explain which behavior you expected to see instead and why**
- **Include screenshots and animated GIFs if applicable**

### Suggesting Enhancements

Enhancement suggestions are tracked as GitHub issues. When creating an enhancement suggestion, please include:

- **Use a clear and descriptive title**
- **Provide a step-by-step description of the suggested enhancement**
- **Provide specific examples to demonstrate the steps**
- **Describe the current behavior and explain which behavior you expected to see instead**
- **Explain why this enhancement would be useful**

### Pull Requests

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Make your changes
4. Add tests for your changes
5. Ensure all tests pass (`composer test`)
6. Commit your changes (`git commit -m 'Add some amazing feature'`)
7. Push to the branch (`git push origin feature/amazing-feature`)
8. Open a Pull Request

## Development Setup

1. Clone the repository:
   ```bash
   git https://github.com/phonehtut/laravel-phone-number-formatter
   cd laravel-phone-number-formatter
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Run tests:
   ```bash
   composer test
   ```

## Coding Standards

- Follow [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standards
- Write meaningful commit messages
- Add tests for new features
- Update documentation as needed

## Adding Support for New Countries

To add support for a new country:

1. Update the `$countries` array in `src/PhoneNumberFormatter.php`:
   ```php
   'COUNTRY_CODE' => [
       'prefix' => '+XX',        // Country calling code
       'local_prefix' => '0X',  // Optional local prefix (e.g., '09' for Myanmar)
       'length' => X,            // Expected number length
   ],
   ```

2. Add tests in `tests/PhoneNumberFormatterTest.php`

3. Update the README.md with the new country information

4. Update the CHANGELOG.md

## Testing

- Write tests for all new features
- Ensure existing tests continue to pass
- Aim for high test coverage

## Documentation

- Update README.md for new features
- Add code examples where appropriate
- Update CHANGELOG.md for all changes

## Questions?

If you have any questions, please open an issue or contact the maintainers.

Thank you for contributing! 🎉

