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
     * @OA\Get(
     *     path="/api/order",
     *     operationId="getOrders",
     *     tags={"Order"},
     *     summary="Get a list of orders",
     *     description="Returns a list of orders with optional filtering",
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Order ID",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="status_id",
     *         in="query",
     *         description="Status ID of the order",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function index(Request $request)
    {

        return response()->json($this->orderService->index($request));
    }

    /**
     * @OA\Post(
     *     path="/api/order",
     *     operationId="StoreOrder",
     *     tags={"Order"},
     *     summary="store order",
     *     description="store order and packages with required fields",
     *     @OA\Parameter(
     *         name="receiver_name",
     *         description="receiver name",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="receiver_address",
     *         description="receiver address",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="receiver_phone",
     *         description="receiver phone number",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="receiver_postal_code",
     *         description="receiver postal code",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="sender_name",
     *         description="sender name",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="sender_address",
     *         description="sender address",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="sender_phone",
     *         description="sender phone number",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="sender_postal_code",
     *         description="sender postal code",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="packages",
     *         description="get packages weight in array",
     *         required=false,
     *         @OA\Schema(
     *             type="array",
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
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
    public function statusesIndex(): array
    {
        return $this->orderService->statusesIndex();
    }
}
