<?php


namespace App\Service\impl;


use App\Entity\Expense;
use App\Service\ExpensesInterface;
use App\Service\Utils\Calculator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints\Date;

class ExpensesService implements ExpensesInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var Calculator
     */
    private $calculator;

    public function __construct(EntityManagerInterface $em, Calculator $calculator)
    {
        $this->em = $em;
        $this->calculator = $calculator;
    }


    public function findAll(): array
    {
        return $this->em->getRepository(Expense::class)->findAll();
    }

    public function getTotalPreviousMonth(): float
    {
        $previousMonth = new \DateTime('-1 month');
        $previousMonth = $previousMonth->format('m');

        $result = $this->em->getRepository(Expense::class)->findByMonth($previousMonth);
        return $this->calculator->calculateAmount($result);

    }
}