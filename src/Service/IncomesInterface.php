<?php


namespace App\Service;


interface IncomesInterface
{

    /**
     * Get balance between expenses and incomes
     * @return float
     */
    public function getBalance() : float;

    /**
     * Get incomes of the current month
     * @return float
     */
    public function getCurrentIncomes() : float;

}