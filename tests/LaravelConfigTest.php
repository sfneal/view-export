<?php

namespace Sfneal\ViewExport\Tests;

class LaravelConfigTest extends TestCase
{
    /** @test */
    public function config_is_accessible()
    {
        // Confirm the view-export config array exists
        $this->assertIsArray(config('view-export'));
    }

    /** @test */
    public function chroot()
    {
        $output = config('view-export.chroot');
        $expected = base_path('vendor/dompdf/dompdf');

        $this->assertIsString($output);
        $this->assertDirectoryExists($output);
        $this->assertEquals($output, $expected);
    }

    /** @test */
    public function php_enabled()
    {
        $output = config('view-export.php_enabled');
        $expected = true;

        $this->assertIsBool($output);
        $this->assertEquals($output, $expected);
    }

    /** @test */
    public function javascript_enabled()
    {
        $output = config('view-export.javascript_enabled');
        $expected = true;

        $this->assertIsBool($output);
        $this->assertEquals($output, $expected);
    }

    /** @test */
    public function html5_parsable()
    {
        $output = config('view-export.html5_parsable');
        $expected = true;

        $this->assertIsBool($output);
        $this->assertEquals($output, $expected);
    }

    /** @test */
    public function remote_enabled()
    {
        $output = config('view-export.remote_enabled');
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
        $this->app['config']->set('view-export.metadata', $metadata);

        $output = config('view-export.metadata');
        $expected = $metadata;

        $this->assertIsArray($output);
        $this->assertEquals($output, $expected);
    }
}
