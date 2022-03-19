<?php

namespace App\Services;

use App\Constants\CurrencyConstant;
use App\Repositories\CurrencyRepository;

/**
 *
 */
class ExchangeService
{
    private $currencyRepo;

    public function __construct(CurrencyRepository $currencyRepository)
    {
        $this->currencyRepo = $currencyRepository;
    }

    public function getExchangeRate(string $from, string $to, $amount = 1)
    {
        if(!in_array($from, array_values($this->currencyRepo->getCurrencyList()))){
            return ["error" => "Input 'from' error"];
        }
        if(!in_array($to, array_values($this->currencyRepo->getCurrencyList()))){
            return ["error" => "Input 'to' error"];
        }
        $exchange_from = $this->currencyRepo->getExchangeRate($from)["Exrate"];
        $exchange_to = $this->currencyRepo->getExchangeRate($to)["Exrate"];
        return round($amount / $exchange_from * $exchange_to, 5);
    }
}
