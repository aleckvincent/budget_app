<?php


namespace App\Controller;


use App\Entity\Expense;
use App\Service\ExpensesInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoreController extends AbstractController
{

    /**
     * @Route("/", name="index")
     * @param ExpensesInterface $serviceExpense
     * @return Response
     */
    public function index(ExpensesInterface $serviceExpense) {

        $doctrine = $this->getDoctrine();
        $expenses = $doctrine->getRepository(Expense::class);
        return $this->render('dashboard.html.twig', [
            'lastExpenses' => $expenses->findBy([], ['date' => 'DESC'], ['limit' => 10]),
            'totalExpenses' => $serviceExpense->getTotalPreviousMonth()
        ]);
    }

}