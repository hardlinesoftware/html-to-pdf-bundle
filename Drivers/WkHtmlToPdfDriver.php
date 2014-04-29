<?php

namespace EP\Bundle\HtmlToPdfBundle\Drivers;

use EP\Bundle\HtmlToPdfBundle\Drivers\Exceptions\GenerationException;
use EP\Bundle\HtmlToPdfBundle\Drivers\Features\SupportsPageMarginsInterface;
use Symfony\Component\Process\Process;

class WkHtmlToPdfDriver implements DriverInterface, SupportsPageMarginsInterface
{
    private $binaryPath;

    /**
     * @var \WkHtmlToPdf
     */
    private $converter;

    private $margins;

    public function setPageMargins($top, $right, $bottom, $left)
    {
        $this->options += [
            'margin-top'    => $top,
            'margin-right'  => $right,
            'margin-bottom' => $bottom,
            'margin-left'   => $left
        ];
    }


    public function __construct(\WkHtmlToPdf $converter = null)
    {
        $platform = php_uname('s');
        switch (strtolower($platform)) {
            case 'darwin':
                $this->binaryPath = __DIR__ . '/../Resources/bin/wkhtmltopdf.app/Contents/MacOS/wkhtmltopdf';
                break;
            case 'linux':

                $machineType = php_uname('m');

                switch(true) {
                    case (strpos($machineType, '64') !== -1 ):
                        $this->binaryPath = __DIR__ . '/../vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64';
                        break;
                    case ('i386' == $machineType):
                        $this->binaryPath = __DIR__ . '/../vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64';
                        break;
                    default:
                        throw new \RuntimeException('WkHtmlToPdf driver does not support machine type: '. $machineType);

                }

                break;
            default:
                throw new \RuntimeException('WkHtmlToPdf driver does not support platform: ' . $platform);

        }


        if (is_null($converter)) {
            $converter = new \WkHtmlToPdf();
        }

        $this->converter = $converter;
        $this->options = [
            'binPath'       => $this->binaryPath
        ];
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
        $this->converter->setOptions($this->options);

        $this->converter->addPage($html);
        $success = $this->converter->saveAs($outfile);

        if (!$success) {
            throw new GenerationException($this->converter->getError());
        }

        return true;
    }


}