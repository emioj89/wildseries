<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default/", name="app_index")
     *  @return Response
     */

    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'website' => 'Wild Séries',
        ]);
    }


}
