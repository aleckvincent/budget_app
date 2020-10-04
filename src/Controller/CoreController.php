<?php


namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;

class CoreController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    /**
     * @Route("/", name="index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index() {
        return $this->render('dashboard.html.twig');
    }

}