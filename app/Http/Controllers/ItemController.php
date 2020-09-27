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



        // auth()->user()->items()->
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
        // $items = Item::all();
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

     public function addToCart($itemId){
        // dd(auth()->user());
         $currCart = Order::where('user_id',auth()->user()->id)
         ->where('status','ACTIVE')->first();
         $item=Item::find($itemId);
         if($currCart==NULL){
             $curr= Order::create([
                'user_id' => auth()->user()->id,
                'status' => 'ACTIVE'
             ]);
         }
         $newOrderItem = OrderItem::create([
            'order_id' => $currCart->id,
            'item_id' => $item->id,
            'price' => $item->harga_barang
         ]);

         return redirect('/item/show')->with('success','Item Add to Cart');

     }

     public function showCart(Request $request){
        $currCart = Order::where('user_id',auth()->user()->id)
        ->where('status','ACTIVE')->first();
        if($currCart==NULL){
            return redirect('/item/cart')->with('error','Failed Checkout Cart');
        }
        $cartItems = $currCart->orderItems;

        return view('/cart',compact('cartItems'));
    }

     function checkout(){
        $currCart = Order::where('user_id',auth()->user()->id)
        ->where('status','ACTIVE')->first();
        if($currCart==NULL){
            return redirect('/item/show')->with('error','Failed Checkout Cart');
        }
        $currCart->status = 'WAITING_PAYMENT';
        $currCart->save();
        return redirect('/item/show')->with('success','Item Add to Cart');
    }




}
