<?php

namespace App\Http\Controllers;

use App\Item;
use App\Order;
use App\OrderItem;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function create(Request $request){
        $data = $request->all();
        $validator = Validator::make($data,[
            'kategori_barang' => 'required|string',
            'nama_barang' => 'required|string|min:5|max:80',
            'harga_barang' => 'required|string',
            'jumlah_barang' => 'required|integer',
            'foto_barang' => 'required|image|max:10240'

        ]);
        if($validator->fails()){
            return redirect(route('viewHome'))->withErrors($validator)->withInput();
        }

        $path = $request->file('foto_barang')->store('image_assets');




        Item::create([
            'kategori_barang'=> $request->kategori_barang,
            'nama_barang'=> $request->nama_barang,
            'harga_barang'=> $request->harga_barang,
            'jumlah_barang'=> $request->jumlah_barang,
            'foto_barang'=> $path
        ]);
        return redirect(route('viewHome'))->with('success','Data Berhasil terkirim ke Database');
    }

    public function show(Request $request){

        $items = Item::paginate(5);
        $user=Auth::user();
        return view('show',compact('items'));
    }

    public function edit($id){
        $items = Item::find($id);

         return view('edit_item',compact('items'));
     }

     public function update($id,Request $request){
         $data = $request->all();

         $validator = Validator::make($data,[
            'kategori_barang' => 'required|string',
            'nama_barang' => 'required|string|min:5|max:80',
            'harga_barang' => 'required|string',
            'jumlah_barang' => 'required|integer',
            'foto_barang' => 'required|image|max:10240'

         ]);
         if($validator->fails()){
             return redirect('/item/show');
         }

         $item = Item::find($id);
         Storage::delete($item->foto_barang);

         $item->kategori_barang = $request->kategori_barang;
         $item->nama_barang = $request->nama_barang;
         $item->harga_barang = $request->harga_barang;
         $item->jumlah_barang = $request->jumlah_barang;
         if($request->has('foto_barang')){
             $path=$request->file('foto_barang')->store('image_assets');
             $item->foto_barang=$path;
         }else{
             $path=$item->path;
         }


         $item->save();
         return redirect('/item/show')->with('success','Data Item Berhasil diUbah');
     }


     public function delete($id){
         $item = Item::find($id);
         Storage::delete($item->foto_barang);
         $item->delete();

         return redirect()->back();
     }

     public function showData(Request $request,$id){
        $items = Item::find($id);
        $new_items=Item::all();

        return view('/showData',compact('items','new_items'));
    }

     public function addToCart(Request $request, $itemId){
        $currCart = Order::where('user_id',auth()->user()->id)
        ->where('status','ACTIVE')->first();
        $item=Item::find($itemId);

         if($item->jumlah_barang==0){
            return redirect('/item/show')->with('error', 'Barang Sudah Habis, silahkan tunggu hingga barang di restock ulang!');
         }else{

            if($currCart==NULL){
                $currCart= Order::create([
                   'user_id' => auth()->user()->id,
                   'status' => 'ACTIVE'
                ]);
            }
            $newOrderItem = OrderItem::create([
                'order_id' => $currCart->id,
                'item_id' => $item->id,
                'price' => $item->harga_barang,
                'quantity' => $request->jumlah_barang
             ]);

             $item->jumlah_barang -= $request->jumlah_barang;
             $item->save();
             return redirect('/item/show')->with('success','Item Add to Cart');
         }

     }

     public function deleteCartItem($itemId) {
         $orderItem = OrderItem::find($itemId);
         if ($orderItem == NULL){
            return redirect('/item/show')->with('error', 'Tidak Ada Barang!');
         }
         $orderItem->delete();
         return redirect('/item/show')->with('success','Success Delete Item in your Cart');
     }

     public function checkout(Request $request) {
         $currentCart = Order::where('user_id', auth()->user()->id)
        ->where('status', 'ACTIVE')->first();

        //  $validator = Validator::make($currentCart,[
        //     'kode_pos' => 'required|string|min:5|max:5',
        //     'alamat' => 'required|string|min:10|max:100',
        //  ]);

        if ($currentCart == NULL ) {
            return redirect('/item/cart')->with('error', 'Failed Checkout Cart');
        }

        $totalPrice = 0;
        foreach ($currentCart->orderItems as $cartItem) {
            $totalPrice += $cartItem->quantity * $cartItem->price;

        }

        $currentCart->status        = 'SUCCESS';
        $currentCart->alamat        = $request->alamat;
        $currentCart->kode_pos      = $request->kode_pos;
        $currentCart->total_price   = $totalPrice;
        $currentCart->invoice_id    = $this->generateRandomString(10);
        $currentCart->save();

        return redirect('/item/checkout')->with('success','Item Berhasil di Checkout!');
     }


     public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function showCheckout(Request $request){
        $orders=Order::all();

        return view('/checkout',compact('orders'));
    }

     public function showCart(Request $request){
        $currCart = Order::where('user_id',auth()->user()->id)
        ->where('status','ACTIVE')->first();
        if($currCart==NULL){
            return redirect('/item/show')->with('error','No Item in Cart!, Please Add item to Cart First');
        }
        $cartItems = $currCart->orderItems;
        return view('/cart',compact('cartItems'));
    }

    public function homePage(Request $request){
        $items=Item::all();
        if ($items == NULL ) {
            return redirect('/item/homepage')->with('error', 'There is no Items');
        }
        return view('/homepage',compact('items'));
    }
}
