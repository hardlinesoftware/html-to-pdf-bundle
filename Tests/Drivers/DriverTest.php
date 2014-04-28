<?php

namespace EP\Bundle\HtmlToPdfBundle\Drivers;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;

abstract class DriverTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var  vfsStreamDirectory
     */
    private $root;

    /**
     * @return DriverInterface
     */
    protected abstract function getDriver();

    protected function getDriverName()
    {
        $driver = $this->getDriver();
        if (!is_object($driver)) {
            throw new \LogicException('Invalid driver supplied for tests');
        }

        return get_class($driver);
    }

    public function setUp()
    {
        $this->root = vfsStream::setup();
    }

    public function testDriverImplementsInterface()
    {
        $driver = $this->getDriver();
        $this->assertInstanceOf('EP\Bundle\HtmlToPdfBundle\Drivers\DriverInterface', $driver);
    }

    private function generatePdf()
    {
        $driver = $this->getDriver();

        $filename = 'root/outfile.pdf';
        $html = '<html></html>';

        $file = vfsStream::url($filename);

        $this->assertFalse($this->root->hasChild($filename));

        $driver->generate($html, $file);

        return $filename;

    }

    public function testFileIsCreated()
    {
        $filename = $this->generatePdf();

        $this->assertTrue(
            $this->root->hasChild($filename),
            sprintf('Driver %s did not create file', $this->getDriverName())
        );

    }

    /**
     * @depends testFileIsCreated
     */
    public function testFileIsNotEmpty()
    {
        $filename = $this->generatePdf();

        $this->assertFalse((0 == $this->root->getChild($filename)->size()), 'File is empty!');
    }


}