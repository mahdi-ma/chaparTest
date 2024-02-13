<?php

namespace App\Http\Services;

use App\Models\Order;

class OrderService
{
    public function __construct(protected Order $order)
    {

    }

}
