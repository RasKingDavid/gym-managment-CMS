<?php

namespace App\Http\Controllers;

use App\Product;

use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->orderBy('product_name','asc')->get();
        // return $products;
        return view('product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('category_name','asc')->get();
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $product = Product::create($request->all());
        if($request->hasFile('image')){
            $img = Image::make($request->image);
            $img->resize(100,150)->encode('png');
            $path = public_path('files/product_images/').str_slug($product->sku).'.png';
            $img->save($path);
            $product->update([
                'image' => str_slug($product->sku).'.png'
            ]);
        }
        flash()->success('Product added successfully');
        return redirect()->back();
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
        $product = Product::find($id);
        $categories = Category::orderBy('category_name','asc')->get();
        return view('product.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        Product::where('id',$id)->update([
            'category_id' => $request->category_id,
            'sku' => $request->sku,
            'stock' => $request->stock,
            'min_stock' => $request->min_stock,
            'product_name' => $request->product_name,
            'description' => $request->description,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,
            'discount_price' => $request->discount_price
        ]);
        if($request->hasFile('image')){
            // delete current image
            $old_file = public_path('files/product_images/').str_slug($request->sku).'.png';
                if(File::exists($old_file)){
                    File::delete($old_file);
                }
            // ends
            $img = Image::make($request->image);
            $img->resize(100,150)->encode('png');
            $path = public_path('files/product_images/').str_slug($request->sku).'.png';
            $img->save($path);
            Product::where('id',$id)->update([
                'image' => str_slug($request->sku).'.png'
            ]);
        }
        flash()->success('Product updated successfully');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('id',$id)->delete();
        flash()->success('Product deleted successfully');
        return redirect()->back();
    }

    public function product_by_category($id){
        $products = Product::where('category_id',$id)->orderBy('product_name','asc')->get();
        return view('product.byCategory', compact('products'));
    }
}
