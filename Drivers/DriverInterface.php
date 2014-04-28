<?php

namespace EP\Bundle\HtmlToPdfBundle\Drivers;

interface DriverInterface
{
    /**
     * Generate a PDF from HTML, and place the resultant file
     * in specified outfile.
     *
     * @param $html     string
     * @param $outfile
     */
    public function generate($html, $outfile);

    public function supportsCurrentPlatform();
}