# Laravel Phone Number Formatter

A Laravel package for formatting and validating phone numbers with support for Myanmar and international formats.

## Features

- 📱 Format phone numbers to international format (E.164)
- ✅ Validate phone numbers by country
- 🌍 Support for multiple countries (Myanmar, US, UK, India, China, Thailand)
- 🎯 Easy-to-use facade and service container integration
- ⚙️ Configurable default country
- 🧪 Fully tested with Pest PHP

## Requirements

- PHP >= 8.1
- Laravel >= 10.0

## Installation

You can install the package via Composer:

```bash
composer require newway-solutions/laravel-phone-number-formatter
```

The package will automatically register its service provider and facade.

## Configuration

Publish the configuration file (optional):

```bash
php artisan vendor:publish --tag=config --provider="NewwaySo\PhoneNumberFormatter\PhoneNumberFormatterServiceProvider"
```

This will create a `config/phoneformatter.php` file where you can set the default country:

```php
return [
    'default_country' => 'MY', // Myanmar
];
```

## Usage

### Using the Facade

```php
use NewwaySo\PhoneNumberFormatter\Facades\PhoneFormatter;

// Format a Myanmar phone number
$formatted = PhoneFormatter::format('0912345678', 'MY');
// Returns: +95912345678

// Format a US phone number
$formatted = PhoneFormatter::format('2025550123', 'US');
// Returns: +12025550123

// Validate a phone number
$isValid = PhoneFormatter::validate('0912345678', 'MY');
// Returns: true
```

### Using Dependency Injection

```php
use NewwaySo\PhoneNumberFormatter\PhoneNumberFormatter;

class YourController extends Controller
{
    public function __construct(
        protected PhoneNumberFormatter $formatter
    ) {}

    public function formatPhone($number)
    {
        return $this->formatter->format($number, 'MY');
    }
}
```

### Using the Service Container

```php
$formatter = app('phoneformatter');
$formatted = $formatter->format('0912345678', 'MY');
```

### Direct Instantiation

```php
use NewwaySo\PhoneNumberFormatter\PhoneNumberFormatter;

$formatter = new PhoneNumberFormatter();
$formatted = $formatter->format('0912345678', 'MY');
```

## Supported Countries

The package currently supports the following countries:

| Country Code | Country | Prefix | Local Prefix | Length |
|--------------|---------|--------|--------------|--------|
| MY | Myanmar | +95 | 09 | 8 |
| US | United States | +1 | - | 10 |
| UK | United Kingdom | +44 | - | 10 |
| IN | India | +91 | - | 10 |
| CN | China | +86 | - | 11 |
| TH | Thailand | +66 | - | 9 |

## API Reference

### `format(string $number, string $country = 'MY'): string`

Formats a phone number to international format (E.164).

**Parameters:**
- `$number` (string): The phone number to format (can include spaces, dashes, parentheses)
- `$country` (string): Two-letter country code (default: 'MY')

**Returns:** Formatted phone number with country prefix (e.g., `+95912345678`)

**Example:**
```php
PhoneFormatter::format('0912345678', 'MY'); // +95912345678
PhoneFormatter::format('(202) 555-0123', 'US'); // +12025550123
PhoneFormatter::format('0912345678'); // +95912345678 (uses default MY)
```

**Notes:**
- All non-numeric characters are automatically removed
- For Myanmar numbers, the local prefix `09` is automatically removed if present
- If the country is not supported, returns the cleaned number without formatting

### `validate(string $number, string $country = 'MY'): bool`

Validates a phone number against the expected length for the specified country.

**Parameters:**
- `$number` (string): The phone number to validate
- `$country` (string): Two-letter country code (default: 'MY')

**Returns:** `true` if valid, `false` otherwise

**Example:**
```php
PhoneFormatter::validate('0912345678', 'MY'); // true
PhoneFormatter::validate('2025550123', 'US'); // true
PhoneFormatter::validate('12345', 'MY'); // false (too short)
```

**Notes:**
- All non-numeric characters are automatically removed before validation
- Validation checks the length of the number after removing local prefixes
- Returns `false` if the country is not supported

## Examples

### Formatting Myanmar Phone Numbers

```php
use NewwaySo\PhoneNumberFormatter\Facades\PhoneFormatter;

// Various input formats
PhoneFormatter::format('0912345678', 'MY');     // +95912345678
PhoneFormatter::format('912345678', 'MY');       // +95912345678
PhoneFormatter::format('09-123-456-78', 'MY');   // +95912345678
PhoneFormatter::format('(09) 1234 5678', 'MY'); // +95912345678
```

### Formatting International Numbers

```php
// United States
PhoneFormatter::format('2025550123', 'US');      // +12025550123
PhoneFormatter::format('(202) 555-0123', 'US');  // +12025550123

// United Kingdom
PhoneFormatter::format('7911123456', 'UK');      // +447911123456

// India
PhoneFormatter::format('9876543210', 'IN');      // +919876543210

// China
PhoneFormatter::format('13800138000', 'CN');     // +8613800138000

// Thailand
PhoneFormatter::format('812345678', 'TH');       // +66812345678
```

### Validation Examples

```php
// Valid Myanmar number
PhoneFormatter::validate('0912345678', 'MY'); // true

// Invalid Myanmar number (wrong length)
PhoneFormatter::validate('1234567', 'MY'); // false

// Valid US number
PhoneFormatter::validate('2025550123', 'US'); // true

// Invalid US number (wrong length)
PhoneFormatter::validate('202555012', 'US'); // false
```

### Using in Laravel Forms

```php
// In a FormRequest
use NewwaySo\PhoneNumberFormatter\Facades\PhoneFormatter;

public function rules()
{
    return [
        'phone' => [
            'required',
            function ($attribute, $value, $fail) {
                if (!PhoneFormatter::validate($value, 'MY')) {
                    $fail('The phone number is invalid.');
                }
            },
        ],
    ];
}

public function prepareForValidation()
{
    $this->merge([
        'phone' => PhoneFormatter::format($this->phone, 'MY'),
    ]);
}
```

### Using in Models

```php
use NewwaySo\PhoneNumberFormatter\Facades\PhoneFormatter;

class User extends Model
{
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = PhoneFormatter::format($value, 'MY');
    }

    public function getFormattedPhoneAttribute()
    {
        return PhoneFormatter::format($this->phone, 'MY');
    }
}
```

## Testing

Run the tests with:

```bash
composer test
```

Or using Pest directly:

```bash
./vendor/bin/pest
```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## Adding Support for New Countries

To add support for a new country, you can extend the `PhoneNumberFormatter` class or modify the `$countries` array:

```php
protected array $countries = [
    'MY' => ['prefix' => '+95', 'local_prefix' => '09', 'length' => 8],
    'US' => ['prefix' => '+1', 'length' => 10],
    // Add your country here
    'SG' => ['prefix' => '+65', 'length' => 8],
];
```

## Security

If you discover any security-related issues, please email phonehtutkhaung.dev@gmail.com instead of using the issue tracker.

## Changelog

Please see [CHANGELOG.md](CHANGELOG.md) for more information on what has changed recently.

## License

The Laravel Phone Number Formatter package is open-sourced software licensed under the [MIT license](LICENSE.md).

## Author

**Phone Htut Khaung**

- CTO at Newway Solutions
- Website: [https://yamm.newway-solution.com](https://yamm.newway-solution.com)
- Email: phonehtutkhaung.dev@gmail.com

## Support

For support, please open an issue on the [GitHub repository](https://github.com/phonehtut/laravel-phone-number-formatter) or contact the maintainer.

## Credits

- Built with ❤️ for the Laravel community
- Special thanks to all contributors

