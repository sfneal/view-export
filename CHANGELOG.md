# Changelog

All notable changes to `view-export` will be documented in this file

## 0.1.0 - 2020-10-05
- initial release


## 0.1.1 - 2020-10-05
- fix laravel/framework composer requirement maintain compatibility with PHP 7.2


## 0.1.2 - 2020-10-06
- fix composer.json format to be less strict


## 0.2.0 - 2020-12-01
- add support for php 8


## 0.3.0 - 2020-12-01
- fix Travis CI config's composer flags matrix


## 0.4.0 - 2020-12-01
- replace dompdf/dompdf composer dependency with sfneal/dompdf


## 0.4.1 - 2020-12-02
- fix issues with Dompdf imports


## 0.4.2 - 2020-12-02
- fix Travis CI allowed failure jobs


## 0.4.3 - 2020-12-04
- fix Travis CI test suite by disabling xdebug 3.0


## 0.5.0 - 2020-12-08
- add sfneal/dompdf ^0.8.5 dependency


## 0.5.1 - 2020-12-08
- fix sfneal/dompdf dependency


## 0.5.2 - 2020-12-23
- fix php8 compatibility


## 0.5.3 - 2020-12-23
- optimize imports


## 0.5.4 - 2020-12-23
- fix sfneal/dompdf min version


## 0.5.5 - 2020-12-23
- fix exception import


## 0.5.6 - 2020-12-23
- cut Travis CI php7.2 tests


## 0.6.0 - 2021-01-21
- cut unused sfneal/aws-s3-helpers & sfneal/string-helpers composer dependencies
- optimize Travis & Scrutinizer CI configs


## 0.7.0 - 2021-02-04
- add composer requiring of sfneal/aws-s3-helpers & sfneal/string-helpers
- add use of S3 for uploading instead of helper function in PdfExportAction


## 0.7.1 - 2021-02-04
- add use of StringHelpers to fix issues with helper function autoloading
- bump min sfneal/actions & sfneal/queueables package versions to 1.0


## 0.7.2 - 2021-02-19
- make PdfExportService that provides static methods for initializing a PdfExporter from views or html
- refactor Pdf construction, rendering & storage functionality to PdfExporter class for easier customization
- add config file for changing default Dompdf Options
