<?php


namespace App\Service\Utils;


use App\Entity\Expense;
use App\Entity\Income;

class Calculator
{

    /**
     * Calculate a total
     * @param Expense[]|Income[] $values
     * @return float
     */
    public function calculateAmount(array $values) : float
    {
        $total = 0;
        foreach ($values as $v) {
           $total += $v->getAmount();
        }

        return $total;
    }

    /**
     * Calculate balance beteween expenses and incomes
     * @param Expense[] $expenses
     * @param Income[] $incomes
     * @return float
     */
    public function balance(array $expenses, array $incomes) : float
    {
        $totalExp = $this->calculateAmount($expenses);
        $totalInc = $this->calculateAmount($incomes);

        return $totalInc - $totalExp;
    }

}