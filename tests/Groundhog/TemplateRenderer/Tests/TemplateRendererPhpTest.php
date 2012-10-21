<?php

namespace Groundhog\TemplateRenderer\Tests;

use Groundhog\TemplateRenderer\TemplateRendererPhp;

class TemplateRendererPhpTest extends \PHPUnit_Framework_TestCase
{
    public function testRendererCanLoadSimpleFileAndReturn()
    {
        $test_file        = 'tests/Groundhog/TemplateRenderer/Tests/test_docs/simple_template.template';
        $should_render_to = 'tests/Groundhog/TemplateRenderer/Tests/test_docs/simple_template.template';

        $renderer = new TemplateRendererPhp();

        $output = $renderer->render($test_file);

        $this->assertStringEqualsFile($should_render_to, $output);
    }

    public function testRendererRendersWithData()
    {
        $test_file        = 'tests/Groundhog/TemplateRenderer/Tests/test_docs/data_template.template';
        $should_render_to = 'tests/Groundhog/TemplateRenderer/Tests/test_docs/data_template.output';

        $renderer = new TemplateRendererPhp();

        $output = $renderer->render($test_file, array('name' => 'Steve', 'age' => 29));

        $this->assertStringEqualsFile($should_render_to, $output);
    }

    public function testRendererRendersWithSimplePartial()
    {
        $test_file        = 'tests/Groundhog/TemplateRenderer/Tests/test_docs/partial_parent.template';
        $should_render_to = 'tests/Groundhog/TemplateRenderer/Tests/test_docs/partial_parent.output';

        $renderer = new TemplateRendererPhp();

        $output = $renderer->render($test_file);

        $this->assertStringEqualsFile($should_render_to, $output);
    }

    public function testRendererRendersWithWrapper()
    {
        $test_file        = 'tests/Groundhog/TemplateRenderer/Tests/test_docs/wrapped_template.template';
        $should_render_to = 'tests/Groundhog/TemplateRenderer/Tests/test_docs/wrapped_template.output';

        $renderer = new TemplateRendererPhp();

        $output = $renderer->render($test_file);

        $this->assertStringEqualsFile($should_render_to, $output);
    }

}
