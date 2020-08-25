<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Category;
use App\Http\Controllers\Controller;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ImageHandler;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categorylist');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createcategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        $request->validate([
            'categoryname' => 'required',
            'browsertitle' => 'required',
            'metakeyword' => 'required',
            'metadescription' => 'required',
        ]);
        $category->author = $request->user()->id;
        $category->categoryname = $request->categoryname;
        $category->browsertitle = $request->browsertitle;
        $category->metakeyword = $request->metakeyword;
        $category->metadescription = $request->metadescription;
        $category->banner = $request->banner;
        $category->save();

        if ((int) $category->id > 0) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Category successfully created.',
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
     * @param  \App\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if($category->banner != ''){
            $banner = $this->load_image('categorybanner/'.$category->banner);
            if($banner){
                $category->banner_link = $banner->get_image_link();
                $category->banner_size = $banner->get_image_size();
            }

        }
        return view('admin.createcategory',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'categoryname' => 'required',
            'browsertitle' => 'required',
            'metakeyword' => 'required',
            'metadescription' => 'required',
        ]);
        $category->author = $request->user()->id;
        $category->categoryname = $request->categoryname;
        $category->browsertitle = $request->browsertitle;
        $category->metakeyword = $request->metakeyword;
        $category->metadescription = $request->metadescription;

        //Banner update
        if($request->banner != ''){
            if($category->banner != ''){
                $banner = $this->load_image('categorybanner/'.$category->banner);
                if($banner ) $banner->remove_image();
            }
            $category->banner = $request->banner;
        }

        $category->save();

        if ((int) $category->id > 0) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Category successfully updated.',
                ]
                );
            } else {
                return redirect()->route('admin.categorylist');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->banner != ''){
            $banner = $this->load_image('categorybanner/'.$category->banner);
            if($banner){
                $banner->remove_image();
            }
        }
        $category->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Category successfully deleted.',
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function removebanner(Category $category)
    {
        if($category->banner != ''){
            $banner = $this->load_image('categorybanner/'.$category->banner);
            if($banner){
                $banner->remove_image();
            }
        }
        $category->banner = '';
        $category->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Category banner successfully deleted.',
        ]);
    }

    /**
     * Publish the specified resource from storage.
     *
     * @param  \App\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function publish(Category $category)
    {
        $status = ((int)$category->status > 0) ? 0 : 1;
        $action = ((int)$category->status > 0) ? 'Un Published' : 'Published';
        $category->status = $status;
        $category->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Category successfully '.$action.'.',
        ]);
    }


    /**
     * List the specified resource as json.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function categoryList(Request $request)
    {

        $columns = array(
            0 => 'id',
            1 => 'categoryname',
            2 => 'description',
            3 => 'status'
        );
        $totalData = Category::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $categorys = Category::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $categorys = Category::where('id', 'LIKE', "%{$search}%")
                ->orWhere('categoryname', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Category::where('id', 'LIKE', "%{$search}%")
                ->orWhere('categoryname', 'LIKE', "%{$search}%")
                ->count();
        }
        $data = array();
        if (!empty($categorys)) {
            foreach ($categorys as $key => $category) {

                $checkIcon = ((int)$category->status > 0) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>';
                $checkText = ((int)$category->status > 0) ? 'Un-Publish Category' : 'Publish Category';

                $nestedData = [];
                $nestedData[] = $key + 1;
                $nestedData[] = $category->categoryname;
                $nestedData[] = '<a href="javascript:void(0);" title="'.$checkText.'" id="publish-'.$category->categoryslug.'">'.$checkIcon.'</a>';
                $nestedData[] = '<a href="'.route('admin.editcategory', ['category' => $category->categoryslug]).'" title="Edit Category"><i class="fa fa-edit"></i></a>';
                $nestedData[] = '<a href="javascript:void(0);" title="Delete Category" id="delete-'.$category->categoryslug.'"><i class="fa fa-trash"></i></a>';
                $nestedData['DT_RowId'] = $category->id;
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
