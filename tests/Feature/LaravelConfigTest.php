<?php

namespace Sfneal\ViewExport\Tests\Feature;

use Sfneal\ViewExport\Tests\TestCase;

class LaravelConfigTest extends TestCase
{
    /** @test */
    public function config_is_accessible()
    {
        // Confirm the view-export config array exists
        $this->assertIsArray(config('view-export.pdf'));
        $this->assertIsArray(config('view-export'));
    }

    /** @test */
    public function chroot()
    {
        $output = config('view-export.pdf.chroot');
        $expected = base_path('vendor/dompdf/dompdf');

        $this->assertIsString($output);
        $this->assertDirectoryExists($output);
        $this->assertEquals($output, $expected);
    }

    /** @test */
    public function php_enabled()
    {
        $output = config('view-export.pdf.php_enabled');
        $expected = true;

        $this->assertIsBool($output);
        $this->assertEquals($output, $expected);
    }

    /** @test */
    public function javascript_enabled()
    {
        $output = config('view-export.pdf.javascript_enabled');
        $expected = true;

        $this->assertIsBool($output);
        $this->assertEquals($output, $expected);
    }

    /** @test */
    public function html5_parsable()
    {
        $output = config('view-export.pdf.html5_parsable');
        $expected = true;

        $this->assertIsBool($output);
        $this->assertEquals($output, $expected);
    }

    /** @test */
    public function remote_enabled()
    {
        $output = config('view-export.pdf.remote_enabled');
        $expected = true;

        $this->assertIsBool($output);
        $this->assertEquals($output, $expected);
    }

    /** @test */
    public function metadata()
    {
        $metadata = [
            'Title' => 'Default PDF Title',
            'Author' => 'Stephen Neal',
            'Subject' => 'Test PDF',
            'Creator' => 'sfneal/view-export',
            'Producer' => 'dompdf/dompdf',
        ];
        $this->app['config']->set('view-export.pdf.metadata', $metadata);

        $output = config('view-export.pdf.metadata');
        $expected = $metadata;

        $this->assertIsArray($output);
        $this->assertEquals($output, $expected);
    }
}
