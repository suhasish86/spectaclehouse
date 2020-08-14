<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ImageHandler;


class PageController extends Controller
{
    use ImageHandler;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pagelist');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createpage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = new Page();
        $request->validate([
            'pagename' => 'required',
            'browsertitle' => 'required',
            'metakeyword' => 'required',
            'metadescription' => 'required',
            'pagedescription' => 'required',
        ]);
        $page->author = $request->user()->id;
        $page->pagename = $request->pagename;
        $page->browsertitle = $request->browsertitle;
        $page->metakeyword = $request->metakeyword;
        $page->metadescription = $request->metadescription;
        $page->description = $request->pagedescription;
        $page->banner = $request->banner;
        $page->save();

        if ((int) $page->id > 0) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Page successfully created.',
                ]
                );
            } else {
                return redirect()->route('admin.pagelist');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        if($page->banner != ''){
            $banner = $this->load_image('pagebanner/'.$page->banner);
            if($banner){
                $page->banner_link = $banner->get_image_link();
                $page->banner_size = $banner->get_image_size();
            }

        }
        return view('admin.createpage',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'pagename' => 'required',
            'browsertitle' => 'required',
            'metakeyword' => 'required',
            'metadescription' => 'required',
            'pagedescription' => 'required',
        ]);
        $page->author = $request->user()->id;
        $page->pagename = $request->pagename;
        $page->browsertitle = $request->browsertitle;
        $page->metakeyword = $request->metakeyword;
        $page->metadescription = $request->metadescription;
        $page->description = $request->pagedescription;

        //Banner update
        if($request->banner != ''){
            if($page->banner != ''){
                $banner = $this->load_image('pagebanner/'.$page->banner);
                if($banner ) $banner->remove_image();
            }
            $page->banner = $request->banner;
        }

        $page->save();

        if ((int) $page->id > 0) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Page successfully updated.',
                ]
                );
            } else {
                return redirect()->route('admin.pagelist');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        if($page->banner != ''){
            $banner = $this->load_image('pagebanner/'.$page->banner);
            if($banner){
                $banner->remove_image();
            }
        }
        $page->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Page successfully deleted.',
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function removebanner(Page $page)
    {
        if($page->banner != ''){
            $banner = $this->load_image('pagebanner/'.$page->banner);
            if($banner){
                $banner->remove_image();
            }
        }
        $page->banner = '';
        $page->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Page banner successfully deleted.',
        ]);
    }

    /**
     * Publish the specified resource from storage.
     *
     * @param  \App\Admin\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function publish(Page $page)
    {
        $status = ((int)$page->status > 0) ? 0 : 1;
        $action = ((int)$page->status > 0) ? 'Un Published' : 'Published';
        $page->status = $status;
        $page->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Page successfully '.$action.'.',
        ]);
    }


    /**
     * List the specified resource as json.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pageList(Request $request)
    {

        $columns = array(
            0 => 'id',
            1 => 'pagename',
            2 => 'description',
            3 => 'status'
        );
        $totalData = Page::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $pages = Page::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $pages = Page::where('id', 'LIKE', "%{$search}%")
                ->orWhere('pagename', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Page::where('id', 'LIKE', "%{$search}%")
                ->orWhere('pagename', 'LIKE', "%{$search}%")
                ->count();
        }
        $data = array();
        if (!empty($pages)) {
            foreach ($pages as $key => $page) {

                $checkIcon = ((int)$page->status > 0) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>';
                $checkText = ((int)$page->status > 0) ? 'Un-Publish Page' : 'Publish Page';

                $nestedData = [];
                $nestedData[] = $page->id;
                $nestedData[] = $page->pagename;
                $nestedData[] = $page->description;
                $nestedData[] = '<a href="javascript:void(0);" title="'.$checkText.'" id="publish-'.$page->pageslug.'">'.$checkIcon.'</a>';
                $nestedData[] = '<a href="'.route('admin.editpage', ['page' => $page->pageslug]).'" title="Edit Page"><i class="fa fa-edit"></i></a>';
                $nestedData[] = '<a href="javascript:void(0);" title="Delete Page" id="delete-'.$page->pageslug.'"><i class="fa fa-trash"></i></a>';
                $nestedData['DT_RowId'] = $page->id;
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
