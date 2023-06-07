<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Stock;


use App\Cart;
use Session;
use DB;
use Auth;
use App\DataTables\ItemsDataTable;

use App\Imports\ItemImport;
use App\Imports\ItemStockImport;
use App\Imports\CustomerSheetImport;
use App\Imports\CustomerItemSheetsImport;

use Maatwebsite\Excel\Facades\Excel;
use App\Rules\ItemExcelRule;



class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ItemsDataTable $dataTable)
    {
        return $dataTable->render('items.index');
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

    public function getItems(){
        // $items = DB::table('item')->join('stock', 'item.item_id', '=', 'stock.item_id')->get();
        // $items = Item::with('stock')->paginate(3);
        $items = Item::with('stock')->whereHas('stock')->paginate(4);
        // dd($items);
        // $items = Item::all();
        return view('shop.index', compact('items'));
    }
    public function addToCart( $id){
        $item = Item::find($id);
        // $oldCart = Session::has('cart') ? $request->session()->get('cart'): null;
        $oldCart = Session::has('cart') ? Session::get('cart'): null;
        $cart = new Cart($oldCart);
        
        $cart->add($item, $item->item_id);
        // $request->session()->put('cart', $cart);
        Session::put('cart', $cart);
    
        // $request->session()->save();
        // Session::save();
        return redirect()->route('getItems');
        // dd(Session::all());
    }
    public function getCart() {

        if (!Session::has('cart')) {

            return view('shop.shopping-cart');

        }

        $oldCart = Session::get('cart');

        $cart = new Cart($oldCart);

        // dd($oldCart);

        return view('shop.shopping-cart', ['items' => $cart->items, 'totalPrice' => $cart->totalPrice]);

    }
    public function removeItem($id){
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items)>0){
            Session::put('cart', $cart);
            Session::save();
        }
        else{
            Session::forget('cart');
        }
        return redirect()->route('shoppingCart');
    }

    public function getReduceByOne($id){
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
            
        }
        else{
            Session::forget('cart');
        }
        return redirect()->route('shoppingCart');
    }

    public function postCheckout(Request $request){
        if (!Session::has('cart')){
            return redirect()->route('getItems');
        }
        $oldCart=Session::get('cart');
        $cart = new Cart($oldCart);

        try {
            DB::beginTransaction();
            
            // dd(Auth::id());
        $customer = Customer::where('user_id',Auth::id())->first();
        // $customer->orders()->save($order);
        // $order->customer_id=$customer->customer_id;
        $order = new Order();
        $order->customer_id = $customer->customer_id;
        $order->date_placed = now();
        $order->date_shipped = now();
        $order->shipping = 10.00;
        $order->status = 'Processing';
        $order->save();
        $customer->orders()->save($order);
        // $order->customer_id=$customer->customer_id;

        foreach($cart->items as $items){
            $id = $items['item']['item_id'];
            // DB::table('orderline')->insert(
            //     ['item_id'=>$id,
            //     'orderinfo_id' => $order->orderinfo_id,
            //     'quantity'=>$items['qty']]
            // );
            $order->items()->attach($id,['quantity'=>$items['qty']]);
            $stock = Stock::find($id);
            $stock->quantity = $stock->quantity - $items['qty'];
            $stock->save();
        }
        }
        catch(\Exception $e){
            DB::rollback();
            return redirect()->route('shoppingCart')->with('error', $e->getMessage());
        }
        DB::commit();
        Session::forget('cart');
        return redirect()->route('getItems')->with('success','Successfully Purchased Your Products!!!');
        
    }
    public function import(Request $request) 
    {
        $request->validate([
            'item_upload' => [
                'required',
                new ItemExcelRule($request->file('item_upload')),
            ],
        ]);
        Excel::import(new CustomerItemSheetsImport, request()->file('item_upload')
        ->storeAs('files',
    request()->file('item_upload')->getClientOriginalName()));
        
        return redirect()->back()->with('success','Excel file imported successfully');
    }
}