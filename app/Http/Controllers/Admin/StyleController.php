<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Style;
use App\Http\Controllers\Controller;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;
use stdClass;

class StyleController extends Controller
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
        $style = new Style();
        $style->product = $product;
        return view('admin.stylelist', compact('style'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create($product)
    {
        $style = new Style();
        $style->product = $product;
        return view('admin.createstyle', compact('style'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $style = new Style();
        $request->validate([
            'stylename' => 'required',
            'product' => 'required',
            'browsertitle' => 'required',
            'metakeyword' => 'required',
            'metadescription' => 'required',
        ]);
        $style->author = $request->user()->id;
        $style->stylename = $request->stylename;
        $style->product = $request->product;
        $style->browsertitle = $request->browsertitle;
        $style->metakeyword = $request->metakeyword;
        $style->metadescription = $request->metadescription;
        $style->banner = $request->banner;
        $style->save();

        if ((int) $style->id > 0) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Style successfully created.',
                ]
                );
            } else {
                return redirect()->route('admin.stylelist');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Style  $style
     * @return \Illuminate\Http\Response
     */
    public function show(Style $style)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Style  $style
     * @return \Illuminate\Http\Response
     */
    public function edit($product, Style $style)
    {
        // if($style->banner != ''){
        //     $banner = $this->load_image('stylebanner/'.$style->banner);
        //     if($banner){
        //         $style->banner_link = $banner->get_image_link();
        //         $style->banner_size = $banner->get_image_size();
        //     }

        // }
        return view('admin.createstyle',compact('style'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Style  $style
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Style $style)
    {
        $request->validate([
            'stylename' => 'required',
            'product' => 'required',
            'browsertitle' => 'required',
            'metakeyword' => 'required',
            'metadescription' => 'required',
        ]);
        $style->author = $request->user()->id;
        $style->stylename = $request->stylename;
        $style->product = $request->product;
        $style->browsertitle = $request->browsertitle;
        $style->metakeyword = $request->metakeyword;
        $style->metadescription = $request->metadescription;

        //Banner update
        if($request->banner != ''){
            if($style->banner != ''){
                $banner = $this->load_image('stylebanner/'.$style->banner);
                if($banner ) $banner->remove_image();
            }
            $style->banner = $request->banner;
        }

        $style->save();

        if ((int) $style->id > 0) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Style successfully updated.',
                ]
                );
            } else {
                return redirect()->route('admin.stylelist');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Style  $style
     * @return \Illuminate\Http\Response
     */
    public function destroy(Style $style)
    {
        if($style->banner != ''){
            $banner = $this->load_image('stylebanner/'.$style->banner);
            if($banner){
                $banner->remove_image();
            }
        }
        $style->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Style successfully deleted.',
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Style  $style
     * @return \Illuminate\Http\Response
     */
    public function removebanner(Style $style)
    {
        if($style->banner != ''){
            $banner = $this->load_image('stylebanner/'.$style->banner);
            if($banner){
                $banner->remove_image();
            }
        }
        $style->banner = '';
        $style->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Style banner successfully deleted.',
        ]);
    }

    /**
     * Publish the specified resource from storage.
     *
     * @param  \App\Admin\Style  $style
     * @return \Illuminate\Http\Response
     */
    public function publish(Style $style)
    {
        $status = ((int)$style->status > 0) ? 0 : 1;
        $action = ((int)$style->status > 0) ? 'Un Published' : 'Published';
        $style->status = $status;
        $style->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Style successfully '.$action.'.',
        ]);
    }


    /**
     * List the specified resource as json.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function styleList(Request $request)
    {

        $columns = array(
            0 => 'id',
            1 => 'stylename',
            2 => 'description',
            3 => 'status'
        );
        $totalData = Style::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $product = $request->product;

        if (empty($request->input('search.value'))) {
            $styles = Style::where('product', $product)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $styles = Style::where('product', $product)
                ->where(function($query) use ($search) {
                    $query->where('id', 'LIKE', "%{$search}%")
                          ->orWhere('stylename', 'LIKE', "%{$search}%");
                })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Style::where('product', $product)
                ->where(function($query) use ($search) {
                    $query->where('id', 'LIKE', "%{$search}%")
                        ->orWhere('stylename', 'LIKE', "%{$search}%");
                })->count();
        }
        $data = array();
        if (!empty($styles)) {
            foreach ($styles as $key => $style) {

                $checkIcon = ((int)$style->status > 0) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>';
                $checkText = ((int)$style->status > 0) ? 'Un-Publish Style' : 'Publish Style';

                $nestedData = [];
                $nestedData[] = $style->id;
                $nestedData[] = $style->stylename;
                $nestedData[] = '<a href="javascript:void(0);" title="'.$checkText.'" id="publish-'.$style->styleslug.'">'.$checkIcon.'</a>';
                $nestedData[] = '<a href="'.route('admin.editstyle', ['style' => $style->styleslug, 'styleproduct' => $style->product]).'" title="Edit Style"><i class="fa fa-edit"></i></a>';
                $nestedData[] = '<a href="javascript:void(0);" title="Delete Style" id="delete-'.$style->styleslug.'"><i class="fa fa-trash"></i></a>';
                $nestedData['DT_RowId'] = $style->id;
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
