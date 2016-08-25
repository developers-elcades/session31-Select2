<?php

namespace Market\Http\Controllers\Product;

use Illuminate\Http\Request;
use Market\Models\Product\Mark;
use Market\Http\Requests;
use Market\Http\Controllers\Controller;
use Market\Http\Requests\Mark\MarkCreateRequest;
use Market\Http\Requests\Mark\MarkUpdateRequest;
use Session;



class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function  __construct()
    {

    }


    public function index()
    {

       return view('mark.index');

    }


    public function listall()
    {
        $mark = Mark::
         select('id','name')
                 ->paginate(5);
        return View('mark/listall')->with('marks',$mark);

    }

    public function create()
    {
        //

        return view('mark.create');

    }


    public function store( MarkCreateRequest $request)
    {
        
        if ($request->ajax())
        {
                $result = Mark::create($request->all());

                if ($result){
                    Session::flash('save','Se ha creado correctamente');
                    return response()->json(['success'=>'true']);
                } 
                else
                {
                  return response()->json(['success'=>'false']);  
                }


        }


    }


    public function show($id)
    {

    }


    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {


    }


    public function destroy($id)
    {


    }
}
