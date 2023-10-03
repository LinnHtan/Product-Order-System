<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //listPage
    public function listPage()
    {
        $order = Order::select('orders.*', 'users.name as user_name', 'orders.total_price as order_price')
            ->when(request('searchKey'), function ($query) {
                $key = request('searchKey');
                $query->orWhere('users.name', 'like', "%" . $key . "%")
                    ->orWhere('orders.total_price', 'like', "%" . $key . "%");
            })
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.order.list', compact('order'));
    }
    //change status
    public function changeStatus(Request $request)
    {
        $status = $request->orderStatus;

        $orderQuery = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->orderBy('created_at', 'desc');

        if ($status !== null) {
            $orderQuery->where('orders.status', $status);
        }

        $order = $orderQuery->get();

        return view('admin.order.list', compact('order'));
    }

    //ajax change status
    public function ajaxChangeStatus(Request $request)
    {
        Order::where('id', $request->orderId)->update([
            'status' => $request->status,
        ]);
        $orderQuery = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->orderBy('created_at', 'desc');

        $order = $orderQuery->get();
        return response()->json($order, 200);
    }

    //list info
    public function listInfo($orderCode)
    {
        $order = Order::where('order_code', $orderCode)->first();
        $orderList = OrderList::select('order_lists.*', 'users.name as user_name', 'products.name as product_name', 'products.image as product_image', 'products.category_id as productCat_id')
            ->leftJoin('users', 'order_lists.user_id', 'users.id')
            ->leftJoin('products', 'products.id', 'order_lists.product_id')
            ->where('order_code', $orderCode)
            ->get();
        return view('admin.order.detail', compact('orderList', 'order'));
    }

}
