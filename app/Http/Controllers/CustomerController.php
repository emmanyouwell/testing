<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Item;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $customers = Order::find(1);
        // // dd($customers);
        // // dump($customers->orders->name);
        // foreach($customers as $customer){
        //     dump($customer);
        // }
        // $order = Order::find(1);
        // dump($order->items);
        // $item = Item::find(4);
        // dump($item->orders);
        // $customer = Customer::find(1);
        // dump($customer->orders);
        // $order = Order::find(1);
        // dump($order->customer->customer_id, $order->customer->lname);
        // $customer = Customer::find(19);
        // dump($customer->user);
        // $order = Order::find(1);
        // dump($order);
        // foreach($order->items as $orders){
        //     dump($orders->description, $orders->pivot->quantity);
        // }
        // $customers = Customer::all();
        // dump($customers);
        // foreach($customers as $customer){
        //     dump($customer->orders);
        //     foreach($customer->orders as $order){
        //         dump($order->orderinfo_id, $order->date_placed);
        //     }
        // }
        // $customer = Customer::with('orders')->get();
        // dump($customer);
        // foreach($customer as $orders){
        //     dump($orders->orders);
        //     foreach($orders->orders as $order){
        //         dump($order->date_placed);
        //     }
        // }
        // $orders = Order::with('customer')->where('orderinfo_id',24)->get();
        // dump($orders);
        // foreach($orders as $order){
        //     dump($order->orderinfo_id, $order->date_placed, $order->customer->lname, $order->customer->addressline);
        // }
        // $orders = Order::with('items')->get();
        // dump($orders);
        // foreach($orders as $order){
        //     dump($order->orderinfo_id, $order->date_shipped, $order->shipping);
        //     foreach($order->items as $items){
        //         dump($items->item_id, $items->description, $items->pivot->quantity);
        //     }
        // }
        // $items = Item::with('orders')->where('item_id',1)->get();
        // dump($items);
        // foreach($items as $item){
        //     dump($item->description);
        //     foreach($item->orders as $orders){
        //         dump($orders->orderinfo_id, $orders->shipping);
        //     }
        // }

        $orders = Order::with(['customer','items'])->get();
        dump($orders);
        foreach($orders as $order){
            dump($order->customer->lname, $order->customer->addressline, $order->orderinfo_id, $order->date_shipped, $order->shipping);
            foreach($order->items as $item){
                dump($item->item_id, $item->description, $item->sell_price,$item->pivot->quantity);
            }
        }
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
