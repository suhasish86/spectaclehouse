<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Category;
use App\Admin\Brand;
use App\Admin\Style;
use App\Admin\Material;
use App\Admin\Product;
use App\Http\Controllers\Controller;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ImageHandler;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($genre)
    {
        $product = new Product();
        $product->genre = $genre;
        return view('admin.productlist', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($genre)
    {
        $product = new Product();
        $product->genre = $genre;

        $categories = Category::where('status', 1)->get();
        $brands = Brand::where(['status'=>1, 'product'=>$genre])->get();
        $styles = Style::where(['status'=>1, 'product'=>$genre])->get();
        $materials = Material::where(['status'=>1, 'product'=>$genre])->get();

        return view('admin.createproduct', compact('product', 'categories', 'brands', 'styles', 'materials'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $specs = [];
        if(!empty($request->specname)){
            foreach($request->specname as $k=>$spec){
                $row = [];
                $row['specname'] = $spec;
                $row['specification'] = $request->specification[$k];
                $specs[] = $row;
            }
        }

        $product = new Product();
        $request->validate([
            'productname' => 'required',
            'productsku' => 'required',
            'genre' => 'required',
            'productstyle' => 'required',
            'productbrand' => 'required',
            'productmaterial' => 'required',
            'productcategory' => 'required',
            'description' => 'required',
            'productprice' => 'required',
            'browsertitle' => 'required',
            'metakeyword' => 'required',
            'metadescription' => 'required',
        ]);
        $product->author = $request->user()->id;
        $product->productname = $request->productname;
        $product->productsku = $request->productsku;
        $product->genre = $request->genre;
        $product->style = $request->productstyle;
        $product->brand = $request->productbrand;
        $product->material = $request->productmaterial;
        $product->category = $request->productcategory;
        $product->description = $request->description;
        $product->specification = json_encode($specs);
        $product->price = $request->productprice;
        $product->discount = $request->productdiscount;
        $product->discountby = $request->productdiscountby;
        $product->image = $request->productimage;
        $product->browsertitle = $request->browsertitle;
        $product->metakeyword = $request->metakeyword;
        $product->metadescription = $request->metadescription;

        $product->save();

        if ((int) $product->id > 0) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Product successfully created.',
                ]
                );
            } else {
                return redirect()->route('admin.productlist');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($genre, Product $product)
    {
        if($product->image != ''){
            $image = $this->load_image('productimage/'.$product->genre.'/'.$product->image);
            if($image){
                $product->image_link = $image->get_image_link();
                $product->image_size = $image->get_image_size();
            }
        }

        $product->specification = json_decode($product->specification);

        $categories = Category::where('status', 1)->get();
        $brands = Brand::where(['status'=>1, 'product'=>$product->genre])->get();
        $styles = Style::where(['status'=>1, 'product'=>$product->genre])->get();
        $materials = Material::where(['status'=>1, 'product'=>$genre])->get();

        return view('admin.createproduct', compact('product', 'categories', 'brands', 'styles', 'materials'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $specs = [];
        if(!empty($request->specname)){
            foreach($request->specname as $k=>$spec){
                $row = [];
                $row['specname'] = $spec;
                $row['specification'] = $request->specification[$k];
                $specs[] = $row;
            }
        }

        $request->validate([
            'productname' => 'required',
            'productsku' => 'required',
            'genre' => 'required',
            'productstyle' => 'required',
            'productbrand' => 'required',
            'productmaterial' => 'required',
            'productcategory' => 'required',
            'description' => 'required',
            'productprice' => 'required',
            'browsertitle' => 'required',
            'metakeyword' => 'required',
            'metadescription' => 'required',
        ]);
        $product->author = $request->user()->id;
        $product->productname = $request->productname;
        $product->productsku = $request->productsku;
        $product->genre = $request->genre;
        $product->style = $request->productstyle;
        $product->brand = $request->productbrand;
        $product->material = $request->productmaterial;
        $product->category = $request->productcategory;
        $product->description = $request->description;
        $product->specification = json_encode($specs);
        $product->price = $request->productprice;
        $product->discount = $request->productdiscount;
        $product->discountby = $request->productdiscountby;
        $product->browsertitle = $request->browsertitle;
        $product->metakeyword = $request->metakeyword;
        $product->metadescription = $request->metadescription;

        //Image update
        if($request->productimage != ''){
            if($product->image != ''){
                $image = $this->load_image('productimage/'.$product->genre.'/'.$product->image);
                if($image ) $image->remove_image();
            }
            $product->image = $request->productimage;
        }

        $product->save();

        if ((int) $product->id > 0) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Product successfully updated.',
                ]
                );
            } else {
                return redirect()->route('admin.productlist');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->image != ''){
            $image = $this->load_image('productimage/'.$product->genre.'/'.$product->image);
            if($image){
                $image->remove_image();
            }
        }
        $product->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Product successfully deleted.',
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function removeimage(Product $product)
    {
        if($product->image != ''){
            $image = $this->load_image('productimage/'.$product->genre.'/'.$product->image);
            if($image){
                $image->remove_image();
            }
        }
        $product->image = '';
        $product->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Product banner successfully deleted.',
        ]);
    }

    /**
     * Publish the specified resource from storage.
     *
     * @param  \App\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function publish(Product $product)
    {
        $status = ((int)$product->status > 0) ? 0 : 1;
        $action = ((int)$product->status > 0) ? 'Un Published' : 'Published';
        $product->status = $status;
        $product->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Product successfully '.$action.'.',
        ]);
    }


    /**
     * List the specified resource as json.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function productList(Request $request)
    {

        $columns = array(
            0 => 'id',
            1 => 'productname',
            2 => 'brand',
            3 => 'style',
            4 => 'price',
            3 => 'status'
        );
        $totalData = Product::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $genre = $request->genre;

        if (empty($request->input('search.value'))) {
            $products = Product::where('genre', $genre)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $products = Product::where('genre', $genre)
                ->where(function($query) use ($search) {
                    $query->where('id', 'LIKE', "%{$search}%")
                        ->orWhere('productname', 'LIKE', "%{$search}%");
                })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Product::where('genre', $genre)
                ->where(function($query) use ($search) {
                    $query->where('id', 'LIKE', "%{$search}%")
                        ->orWhere('productname', 'LIKE', "%{$search}%");
                })
                ->count();
        }
        $data = array();
        if (!empty($products)) {
            foreach ($products as $key => $product) {

                $checkIcon = ((int)$product->status > 0) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>';
                $checkText = ((int)$product->status > 0) ? 'Un-Publish Product' : 'Publish Product';

                $product->brand = \App\Admin\Brand::find($product->brand)->brandname;
                $product->style = \App\Admin\Style::find($product->style)->stylename;
                $product->material = \App\Admin\Material::find($product->material)->materialname;

                $nestedData = [];
                $nestedData[] = $product->id;
                $nestedData[] = $product->productname;
                $nestedData[] = $product->brand;
                $nestedData[] = $product->style;
                $nestedData[] = $product->material;
                $nestedData[] = $product->price;
                $nestedData[] = '<a href="javascript:void(0);" title="'.$checkText.'" id="publish-'.$product->productslug.'">'.$checkIcon.'</a>';
                $nestedData[] = '<a href="'.route('admin.editproduct', ['genre' => 'frame','product' => $product->productslug]).'" title="Edit Product"><i class="fa fa-edit"></i></a>';
                $nestedData[] = '<a href="javascript:void(0);" title="Delete Product" id="delete-'.$product->productslug.'"><i class="fa fa-trash"></i></a>';
                $nestedData['DT_RowId'] = $product->id;
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
