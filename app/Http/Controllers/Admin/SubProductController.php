<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubProduct;
use App\Models\Insurance;
use App\Models\Product;
use DataTables;
use App\Http\Requests\Admin\SubProduct\StoreSubProductRequest;

class SubProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
       
        if ($request->ajax())
        {
            $data = SubProduct::with('products','insurances')->orderby('id','DESC')->get();

            return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function ($row)
                            {
                                $action = '<span class="action-buttons">
                                
                        <a  href="' . route("subproduct.edit", $row) . '" class="btn btn-sm btn-info btn-b"><i class="las la-pen"></i>
                        </a>

                        <a href="' . route("subproduct.destroy", $row) . '"
                                class="btn btn-sm btn-danger remove_us"
                                title="Delete User"
                                data-toggle="tooltip"
                                data-placement="top"
                                data-method="DELETE"
                                data-confirm-title="Please Confirm"
                                data-confirm-text="Are you sure that you want to delete this User?"
                                data-confirm-delete="Yes, delete it!">
                                <i class="las la-trash"></i>
                            </a>
                    ';
                                return $action;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }
        return view('admin.subproduct.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $insurances= Insurance::all();
        $products= Product::all();
        return view('admin.subproduct.addEdit',compact('insurances','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubProductRequest $request)
    {

        $inputs = $request->all();
        SubProduct::create($inputs);
        
        return back()->with('success', 'SubProduct addded successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view('admin.subproduct.index',compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SubProduct $subproduct)
    {
        
        $insurances= Insurance::all();
        $products= Product::all();
        return view('admin.subproduct.addEdit', compact('subproduct','insurances','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSubProductRequest $request, SubProduct $subproduct)
    {

        $inputs = $request->all();
        $subproduct->update($inputs);
        
        return back()->with('success', 'SubProduct updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubProduct $subproduct)
    {
        $subproduct->delete();
        return back()->with('success', 'SubProduct deleted successfully!');
    }

}
