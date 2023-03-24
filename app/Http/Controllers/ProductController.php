<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data ['title'] = 'Product';
        $data['products'] = Product::with('category')->get();

        return view('product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data ['title'] = 'Tambah Data Produk';
        $data['categories'] = Category::all();

        return view('product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'stok' => 'required',
            'price' => 'required|numeric',
            // 'image'=> 'required|image|file|max:1024',
            'category_id' => 'required'
        ]);


        // if($request->file('image')){
        //     $validate['image']= $request->file('image')->store('image', 'public');
        // }

        Product::create($validated);

        return redirect('/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data ['title'] = 'Edit Produk';
        $data['categories'] = Category::all();
        $data['product'] = Product::find($id);

        return view('/product/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'stok' => 'required',
            'price' => 'required|numeric',
            // 'image'=> 'image|file|max:1024',
            'category_id' => 'required'
        ]);

        // if($request->file('image')){
        //     $validate['image']= $request->file('image')->store('image', 'public');
        // }

        Product::where('id', $product->id)->update($validated);

        return redirect('/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // Storage::delete($product->image);
        Product::destroy($id);

        return redirect('/product');
        
    }
}
