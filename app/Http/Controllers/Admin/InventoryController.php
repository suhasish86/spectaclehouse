<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Product;
use App\Admin\Inventory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($productslug, Request $request)
    {
        $product = Product::where('productslug', $productslug)->firstOrFail();
        return view('admin.inventorylist', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($productid)
    {
        $inventory = new Inventory();
        $product = Product::find($productid);
        return view('admin.createinventory',compact('inventory', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function build(Request $request)
    {

        $sizes = $request->size;
        $colors = $request->colorcode;

        if(!empty($colors)){
            foreach($colors as $color){

                if(!empty($sizes)){
                    foreach($sizes as $size){
                        $inventory = new Inventory();
                        $inventory->productid = $request->productid;
                        $inventory->color = $color;
                        $inventory->size = $size;
                        $inventory->author = $request->user()->id;

                        $inventory->save();
                    }
                }

            }
        }
        if ((int) $inventory->id > 0) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Inventory successfully created.',
                ]
                );
            } else {
                return redirect()->back()->with('msg', 'Inventory successfully created.');
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inventory = new Inventory();
        $request->validate([
            'productid' => 'required',
            'colorcode' => 'required',
            'size' => 'required',
            'stock' => 'required',
        ]);
        $inventory->author = $request->user()->id;
        $inventory->productid = $request->productid;
        $inventory->color = $request->colorcode;
        $inventory->size = $request->size;
        $inventory->stock = $request->stock;
        $inventory->status = 1;
        $inventory->save();

        if ((int) $inventory->id > 0) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Inventory successfully created.',
                ]
                );
            } else {
                return redirect()->route('admin.categorylist');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        $product = Product::find($inventory->productid);
        return view('admin.createinventory',compact('inventory', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'productid' => 'required',
            'colorcode' => 'required',
            'size' => 'required',
            'stock' => 'required',
        ]);
        $inventory->author = $request->user()->id;
        $inventory->productid = $request->productid;
        $inventory->color = $request->colorcode;
        $inventory->size = $request->size;
        $inventory->stock = $request->stock;
        $inventory->save();

        if ((int) $inventory->id > 0) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Inventory successfully updated.',
                ]
                );
            } else {
                return redirect()->route('admin.inventorylist');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Inventory successfully deleted.',
        ]);
    }

    /**
     * Publish the specified resource from storage.
     *
     * @param  \App\Admin\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function publish(Inventory $inventory)
    {
        $status = ((int)$inventory->status > 0) ? 0 : 1;
        $action = ((int)$inventory->status > 0) ? 'Un Published' : 'Published';
        $inventory->status = $status;
        $inventory->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Inventory successfully '.$action.'.',
        ]);
    }

    /**
     * List the specified resource as json.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function inventoryList(Request $request)
    {

        $columns = array(
            0 => 'id',
            1 => 'productname',
            2 => 'color',
            3 => 'size',
            4 => 'stock',
            5 => 'status'
        );
        $totalData = Inventory::where('productid', $request->productid)->count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $inventory = Inventory::where('productid', $request->productid)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $inventory = Inventory::where('productid', $request->productid)
                ->where(function($query) use ($search) {
                    $query->where('colorcode', 'LIKE', "%{$search}%")
                        ->orWhere('size', 'LIKE', "%{$search}%");
                })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Inventory::where('productid', $request->productid)
                ->where(function($query) use ($search) {
                    $query->where('colorcode', 'LIKE', "%{$search}%")
                        ->orWhere('size', 'LIKE', "%{$search}%");
                })
                ->count();
        }
        $data = array();
        if (!empty($inventory)) {

            foreach ($inventory as $key => $entry) {

                $checkIcon = ((int)$entry->status > 0) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>';
                $checkText = ((int)$entry->status > 0) ? 'Un-Publish Product' : 'Publish Product';


                $productname = (\App\Admin\Product::find($request->productid))
                                  ? \App\Admin\Product::find($request->productid)->productname
                                  : 'Product not found';
                $colorDiv = '<span class="dot" style="background-color: '.$entry->color.';"></span>';

                $nestedData = [];
                $nestedData[] = $key+1;
                $nestedData[] = $productname;
                $nestedData[] = $colorDiv;
                $nestedData[] = $entry->size;
                $nestedData[] = $entry->stock;
                // $nestedData[] = '<a href="javascript:void(0);" title="'.$checkText.'" id="publish-'.$entry->id.'">'.$checkIcon.'</a>';
                $nestedData[] = '<a href="javascript:void(0);" title="'.$checkText.'" id="gallery-'.base64_encode($entry->id).'"><i class="fa fa-camera"></i></a>';
                $nestedData[] = '<a href="'.route('admin.editinventory', ['inventoryid' => base64_encode($entry->id)]).'" title="Edit Variant"><i class="fa fa-edit"></i></a>';
                $nestedData[] = '<a href="javascript:void(0);" title="Delete Variant" id="delete-'.$entry->id.'"><i class="fa fa-trash"></i></a>';
                $nestedData['DT_RowId'] = $entry->id;
                $data[] = $nestedData;
            }

        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );
        echo json_encode($json_data);
    }
}
