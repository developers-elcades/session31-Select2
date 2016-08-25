<?php

namespace Market\Http\Controllers\Product;

use Illuminate\Http\Request;

use Market\Http\Requests;
use Market\Http\Controllers\Controller;
use Market\Models\Product\Product;
use Market\Models\Product\Mark;
use Market\http\Requests\Product\ProductCreateRequest;
use Market\http\Requests\Product\ProductUpdateRequest;
use Image;
use Session;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return View('product/index');
    }

    public function listall()
    {
        $products = Product::
        select('products.id','products.name as product','price','marks.name as mark','image')
            ->join('marks','marks.id','=','products.marks_id')
            ->paginate(8);
        return View('product/listall')->with('products',$products);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response-
     */
    public function create()
    {
        //

        $marks = Mark::lists('name','id')->prepend('Seleccioname la Marca');
        return view('product.create')->with('marks',$marks);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        Product::create($request->all());
        Session::flash('save','Se ha creado correctamente');
        return redirect()->route('product.index');
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
        $products = Product::FindOrFail($id);
        return view('product.show')->with('products',$products);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $marks = Mark::lists('name','id')->prepend('Seleccioname la Marca');
        $products = Product::FindOrFail($id);

        return view('product.edit', array('products'=>$products,'marks'=>$marks));

    }


    public function photo($id)
    {
        $product = Product::find($id);
        return view('product.photo')->with('product',$product);
    }

    public function update_photo(Request $request)
    {
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(380, 600)->save(public_path('images/products/' . $filename ) );
            $products= Product::find($request->get('id'));
            $products->image = $filename;
            $products->save();
            return view('product.photo')->with('product',$products);
    }




    public function update(ProductUpdateRequest $request, $id)
    {
        $products = Product::FindOrFail($id);
        $input = $request->all();
        $products->fill($input)->save();
        Session::flash('update','Se ha actualizado creado correctamente');
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
        //
        $products = Product::FindOrFail($id);
        $products->delete();
        Session::flash('delete','Se ha eliminado correctamente');
        return redirect()->route('product.index');
                
    }
}
