<?php


namespace App\Service;


use App\Service\Utils\Calculator;

interface ExpensesInterface
{

    public function findAll() : array;

    public function getTotalPreviousMonth() : float;

}