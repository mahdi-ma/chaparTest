<?php

namespace App\Http\Services;

use App\Models\Customer;

class CustomerService
{
    public function __construct(protected Customer $order)
    {

    }

}
