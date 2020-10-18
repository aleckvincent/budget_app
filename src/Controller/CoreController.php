<?php


namespace App\Controller;


use App\Entity\Expense;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoreController extends AbstractController
{

    /**
     * @Route("/", name="index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index() {

        $doctrine = $this->getDoctrine();
        $expenses = $doctrine->getRepository(Expense::class);
        return $this->render('dashboard.html.twig', [
            'lastExpenses' => $expenses->findBy([], ['date' => 'DESC'], ['limit' => 10])
        ]);
    }

}