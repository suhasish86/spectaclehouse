<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Brand;
use App\Http\Controllers\Controller;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;
use stdClass;

class BrandController extends Controller
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
        $brand = new Brand();
        $brand->product = $product;
        return view('admin.brandlist', compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create($product)
    {
        $brand = new Brand();
        $brand->product = $product;
        return view('admin.createbrand', compact('brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brand = new Brand();
        $request->validate([
            'brandname' => 'required',
            'product' => 'required',
            'browsertitle' => 'required',
            'metakeyword' => 'required',
            'metadescription' => 'required',
        ]);
        $brand->author = $request->user()->id;
        $brand->brandname = $request->brandname;
        $brand->product = $request->product;
        $brand->browsertitle = $request->browsertitle;
        $brand->metakeyword = $request->metakeyword;
        $brand->metadescription = $request->metadescription;
        $brand->banner = $request->banner;
        $brand->save();

        if ((int) $brand->id > 0) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Brand successfully created.',
                ]
                );
            } else {
                return redirect()->route('admin.brandlist');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($product, Brand $brand)
    {
        // if($brand->banner != ''){
        //     $banner = $this->load_image('brandbanner/'.$brand->banner);
        //     if($banner){
        //         $brand->banner_link = $banner->get_image_link();
        //         $brand->banner_size = $banner->get_image_size();
        //     }

        // }
        return view('admin.createbrand',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'brandname' => 'required',
            'product' => 'required',
            'browsertitle' => 'required',
            'metakeyword' => 'required',
            'metadescription' => 'required',
        ]);
        $brand->author = $request->user()->id;
        $brand->brandname = $request->brandname;
        $brand->product = $request->product;
        $brand->browsertitle = $request->browsertitle;
        $brand->metakeyword = $request->metakeyword;
        $brand->metadescription = $request->metadescription;

        //Banner update
        if($request->banner != ''){
            if($brand->banner != ''){
                $banner = $this->load_image('brandbanner/'.$brand->banner);
                if($banner ) $banner->remove_image();
            }
            $brand->banner = $request->banner;
        }

        $brand->save();

        if ((int) $brand->id > 0) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Brand successfully updated.',
                ]
                );
            } else {
                return redirect()->route('admin.brandlist');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if($brand->banner != ''){
            $banner = $this->load_image('brandbanner/'.$brand->banner);
            if($banner){
                $banner->remove_image();
            }
        }
        $brand->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Brand successfully deleted.',
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function removebanner(Brand $brand)
    {
        if($brand->banner != ''){
            $banner = $this->load_image('brandbanner/'.$brand->banner);
            if($banner){
                $banner->remove_image();
            }
        }
        $brand->banner = '';
        $brand->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Brand banner successfully deleted.',
        ]);
    }

    /**
     * Publish the specified resource from storage.
     *
     * @param  \App\Admin\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function publish(Brand $brand)
    {
        $status = ((int)$brand->status > 0) ? 0 : 1;
        $action = ((int)$brand->status > 0) ? 'Un Published' : 'Published';
        $brand->status = $status;
        $brand->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Brand successfully '.$action.'.',
        ]);
    }


    /**
     * List the specified resource as json.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function brandList(Request $request)
    {

        $columns = array(
            0 => 'id',
            1 => 'brandname',
            2 => 'description',
            3 => 'status'
        );
        $totalData = Brand::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $product = $request->product;

        if (empty($request->input('search.value'))) {
            $brands = Brand::where('product', $product)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $brands = Brand::where('product', $product)
                ->where(function($query) use ($search) {
                    $query->where('id', 'LIKE', "%{$search}%")
                          ->orWhere('brandname', 'LIKE', "%{$search}%");
                })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Brand::where('product', $product)
                ->where(function($query) use ($search) {
                    $query->where('id', 'LIKE', "%{$search}%")
                        ->orWhere('brandname', 'LIKE', "%{$search}%");
                })->count();
        }
        $data = array();
        if (!empty($brands)) {
            foreach ($brands as $key => $brand) {

                $checkIcon = ((int)$brand->status > 0) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>';
                $checkText = ((int)$brand->status > 0) ? 'Un-Publish Brand' : 'Publish Brand';

                $nestedData = [];
                $nestedData[] = $brand->id;
                $nestedData[] = $brand->brandname;
                $nestedData[] = '<a href="javascript:void(0);" title="'.$checkText.'" id="publish-'.$brand->brandslug.'">'.$checkIcon.'</a>';
                $nestedData[] = '<a href="'.route('admin.editbrand', ['brand' => $brand->brandslug, 'brandproduct' => $brand->product]).'" title="Edit Brand"><i class="fa fa-edit"></i></a>';
                $nestedData[] = '<a href="javascript:void(0);" title="Delete Brand" id="delete-'.$brand->brandslug.'"><i class="fa fa-trash"></i></a>';
                $nestedData['DT_RowId'] = $brand->id;
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
