<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExchangeResource;
use App\Services\ExchangeService;
use Illuminate\Http\Request;

/**
 *
 */
class QuizController extends Controller
{
    private $exchangeService;

    public function __construct(
        ExchangeService $exchangeService
    ) {
        $this->exchangeService = $exchangeService;
    }

    public function getExchangeRate(Request $request)
    {
        $response = collect([]);
        // TODO: 實作取得匯率
        $from = $request->get('from');
        $to = $request->get('to');
        $exchange_rate = $this->exchangeService->getExchangeRate($from, $to);
        if(!empty($exchange_rate["error"])){
            $response->error = $exchange_rate["error"];
            $response->updated_at = date_format(now(+8), "Y-m-d H:i:s");
        } else {
            $response->exchange_rate = $exchange_rate;
            $response->updated_at = date_format(now(+8), "Y-m-d H:i:s");
        }

        // API回傳結果
        return new ExchangeResource($response);
    }
}
