<?php

namespace GroundhogTest\TemplateRenderer;

use Groundhog\TemplateRenderer\TemplateRendererPhp;

class TemplateRendererPhpTest extends \PHPUnit_Framework_TestCase
{
    public function testRendererCanLoadSimpleFileAndReturn()
    {
        $test_file        = 'tests/GroundhogTest/TemplateRenderer/test_docs/simple_template.template';
        $should_render_to = 'tests/GroundhogTest/TemplateRenderer/test_docs/simple_template.template';

        $renderer = new TemplateRendererPhp();

        $output = $renderer->render($test_file);

        $this->assertStringEqualsFile($should_render_to, $output);
    }

    public function testRendererRendersWithData()
    {
        $test_file        = 'tests/GroundhogTest/TemplateRenderer/test_docs/data_template.template';
        $should_render_to = 'tests/GroundhogTest/TemplateRenderer/test_docs/data_template.output';

        $renderer = new TemplateRendererPhp();

        $output = $renderer->render($test_file, array('name' => 'Steve', 'age' => 29));

        $this->assertStringEqualsFile($should_render_to, $output);
    }

    public function testRendererRendersWithSimplePartial()
    {
        $test_file        = 'tests/GroundhogTest/TemplateRenderer/test_docs/partial_parent.template';
        $should_render_to = 'tests/GroundhogTest/TemplateRenderer/test_docs/partial_parent.output';

        $renderer = new TemplateRendererPhp();

        $output = $renderer->render($test_file);

        $this->assertStringEqualsFile($should_render_to, $output);
    }

    public function testRendererRendersWithWrapper()
    {
        $test_file        = 'tests/GroundhogTest/TemplateRenderer/test_docs/wrapped_template.template';
        $should_render_to = 'tests/GroundhogTest/TemplateRenderer/test_docs/wrapped_template.output';

        $renderer = new TemplateRendererPhp();

        $output = $renderer->render($test_file);

        $this->assertStringEqualsFile($should_render_to, $output);
    }

    public function testRendererRendersWithHelper()
    {
        $test_file        = 'tests/GroundhogTest/TemplateRenderer/test_docs/helper_template.template';
        $should_render_to = 'tests/GroundhogTest/TemplateRenderer/test_docs/helper_template.output';

        $mock_helper = $this->getMock('\Groundhog\TemplateRenderer\ViewHelperInterface');
        $mock_helper->expects($this->any())
            ->method('render')
            ->will($this->returnValue('<content>Helper provided content</content>'));

        $renderer = new TemplateRendererPhp();
        $renderer->registerHelper('mock_helper', $mock_helper);

        $output = $renderer->render($test_file);

        $this->assertStringEqualsFile($should_render_to, $output);
    }

    public function testRendererBacksOutCleanlyOnException()
    {
        $test_file        = 'tests/GroundhogTest/TemplateRenderer/test_docs/exception_thrower.template';

        $renderer = new TemplateRendererPhp();

        try {
            $output = $renderer->render($test_file);

        } catch (\Exception $e) {
            // The renderer should've dumped the output buffer before throwing the exception
            $content = ob_get_contents();
            $this->assertEmpty($content);

            $ob_level = ob_get_level();
            $this->assertEquals(1, $ob_level);

            return;
        }

        $this->fail("An Exception should've been thrown and caught during this test");

    }
}
