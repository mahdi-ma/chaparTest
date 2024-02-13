<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Services\OrderService;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        return response()->json($this->orderService->index($request));
    }

    public function store(StoreOrderRequest $request): JsonResponse
    {
        return $this->orderService->storeOrder($request);
    }

    public function update(UpdateOrderRequest $request, Order $order): JsonResponse
    {
        return $this->orderService->updateOrder($order, $request);
    }

    public function packageCount(Order $order): JsonResponse
    {
        return $this->orderService->packageCount($order);
    }
}
