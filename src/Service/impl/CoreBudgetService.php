<?php


namespace App\Service\impl;


use App\Entity\Expense;
use App\Entity\Income;
use App\Service\Utils\Calculator;
use Doctrine\ORM\EntityManagerInterface;
use DoctrineExtensions\Query\Mysql\Exp;

class CoreBudgetService implements \App\Service\CoreBudgetInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var Calculator
     */
    private $calculator;

    /**
     * @var string
     */
    private $month;

    private $prevMonth;

    public function __construct(EntityManagerInterface $em, Calculator $calculator)
    {
        $this->em = $em;
        $this->calculator = $calculator;
        $month = new \DateTime();
        $this->month = $month->format('m');
        $prevMonth = new \DateTime('-1 month');
        $this->prevMonth = $prevMonth->format('m');
    }

    /**
     * @inheritDoc
     */
    public function getEconomies(): float
    {

        $prevExpenses = $this->em->getRepository(Expense::class)->findByMonth($this->prevMonth);
        $prevIncomes = $this->em->getRepository(Income::class)->findByMonth($this->prevMonth);
        $prevBalance = $this->calculator->balance($prevExpenses, $prevIncomes);

        $currentExp = $this->em->getRepository(Expense::class)->findByMonth($this->month);
        $currentInc = $this->em->getRepository(Income::class)->findByMonth($this->month);
        $currentBalance = $this->calculator->balance($currentExp, $currentInc);
        return $this->calculator->subtract($currentBalance, $prevBalance);
    }


    public function formatExpensesForChart(): array
    {
        $year = new \DateTime();
        $year = $year->format('Y');
        $expenses = $this->em->getRepository(Expense::class)->findAmountByYear($year);

        return $expenses;
    }
}