<?php
namespace NewwayMyanmar\PhoneNumberFormatter;

class PhoneNumberFormatter
{
    protected array $countries = [
        'MY' => ['prefix' => '+95', 'local_prefix' => '09', 'length' => 8],
        'US' => ['prefix' => '+1', 'length' => 10],
        'UK' => ['prefix' => '+44', 'length' => 10],
        'IN' => ['prefix' => '+91', 'length' => 10],
        'CN' => ['prefix' => '+86', 'length' => 11],
        'TH' => ['prefix' => '+66', 'length' => 9],
    ];

    public function format(string $number, string $country = 'MY'): string
    {
        $number = preg_replace('/[^0-9]/', '', $number);
        $country = strtoupper($country);

        if (!isset($this->countries[$country])) {
            return $number;
        }

        $c = $this->countries[$country];

        // Remove local prefix if exists
        if (isset($c['local_prefix']) && str_starts_with($number, substr($c['local_prefix'], 1))) {
            $number = substr($number, strlen($c['local_prefix']) - 1);
        }

        return $c['prefix'] . $number;
    }

    public function validate(string $number, string $country = 'MY'): bool
    {
        $country = strtoupper($country);
        if (!isset($this->countries[$country])) return false;

        $number = preg_replace('/[^0-9]/', '', $number);

        $expectedLength = $this->countries[$country]['length'] ?? null;
        return $expectedLength ? strlen($number) === $expectedLength : false;
    }
}
