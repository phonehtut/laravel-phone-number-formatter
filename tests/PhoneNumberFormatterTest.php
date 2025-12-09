<?php

use NewwaySo\PhoneNumberFormatter\PhoneNumberFormatter;

it('formats Myanmar number', function() {
    $formatter = new PhoneNumberFormatter();
    expect($formatter->format('0912345678', 'MY'))->toBe('+95912345678');
});

it('validates US number', function() {
    $formatter = new PhoneNumberFormatter();
    expect($formatter->validate('2025550123', 'US'))->toBeTrue();
});
