<?php

namespace App\Http\Services;

use App\Models\Order;
use App\Models\Status;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class OrderService
{
    public function __construct(protected Order $order, protected CustomerService $customerService)
    {
    }

    public function index($request): LengthAwarePaginator
    {
        $query = Order::query();
        if ($request->has('id')) {
            $query->where('id', $request->input('id'));
        }
        if ($request->has('status_id')) {
            $query->where('status_id', $request->input('status_id'));
        }
        return $query->paginate(10);
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
        return response()->json($order);
    }

    public function updateOrder($order, $orderRequest)
    {
        $order->update(['status_id', $orderRequest->status_id]);
        $order->statses()->save($orderRequest->status_id);
        return response()->json($order);
    }

    public function packageCount($order)
    {
        return response()->json($order->packages->count());
    }

    public function statusesIndex(): array
    {
        return Status::query()->select('name', 'id')->get()->toArray();
    }
}
