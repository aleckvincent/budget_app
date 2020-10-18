<?php


namespace App\Service\impl;


use App\Entity\Expense;
use App\Entity\Income;
use App\Service\Utils\Calculator;
use Doctrine\ORM\EntityManagerInterface;

class IncomesService implements \App\Service\IncomesInterface
{
    /**
     * @var Calculator $calculator
     */
    private $calculator;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(Calculator $calculator, EntityManagerInterface $em)
    {
        $this->calculator = $calculator;
        $this->em = $em;
    }

    public function getBalance() : float
    {
        $month = new \DateTime();
        $month = $month->format('m');
        $incomes = $this->em->getRepository(Income::class)->findByMonth($month);
        $expenses = $this->em->getRepository(Expense::class)->findByMonth($month);

        return $this->calculator->balance($expenses, $incomes);
    }

    /**
     * Get incomes of the current month
     * @return float
     */
    public function getCurrentIncomes(): float
    {
        $month = new \DateTime();
        $month = $month->format('m');
        $incomes = $this->em->getRepository(Income::class)->findByMonth($month);
        return $this->calculator->calculateAmount($incomes);
    }
}