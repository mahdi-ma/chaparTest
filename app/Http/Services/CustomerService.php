<?php

namespace App\Http\Services;

use App\Models\Customer;

class CustomerService
{
    public function __construct(protected Customer $order)
    {

    }

    public function storeCustomer($customerData, $type)
    {
        if ($type === 'receiver') {

            $data = [
                'name' => $customerData->receiver_name,
                'address' => $customerData->receiver_address,
                'phone' => $customerData->receiver_phone,
                'postal_code' => $customerData->receiver_postal_code,
            ];
        } else {
            $data = [
                'name' => $customerData->sender_name,
                'address' => $customerData->sender_address,
                'phone' => $customerData->sender_phone,
                'postal_code' => $customerData->sender_postal_code,
            ];
        }
        $customer = Customer::create($data);
        return $customer->id;
    }
}
