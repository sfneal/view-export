# View Export

[![Packagist PHP support](https://img.shields.io/packagist/php-v/sfneal/view-export)](https://packagist.org/packages/sfneal/view-export)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/sfneal/view-export.svg?style=flat-square)](https://packagist.org/packages/sfneal/view-export)
[![Build Status](https://travis-ci.com/sfneal/view-export.svg?branch=master&style=flat-square)](https://travis-ci.com/sfneal/view-export)
[![Quality Score](https://img.shields.io/scrutinizer/g/sfneal/view-export.svg?style=flat-square)](https://scrutinizer-ci.com/g/sfneal/view-export)
[![Total Downloads](https://img.shields.io/packagist/dt/sfneal/view-export.svg?style=flat-square)](https://packagist.org/packages/sfneal/view-export)

Export Views from Laravel applications to PDF or Excel files.

## Installation

You can install the package via composer:

```bash
composer require sfneal/view-export
```

To modify the view-export config file publish the ServiceProvider.

``` php
php artisan vendor:publish --provider="Sfneal\ViewExport\Providers\ViewExportServiceProvider"
```

## Usage


### PDFs
Exporting a PDF from a 'view'.
``` php
use Sfneal\ViewExport\Pdf\PdfExportService;

// Set the view & upload path
$view = view('your.view', ['example_data' => ['a'=> 2001, 'b' => 3012]]);
$s3Key = 'path/to/save/your/file/example.pdf';

// Initialize an Exporter instance
$exporter = PdfExportService::fromView($view)->handle();

// Upload the PDF
$exporter->upload($s3Key);

// Download in browser
$exporter->download();

// Retrieve the upload path
$path = $exporter->path();
```

### Excel
Exporting an Excel file from a 'view'.
``` php
use Sfneal\ViewExport\Excel\ExcelExportService;

// Set the view & upload path
$view = view('your.view', ['example_data' => ['a'=> 2001, 'b' => 3012]]);
$s3Key = 'path/to/save/your/file/example.pdf';

// Initialize an Exporter instance
$exporter = ExcelExportService::fromView($view)->handle();

// Upload the PDF
$exporter->upload($s3Key);

// Download in browser
$exporter->download();

// Retrieve the upload path
$path = $exporter->path();
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email stephen.neal14@gmail.com instead of using the issue tracker.

## Credits

- [Stephen Neal](https://github.com/sfneal)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## PHP Package Boilerplate

This package was generated using the [PHP Package Boilerplate](https://laravelpackageboilerplate.com).
