# Convert Numbers to Words In Persian

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mojtabaahn/php-persian-number-to-words.svg?style=flat-square)](https://packagist.org/packages/mojtabaahn/php-persian-number-to-words)
[![Total Downloads](https://img.shields.io/packagist/dt/mojtabaahn/php-persian-number-to-words?style=flat-square)](https://packagist.org/packages/mojtabaahn/php-persian-number-to-words)
[![Repo Size](https://img.shields.io/github/repo-size/mojtabaahn/php-persian-number-to-words?style=flat-square)](https://packagist.org/packages/mojtabaahn/php-persian-number-to-words)
[![Repo Size](https://img.shields.io/packagist/l/mojtabaahn/php-persian-number-to-words?style=flat-square)](https://packagist.org/packages/mojtabaahn/php-persian-number-to-words)

This packages offers ability to convert numbers to words in persian. Words and phrases are fully configurable, so it is possible to use it for all persian language family with configuration.

## Requirement

This package requires **PHP 7.4** or higher.

## Installation

You can install the package via composer:

```bash
composer require mojtabaahn/php-persian-number-to-words
```

## Usage

``` php
$dictionary = new MojtabaaHN\PersianNumberToWords\Dictionary();

$converter = new MojtabaaHN\PersianNumberToWords\PersianNumberToWords($dictionary);

echo $converter->convert(0);
// صفر

echo $converter->convert(-10);
// منفی ده

echo $converter->convert(229);
// دویست و بیست و نه

echo $converter->convert(999999999);
// نهصد و نود و نه میلیون و نهصد و نود و نه هزار و نهصد و نود و نه
```
## Configuration

It is possible to customize the way output should look like using Dictionary class setter methods.

``` php
$dictionary = (new MojtabaaHN\PersianNumberToWords\Dictionary())
    ->setZero('هیچ')
    ->setNegative('منهای')
    ->setSeparator(' ُ ');

// Also ->setUnits(array $units) & -> setSuffixes(array $suffixes) are availabe

$converter = new MojtabaaHN\PersianNumberToWords\PersianNumberToWords($dictionary);

echo $converter->convert(0);
// هیچ

echo $converter->convert(-10);
// منهای ده

echo $converter->convert(229);
// دویست ُ بیست ُ نه

```

## Default Configuration
This code is a part of Dictionary class, you can see all default Configuration:
```php
class Dictionary
{

    protected string $zero = 'صفر';

    protected string $negative = 'منفی';

    protected string $separator = " و ";

    protected array $units = [
        1 => 'یک',
        2 => 'دو',
        3 => 'سه',
        4 => 'چهار',
        5 => 'پنج',
        6 => 'شش',
        7 => 'هفت',
        8 => 'هشت',
        9 => 'نه',
        10 => 'ده',
        11 => 'یازده',
        12 => 'دوازده',
        13 => 'سیزده',
        14 => 'چهارده',
        15 => 'پانزده',
        16 => 'شانزده',
        17 => 'هفده',
        18 => 'هجده',
        19 => 'نوزده',
        20 => 'بیست',
        30 => 'سی',
        40 => 'چهل',
        50 => 'پنجاه',
        60 => 'شصت',
        70 => 'هفتاد',
        80 => 'هشتاد',
        90 => 'نود',
        100 => 'صد',
        200 => 'دویست',
        300 => 'سیصد',
        400 => 'چهارصد',
        500 => 'پانصد',
        600 => 'ششصد',
        700 => 'هفتصد',
        800 => 'هشتصد',
        900 => 'نهصد'
    ];

    protected array $suffixes = [
        3 => 'هزار',
        6 => 'میلیون',
        9 => 'میلیارد',
        12 => 'بیلیون',
        15 => 'بیلیارد',
        18 => 'تریلیون',
        21 => 'تریلیارد',
        24 => 'کوآدریلیون',
        27 => 'کادریلیارد',
        30 => 'کوینتیلیون',
        33 => 'کوانتینیارد',
        36 => 'سکستیلیون',
        39 => 'سکستیلیارد',
        42 => 'سپتیلیون',
        45 => 'سپتیلیارد',
        48 => 'اکتیلیون',
        51 => 'اکتیلیارد',
        54 => 'نانیلیون',
        57 => 'نانیلیارد',
        60 => 'دسیلیون',
        63 => 'دسیلیارد',
    ];

    // Setters & Helpers...

}
```

## Testing

``` bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.