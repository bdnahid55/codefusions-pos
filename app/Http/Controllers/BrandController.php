<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        // show all item
        //$tests = Testdata::all(); // when using eloquent
        //$tests = DB::table('testdatas')->get();

        if ($request->ajax()) {

            $data = Testdata::latest()->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                            return $btn;
                    })
                    ->addColumn('checkbox', '<input type="checkbox" class="checkbox" data-id="{{$id}}">')
                    ->rawColumns(['action','checkbox'])
                    ->make(true);
        }

        return view('test/index');
    }


    // show create page
    public function create()
    {

        return view('test/create');
    }

    // store data
    public function store(Request $request)
    {
        // store data with Validation
        $this->validate($request, [
            //'name' => 'required|unique:testdatas',
            'name' => 'required|max:100',
            'email' => 'required|max:200'
            ]);

            $data = array();
            $data['name']=$request->name;
            $data['email']=$request->email;

            $result = DB::table('testdatas')->insert($data);

            if($result){
                Toastr::success('Data has been add successfully :)','Success');
                //Session::put('success','Data added successfully.');
                //return redirect()->back();
                return Redirect::to('test/add');
            }else{
                Toastr::error('fail, Add new record:)','Error');
                //Session::put('failed','Data insert failed.');
                return redirect()->back();
                //return Redirect::to('test/add');
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        // return view('posts.edit', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
