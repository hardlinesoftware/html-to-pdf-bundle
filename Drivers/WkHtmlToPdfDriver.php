<?php

namespace EP\Bundle\HtmlToPdfBundle\Drivers;

class WkHtmlToPdfDriver implements DriverInterface
{

    public function __construct()
    {

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