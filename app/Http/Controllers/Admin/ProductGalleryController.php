<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Product;
use App\Admin\Inventory;
use App\Admin\ProductGallery;
use Illuminate\Http\Request;
use App\Traits\ImageHandler;
use App\Http\Controllers\Controller;

class ProductGalleryController extends Controller
{
    use ImageHandler;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Inventory $inventory)
    {
        $product = Product::find($inventory->productid);
        return view('admin.gallerylist',compact('inventory', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'productid' => 'required',
            'inventoryid' => 'required',
            'images' => 'required'
        ]);

        if (strpos($request->images, ', ') !== false){
            $images = explode(', ', $request->images);
        } else {
            $images[] = $request->images;
        }

        foreach($images as $image){
            $gallery = new ProductGallery();
            $gallery->productid = $request->productid;
            $gallery->inventoryid = $request->inventoryid;
            $gallery->image = $image;
            $gallery->status = 1;

            $gallery->save();
        }

        if ((int) $gallery->id > 0) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Gallery successfully updated.',
                ]
                );
            } else {
                return redirect()->route('admin.gallerylist', ['inventoryid'=>$request->inventoryid]);
            }
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\ProductGallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductGallery $gallery)
    {
        $product = Product::find($gallery->productid);
        if($gallery->image != ''){
            $image = $this->load_image('gallery/'.$product->genre.'/'.$gallery->image);
            if($image){
                $image->remove_image();
            }
        }
        $gallery->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Gallery image successfully deleted.',
        ]);
    }

    /**
     * Publish the specified resource from storage.
     *
     * @param  \App\Admin\ProductGallery  $product
     * @return \Illuminate\Http\Response
     */
    public function publish(ProductGallery $gallery)
    {
        $status = ((int)$gallery->status > 0) ? 0 : 1;
        $action = ((int)$gallery->status > 0) ? 'Un Published' : 'Published';
        $gallery->status = $status;
        $gallery->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Gallery image successfully '.$action.'.',
        ]);
    }

    /**
     * List the specified resource as json.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function productGalleryList(Request $request)
    {

        $columns = array(
            0 => 'id',
            1 => 'image',
            2 => 'productid'
        );
        $totalData = ProductGallery::where('inventoryid', $request->inventoryid)->count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $galleries = ProductGallery::where('inventoryid', $request->inventoryid)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $galleries = ProductGallery::where('inventoryid', $request->inventoryid)
                ->where(function($query) use ($search) {
                    $query->where('id', 'LIKE', "%{$search}%")
                        ->orWhere('productid', 'LIKE', "%{$search}%");
                })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = ProductGallery::where('inventoryid', $request->inventoryid)
                ->where(function($query) use ($search) {
                    $query->where('id', 'LIKE', "%{$search}%")
                        ->orWhere('productid', 'LIKE', "%{$search}%");
                })
                ->count();
        }
        $data = array();
        if (!empty($galleries)) {

            foreach ($galleries as $key => $gallery) {

                $checkIcon = ((int)$gallery->status > 0) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>';
                $checkText = ((int)$gallery->status > 0) ? 'Un-Publish ProductGallery' : 'Publish ProductGallery';

                //Check Inventory
                $product = Product::find($gallery->productid);
                $inventory = Inventory::find($gallery->inventoryid);

                $imagehtml = 'Image not found';

                //Gallery Image
                // if($gallery->image != ''){
                //     $image = $this->load_image('gallery/'.$product->genre.'/'.$gallery->image);
                //     if($image){
                //         $gallery->image_link = $image->get_image_link();
                //         $imagehtml = '<img src="'.$gallery->image_link.'" class="gallery_image" title="'.$product->productname.'">';
                //     }
                // }

                if($gallery->image != ''){
                    $gallery->image_link = '/storage/uploads/gallery/'.$product->genre.'/'.$gallery->image;
                    $imagehtml = '<img src="'.$gallery->image_link.'" class="gallery_image" title="'.$product->productname.'">';
                }

                $nestedData = [];
                $nestedData[] = $key+1;
                $nestedData[] = $imagehtml;
                $nestedData[] = $product->productname;
                $nestedData[] = '<a href="javascript:void(0);" title="'.$checkText.'" id="publish-'.$gallery->id.'">'.$checkIcon.'</a>';
                $nestedData[] = '<a href="javascript:void(0);" title="Delete Product Image" id="delete-'.$gallery->id.'"><i class="fa fa-trash"></i></a>';
                $nestedData['DT_RowId'] = $gallery->id;
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
