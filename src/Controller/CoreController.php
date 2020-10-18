<?php


namespace App\Controller;


use App\Entity\Expense;
use App\Service\CoreBudgetInterface;
use App\Service\ExpensesInterface;
use App\Service\IncomesInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoreController extends AbstractController
{

    /**
     * @var ExpensesInterface
     */
    private $expService;
    /**
     * @var IncomesInterface
     */
    private $incService;

    private $service;

    public function __construct(ExpensesInterface $expService, IncomesInterface $incService, CoreBudgetInterface $service)
    {
        $this->expService = $expService;
        $this->incService = $incService;
        $this->service = $service;
    }

    /**
     * @Route("/", name="index")
     * @return Response
     */
    public function index() {

        $doctrine = $this->getDoctrine();
        $expenses = $doctrine->getRepository(Expense::class);

        return $this->render('dashboard.html.twig', [
            'lastExpenses' => $expenses->findBy([], ['date' => 'DESC'], ['limit' => 10]),
            'totalExpenses' => $this->expService->getTotalPreviousMonth(),
            'balance' => $this->incService->getBalance(),
            'totalIncomes' => $this->incService->getCurrentIncomes(),
            'economies' => $this->service->getEconomies(),
            'chart' => $this->service->formatExpensesForChart()
        ]);
    }

}