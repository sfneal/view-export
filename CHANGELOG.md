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


## 0.7.3 - 2021-02-19
- add fromViewModel method to PdfExportService for initializing from a ViewModel
- add composer requiring of sfneal/view-models & tests for constructing from ViewModels


## 0.7.4 - 2021-02-19
- add view() & download() methods to PdfExporter for viewing in browser & downloading PDFs


## 0.7.5 - 2021-02-19
- make DefaultOptions class for retrieving a Dompdf\Options instance with the defaults set
- add ability to pass Options instances to PdfExportService methods


## 0.8.0 - 2021-02-22
- refactor PdfExporter to not load content or render the pdf from the __construct method requiring a call to `render()`
- refactor PdfExporter's $options property to be public to allow easier manipulation
- add setLandscape() & setPortrait() methods to DefaultOptions for quickly changing paper orientation


## 0.8.1 - 2021-02-22
- make Metadata that's used in PdfExporter for handling adding metadata to a PDF
- add 'metadata' key to config file for setting default metadata values


## 0.8.2 - 2021-02-22
- refactor PdfExporter to PdfRender & make separate PdfExporter
- optimize PdfRenderer::render() method to return a PdfExporter with export methods


## 0.9.0 - 2021-02-22
- refactor PdfRenderer::render() method to handle()
- refactor PdfRenderer to Renderer & PdfExporter to Exporter
- fix Renderer to extend AbstractJob to allow it to be queueable
- add ability to provide n file upload path to the __construct method of Renderer
- cut $options params from PdfExportService & PdfRenderer
- cut $metadata param from Renderer::__construct method


## 0.9.1 - 2021-02-24
- refactor PdfRenderer::render() method to handle()
- fix issue with View's being non-serializable and causing errors when pushing to queues
- refactor Renderer to use a non-static `dispatch()` method for dispatching a Renderer instance to the Job queue


## 0.9.2 - 2021-02-24
- fix issues queueing non-static Renderer instances by refactoring `dispatch()` method to `handleJob()` to prevent conflicts


## 0.10.0 - 2021-02-24
- cut 'get' prefix from Exporter's `output()`, `path()` & `url()` methods
- cut `fromViewData()` method from PdfExportService as there's no advantage of using that instead of `fromView()`
- fix use of PdfExportService in PdfExportAction to use `fromView()` method instead of `fromViewData()`


## 0.10.1 - 2021-02-24
- refactor PdfExportJob to accept a Renderer instance as its __construct param


## 0.10.2 - 2021-02-24
- fix issues with PdfExportJob failing due to `$renderer` property being 'private'
- fix PdfExportJob::handle() method to return the PDF's upload path


## 0.11.0 - 2021-02-26
- refactor sfneal/dompdf dependency to dompdf/dompdf to try to fix remote style sheets issues


## 0.11.1 - 2021-03-01
- add default dompdf logging location
- add conditional that prevents deleting the local HTML file used to create a PDF when the app is in 'debug' mode


## 1.0.0 - 2021-03-16
- initial production release
- cut support for php7.3 & php7.2
- add ability to pass a url to a PdfExportService
- make abstraction layers (ExportService, Exporter, Renderer) for future expansion of view-export 
- add scrutinizer/ocular to composer dev requirements to support code coverage uploading in Travis CI builds


## 1.1.0 - 2021-03-18
- cut `PdfExportJob` in favor of dispatching pdf exports from the PdfExportService


## 1.2.0 - 2021-03-18
- add ability to store PDF file on the local filesystem
- optimize test suite for easier future expansion
- start preparing for improvements to the `Excel` module


## 2.0.0 - 2021-03-19
- make `ExcelExportService` that makes use of `ExportService`, `Renderer` & `Exporter` abstractions for consistency of use with `PdfExportService`
- cut `ExportExcelAction` in favor of using `ExcelExportService`
- optimize composer requirements by removing unused dependencies


## 2.1.0 - 2021-03-22
- refactor `Sfneal\ViewExport\Excel\Utils\ExcelView` to `Sfneal\ViewExport\Excel\Exports\ExcelViewExport` for easier expansion
- fix `ExcelRenderer::setExcelView()` method to use string type hinting for $viewClass param
- add test method for testing exporting Excel files from a Collection


## 2.2.0 - 2021-03-23
- refactor `ExcelRenderer@setExcelView()` to `ExcelRenderer@setExcelExport()`
- refactor `Streamable` interface into two separate `Viewable` & `Downloadable` interfaces
- refactor abstract classes from 'Support' namespace into 'Sfneal\ViewExport\Support\Adapters' namespace
- refactor interfaces from 'Support' namespace into 'Sfneal\ViewExport\Support\Interfaces' namespace.
- add `download()` method to `ExcelExporter`
- add use of `Storage` facade for uploading files to S3 instead of the S3 helper


## 2.3.0 - 2021-03-24
- cut $uploadPath param from `ExportService` methods & `Renderer` constructor in favor of using `Renderer::upload()` method
- add methods to `Renderer` that allow for setting upload or storage paths prior to executing rendering (useful when interacting with the queue)


## 2.3.1 - 2021-04-05
- fix sfneal/queueables version constraint (^1.0)


## 2.4.0 - 2021-04-05
- bump sfneal/queueables (^2.0) & sfneal/view-models (^2.1) version constraints


## 2.5.0 - 2021-04-06
- bump sfneal/view-models (^3.0) min version


## 2.6.0 - 2021-04-13
- add 'font_cache' key to view-export config for overriding the font cache directory
- refactor config keys to be nested within a 'pdf' key (changes config access from `config('view-export.metadata')` to `config('view-export.pdf.metadata')`)
