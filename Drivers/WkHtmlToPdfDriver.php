<?php

namespace EP\Bundle\HtmlToPdfBundle\Drivers;

class WkHtmlToPdfDriver implements DriverInterface
{
    /**
     * @var \WkHtmlToPdf
     */
    private $converter;

    public function __construct(\WkHtmlToPdf $converter = null)
    {
        $this->converter = $converter;
    }

    /**
     * @param \WkHtmlToPdf $converter
     */
    public function setConverter($converter)
    {
        $this->converter = $converter;
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
        file_put_contents($outfile, '');
    }


}