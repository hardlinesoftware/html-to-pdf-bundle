<?php

namespace EP\Bundle\HtmlToPdfBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use EP\Bundle\HtmlToPdfBundle\Converter;
use Symfony\Component\HttpFoundation\Response;

class PreflightController implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    private $fixtureNames = ['simple', 'test-card'];

    private $fixtures = [];
    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        $fixtureDir = __DIR__ . '/../Resources/fixtures/';

        foreach ($this->fixtureNames as $htmlSource) {

            $this->fixtures[$htmlSource] = $fixtureDir . $htmlSource . '.html';
        }
    }


    public function generateFromFixturesAction($fixture)
    {

        /**
         * @var Converter $converter
         */
        $converter = $this->container->get('ep_html_to_pdf.converter');

        $tempFile = $this->tempFileName();

        $converter->generate(file_get_contents($this->fixtures[$fixture]), $tempFile);

//        var_dump($tempFile);exit;

        $response = new Response(file_get_contents($tempFile), Response::HTTP_OK, [
            'Content-type' => 'application/pdf'
        ]);

        return $response;

    }

    private function tempFileName()
    {
        return tempnam(sys_get_temp_dir(), 'pdf_');
    }
}