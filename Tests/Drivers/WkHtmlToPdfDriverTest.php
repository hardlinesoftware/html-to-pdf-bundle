<?php

namespace EP\Bundle\HtmlToPdfBundle\Drivers;

class WkHtmlToPdfDriverTest extends DriverTest
{
    /**
     * @return DriverInterface
     */
    protected function getDriver()
    {
        return new WkHtmlToPdfDriver();
    }

}