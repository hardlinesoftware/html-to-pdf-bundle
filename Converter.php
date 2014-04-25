<?php

namespace EP\Bundle\HtmlToPdfBundle;

use EP\Bundle\HtmlToPdfBundle\Drivers\DriverInterface;

class Converter
{

    /**
     * @var Drivers\DriverInterface
     */
    private $driver;

    public function __construct(DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    /**
     * Generate a PDF from HTML, and place the resultant file
     * in specified outfile.
     *
     * @param $html     string
     * @param $outfile
     */
    public function generate($html, $outfile)
    {
        return $this->driver->generate($html, $outfile);
    }
}