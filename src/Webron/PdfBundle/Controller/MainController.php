<?php
/**
 * Created by PhpStorm.
 * User: Georg
 * Date: 7. 4. 2015
 * Time: 13:37
 */

namespace Webron\PdfBundle\Controller;

use Webron\CoreBundle\Controller\WebronCoreController;
use Symfony\Component\HttpFoundation\Response;

class MainController extends WebronCoreController {

    public function testAction() {
        ini_set('max_execution_time', 0);
        $parameters = $this->prepareParameters();

        $html = $this->renderView('WebronPdfBundle:Default:index.html.twig', array(
            'name'  => 'nemo'
        ));

//        $response = $this->generatePdfAsResponse($html, 'file.pdf');
        $this->generatePdf($html, $parameters['base'].'testPdf/', 'file.pdf', 'landscape');

//        return $response;
    }

    public function generatePdfAsResponse($html, $fileName='file.pdf', $orientation='portrait') {
        $response = new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html,
                    array(
                        'orientation'           => $orientation,
                        'header-left'           => '',
                        'header-right'          => '[page]/[toPage]',
                        'header-line'           => true,
                        'encoding'              => 'UTF-8',
                        'user-style-sheet'      => 'bundles/eps/vendor/css/pdf.css',
                        'zoom'                  => 1.0
                    )
                ),
            200,
            array(
                'Content-Type'          => 'application/pdf'
//                'Content-Disposition'   => 'attachment; filename="'.$fileName.'"'
            )
        );

        return $response;
    }

    public function generatePdf($html, $filePath, $fileName='file.pdf', $orientation='portrait') {
        $this->get('knp_snappy.pdf')->generateFromHtml(
            $html,
            $filePath.$fileName,
            array(
                'orientation'           => $orientation,
                'header-left'           => '',
                'header-right'          => '[page]/[toPage]',
                'header-line'           => true,
                'encoding'              => 'UTF-8',
                'user-style-sheet'      => 'bundles/eps/vendor/css/pdf.css',
                'zoom'                  => 1.0
            )
        );
    }
}
