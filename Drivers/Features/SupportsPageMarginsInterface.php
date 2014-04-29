<?php

namespace EP\Bundle\HtmlToPdfBundle\Drivers\Features;

interface SupportsPageMarginsInterface
{
    public function setPageMargins($top, $right, $bottom, $left);
}