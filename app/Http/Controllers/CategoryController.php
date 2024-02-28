<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DataTables;
use Validator;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function index(Request $request)
    {


        if ($request->ajax()) {

            $data = Category::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm edit">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm delete">Delete</a>';

                    return $btn;
                })
                ->addColumn('checkbox', '<input type="checkbox" class="checkbox" data-id="{{$id}}">')
                // ->addColumn('checkbox', '<input type="checkbox" class="checkbox" data-id="{{$id}}">')
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }

        return view('user/index');
    }

    // stotre data into database
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
            'is_active' => 'required',
        ]);

        if ($validator->passes()) {

            Category::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'name' => $request->name,
                    'is_active' => $request->is_active
                ]
            );

            return response()->json(['success' => 'Data saved successfully.']);
        } else {
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    // Edit data
    public function edit($id)
    {
        $product = Category::find($id);
        return response()->json($product);
    }

    // Delete data
    public function destroy($id)
    {
        $delete = Category::find($id)->delete();

        // check data deleted or not
        if ($delete) {
            $success = true;
            $message = "Data deleted successfully";
        } else {
            $success = true;
            $message = "Data not found";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    // Delete multiple data
    public function deleteMultiple(Request $request)
    {
        $ids = $request->ids;
        $data = Category::whereIn('id', explode(",", $ids))->delete();
        // check data deleted or not
        if ($data) {
            $success = true;
            $message = "Data deleted successfully";
        } else {
            $success = true;
            $message = "Data not found";
        }
        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    // End
}
