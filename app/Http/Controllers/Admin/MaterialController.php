<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Material;
use App\Http\Controllers\Controller;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    use ImageHandler;
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index($product)
    {
        $material = new Material();
        $material->product = $product;
        return view('admin.materiallist', compact('material'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create($product)
    {
        $material = new Material();
        $material->product = $product;
        return view('admin.creatematerial', compact('material'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $material = new Material();
        $request->validate([
            'materialname' => 'required',
            'product' => 'required',
            'browsertitle' => 'required',
            'metakeyword' => 'required',
            'metadescription' => 'required',
        ]);
        $material->author = $request->user()->id;
        $material->materialname = $request->materialname;
        $material->product = $request->product;
        $material->browsertitle = $request->browsertitle;
        $material->metakeyword = $request->metakeyword;
        $material->metadescription = $request->metadescription;
        $material->banner = $request->banner;
        $material->save();

        if ((int) $material->id > 0) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Material successfully created.',
                ]
                );
            } else {
                return redirect()->route('admin.materiallist');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit($product, Material $material)
    {
        // if($material->banner != ''){
        //     $banner = $this->load_image('materialbanner/'.$material->banner);
        //     if($banner){
        //         $material->banner_link = $banner->get_image_link();
        //         $material->banner_size = $banner->get_image_size();
        //     }

        // }
        return view('admin.creatematerial',compact('material'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        $request->validate([
            'materialname' => 'required',
            'product' => 'required',
            'browsertitle' => 'required',
            'metakeyword' => 'required',
            'metadescription' => 'required',
        ]);
        $material->author = $request->user()->id;
        $material->materialname = $request->materialname;
        $material->product = $request->product;
        $material->browsertitle = $request->browsertitle;
        $material->metakeyword = $request->metakeyword;
        $material->metadescription = $request->metadescription;

        //Banner update
        if($request->banner != ''){
            if($material->banner != ''){
                $banner = $this->load_image('materialbanner/'.$material->banner);
                if($banner ) $banner->remove_image();
            }
            $material->banner = $request->banner;
        }

        $material->save();

        if ((int) $material->id > 0) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Material successfully updated.',
                ]
                );
            } else {
                return redirect()->route('admin.materiallist');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        if($material->banner != ''){
            $banner = $this->load_image('materialbanner/'.$material->banner);
            if($banner){
                $banner->remove_image();
            }
        }
        $material->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Material successfully deleted.',
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function removebanner(Material $material)
    {
        if($material->banner != ''){
            $banner = $this->load_image('materialbanner/'.$material->banner);
            if($banner){
                $banner->remove_image();
            }
        }
        $material->banner = '';
        $material->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Material banner successfully deleted.',
        ]);
    }

    /**
     * Publish the specified resource from storage.
     *
     * @param  \App\Admin\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function publish(Material $material)
    {
        $status = ((int)$material->status > 0) ? 0 : 1;
        $action = ((int)$material->status > 0) ? 'Un Published' : 'Published';
        $material->status = $status;
        $material->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Material successfully '.$action.'.',
        ]);
    }


    /**
     * List the specified resource as json.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function materialList(Request $request)
    {

        $columns = array(
            0 => 'id',
            1 => 'materialname',
            2 => 'description',
            3 => 'status'
        );
        $totalData = Material::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $product = $request->product;

        if (empty($request->input('search.value'))) {
            $materials = Material::where('product', $product)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $materials = Material::where('product', $product)
                ->where(function($query) use ($search) {
                    $query->where('id', 'LIKE', "%{$search}%")
                          ->orWhere('materialname', 'LIKE', "%{$search}%");
                })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Material::where('product', $product)
                ->where(function($query) use ($search) {
                    $query->where('id', 'LIKE', "%{$search}%")
                        ->orWhere('materialname', 'LIKE', "%{$search}%");
                })->count();
        }
        $data = array();
        if (!empty($materials)) {
            foreach ($materials as $key => $material) {

                $checkIcon = ((int)$material->status > 0) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>';
                $checkText = ((int)$material->status > 0) ? 'Un-Publish Material' : 'Publish Material';

                $nestedData = [];
                $nestedData[] = $material->id;
                $nestedData[] = $material->materialname;
                $nestedData[] = '<a href="javascript:void(0);" title="'.$checkText.'" id="publish-'.$material->materialslug.'">'.$checkIcon.'</a>';
                $nestedData[] = '<a href="'.route('admin.editmaterial', ['material' => $material->materialslug, 'materialproduct' => $material->product]).'" title="Edit Material"><i class="fa fa-edit"></i></a>';
                $nestedData[] = '<a href="javascript:void(0);" title="Delete Material" id="delete-'.$material->materialslug.'"><i class="fa fa-trash"></i></a>';
                $nestedData['DT_RowId'] = $material->id;
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
