<?php


namespace App\Service;


interface CoreBudgetInterface
{

    /**
     * Get economies
     * @return float
     */
    public function getEconomies() : float;

    public function formatExpensesForChart() : array;

}