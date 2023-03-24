<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use App\Models\CartDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $data ['title'] = 'AS | Online Shop';
        $data['products'] = Product::with('category')->get();

        return view('home', $data);
    }

    // detail cart
    public function dcart($id){
        $data ['title'] = 'Detail Cart';
        $data['products'] = Product::find($id);

        return view('detail', $data);
       
    }

    public function pesan(Request $request, $id)
    {	
        // dd($request);
    	$product = Product::where('id', $id)->first();
    	$tanggal = Carbon::now();

    	//validasi apakah melebihi stok
    	if($request->jumlah_pesan > $product->stok)
    	{
    		return redirect('pesan/'.$id);
    	}

    	//cek validasi
    	$cek_cart = Cart::where('user_id', Auth::user()->id)->where('status',0)->first();

    	//simpan ke database cart
    	if(empty($cek_cart))
    	{
    		$cart = new Cart;
	    	$cart->user_id = Auth::user()->id;
	    	$cart->tanggal = $tanggal;
	    	$cart->status = 0;
	    	$cart->jumlah_harga = 0;
            $cart->kode = mt_rand(100, 999);
	    	$cart->save();
    	}
    	

    	//simpan ke database cart detail
    	$cart_baru = Cart::where('user_id', Auth::user()->id)->where('status',0)->first();

    	//cek cart detail
    	$cek_cart_detail = CartDetail::where('product_id', $product->id)->where('cart_id', $cart_baru->id)->first();
    	if(empty($cek_cart_detail))
    	{
    		$cart_detail = new CartDetail;
	    	$cart_detail->product_id = $product->id;
	    	$cart_detail->cart_id = $cart_baru->id;
	    	$cart_detail->jumlah = $request->jumlah_pesan;
	    	$cart_detail->jumlah_harga = $product->price*$request->jumlah_pesan;
	    	$cart_detail->save();
    	}else 
    	{
    		$cart_detail = CartDetail::where('product_id', $product->id)->where('cart_id', $cart_baru->id)->first();

    		$cart_detail->jumlah = $cart_detail->jumlah+$request->jumlah_pesan;

    		//harga sekarang
    		$harga_cart_detail_baru = $product->price*$request->jumlah_pesan;
	    	$cart_detail->jumlah_harga = $cart_detail->jumlah_harga+$harga_cart_detail_baru;
	    	$cart_detail->update();
    	}

    	//jumlah total
    	$cart = Cart::where('user_id', Auth::user()->id)->where('status',0)->first();
    	$cart->jumlah_harga = $cart->jumlah_harga+$product->price*$request->jumlah_pesan;
    	$cart->update();
    	
    	return redirect('/');
    }

    public function check_out()
    {
        $title = 'Cart';
        $cart = Cart::where('user_id', Auth::user()->id)->where('status',0)->first();
 	    $cart_details = [];
        if(!empty($cart))
        {
            $cart_details = CartDetail::where('cart_id', $cart->id)->get();

        }
        
        return view('cart.check_out', compact('cart', 'cart_details', 'title'));
    }

    public function delete($id)
    {
        CartDetail::destroy($id);

        return redirect('/');
    }

}
