<?php

namespace EP\Bundle\HtmlToPdfBundle\Drivers;

use Symfony\Component\Process\Process;

class WkHtmlToPdfDriver implements DriverInterface
{
    private $binaryPath;

    /**
     * @var \WkHtmlToPdf
     */
    private $converter;

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
            $converter = new \WkHtmlToPdf([
                'binPath'   => $this->binaryPath
            ]);
        }
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
        $this->converter->addPage($html);
        $this->converter->saveAs($outfile);
    }


}