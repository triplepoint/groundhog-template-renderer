<?php

namespace Groundhog\TemplateRenderer\Tests;

use Groundhog\TemplateRenderer\RequestRootUri;

class RequestRootUriTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerateUriWithoutSpecifiedScheme()
    {
        $mock_request = $this->getMock('\Groundhog\TemplateRenderer\RequestInterface');
        $mock_request->expects($this->any())
            ->method('getUriForPath')
            ->will($this->returnValue('http://www.whatever.com/'));

        $helper = new RequestRootUri($mock_request);

        $uri = $helper->render();

        $this->assertSame('http://www.whatever.com/', $uri);
    }

    public function testGenerateUriWithSpecifiedScheme()
    {
        $mock_request = $this->getMock('\Groundhog\TemplateRenderer\RequestInterface');
        $mock_request->expects($this->any())
            ->method('getUriForPath')
            ->will($this->returnValue('http://www.whatever.com/'));

        $helper = new RequestRootUri($mock_request);

        $helper->setScheme('https');

        $uri = $helper->render();

        $this->assertSame('https://www.whatever.com/', $uri);
    }

}
