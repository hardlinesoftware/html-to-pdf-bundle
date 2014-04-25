<?php

namespace EP\Bundle\HtmlToPdfBundle;

class ConverterTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $driver;

    /**
     * @var Converter
     */
    private $converter;

    public function setUp()
    {
        $this->driver = $this->getMock('EP\Bundle\HtmlToPdfBundle\Drivers\DriverInterface');
        $this->converter = new Converter($this->driver);
    }

    public function testCallsGenerateMethod()
    {
        $html = '<html></html>';
        $filename = 'example.txt';

        $this->driver->expects($this->once())->method('generate')->with($html, $filename);
        $this->converter->generate($html, $filename);
    }
}