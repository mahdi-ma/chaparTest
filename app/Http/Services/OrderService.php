<?php

namespace App\Http\Services;

use App\Models\Order;
use Illuminate\Support\Str;

class OrderService
{
    public function __construct(protected Order $order, protected CustomerService $customerService)
    {

    }

    public function storeOrder($orderRequest)
    {
        $receivedById = $this->customerService
            ->storeCustomer($orderRequest, 'receiver');
        $sendById = $this->customerService
            ->storeCustomer($orderRequest, 'sender');

        $order = Order::create([
            'send_by' => $sendById,
            'received_by' => $receivedById,
            'package_count' => count($orderRequest->packages)
        ]);
        $packagesData = [];
        foreach ($orderRequest->packages as $package) {
            $packagesData[] = [
                'weight' => $package,
                'barcode' => random_int(100000000000, 999999999999)
            ];
        }
        $order->packages()->createMany($packagesData);
        return $order;
    }
}
