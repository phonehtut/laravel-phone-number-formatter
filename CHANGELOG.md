# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.0.0] - 2025-12-09

### Added
- Initial release
- Phone number formatting functionality with international format (E.164) support
- Phone number validation by country
- Support for Myanmar (MY), United States (US), United Kingdom (UK), India (IN), China (CN), and Thailand (TH)
- Laravel facade support (`PhoneFormatter`)
- Service provider for Laravel integration
- Configuration file for default country settings
- Comprehensive test suite using Pest PHP
- Automatic removal of non-numeric characters
- Local prefix handling for Myanmar numbers (09)

### Features
- `format()` method to format phone numbers to international format
- `validate()` method to validate phone numbers by country
- Support for multiple input formats (with spaces, dashes, parentheses)
- Configurable default country
- Easy integration with Laravel service container

