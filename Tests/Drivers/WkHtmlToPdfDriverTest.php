<?php

namespace EP\Bundle\HtmlToPdfBundle\Drivers;

use EP\Bundle\HtmlToPdfBundle\Drivers\Exceptions\GenerationException;
use org\bovigo\vfs\vfsStream;

class WkHtmlToPdfDriverTest extends DriverTest
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $converter;

    public function setUp()
    {
        parent::setUp();

        $this->converter = $this->getMock('\WkHtmlToPdf');
    }


    /**
     * @return WkHtmlToPdfDriver
     */
    protected function getDriver()
    {
        return new WkHtmlToPdfDriver();
    }

    /**
     * @expectedException \EP\Bundle\HtmlToPdfBundle\Drivers\Exceptions\GenerationException
     */
    public function testFailingGenerationThrowsException()
    {
        vfsStream::setup();

        $driver = $this->getDriver();
        $driver->setConverter($this->converter);

        $html = '<html></html>';
        $outfile = vfsStream::url('root/outfile.pdf');

        $this->converter->expects($this->once())->method('addPage')->with($html);
        $this->converter->expects($this->once())->method('saveAs')->with($outfile)->willReturn(false);

        $driver->generate($html, $outfile);

    }

    public function testGenerationProcess()
    {
        vfsStream::setup();

        $driver = $this->getDriver();
        $driver->setConverter($this->converter);

        $html = '<html></html>';
        $outfile = vfsStream::url('root/outfile.pdf');

        $this->converter->expects($this->once())->method('addPage')->with($html);
        $this->converter->expects($this->once())->method('saveAs')->with($outfile)->willReturn(true);

        $driver->generate($html, $outfile);

    }

}