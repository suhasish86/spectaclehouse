<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Facility;
use App\Http\Controllers\Controller;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    use ImageHandler;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($facilitytype)
    {
        $facility = new Facility();
        $facility->facilitytype = $facilitytype;
        return view('admin.facilitylist', compact('facility'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($facilitytype)
    {
        $facility = new Facility();
        $facility->facilitytype = $facilitytype;
        return view('admin.createfacility', compact('facility'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $facility = new facility();
        $request->validate([
            'facilityname' => 'required',
            'facilitytype' => 'required',
            'browsertitle' => 'required',
            'metakeyword' => 'required',
            'metadescription' => 'required',
            'description' => 'required',
        ]);
        $facility->author = $request->user()->id;
        $facility->facilityname = $request->facilityname;
        $facility->facilitytype = $request->facilitytype;
        $facility->browsertitle = $request->browsertitle;
        $facility->metakeyword = $request->metakeyword;
        $facility->metadescription = $request->metadescription;
        $facility->description = $request->description;
        $facility->image = $request->image;
        $facility->save();

        if ((int) $facility->id > 0) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Facility successfully created.',
                ]
                );
            } else {
                return redirect()->route('admin.facilitylist');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function show(Facility $facility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function edit($facilitytype, Facility $facility)
    {
        if($facility->image != ''){
            $image = $this->load_image('facilityimage/'.$facility->image);
            if($image){
                $facility->image_link = $image->get_image_link();
                $facility->image_size = $image->get_image_size();
            }

        }
        return view('admin.createfacility',compact('facility'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'facilityname' => 'required',
            'facilitytype' => 'required',
            'browsertitle' => 'required',
            'metakeyword' => 'required',
            'metadescription' => 'required',
            'description' => 'required',
        ]);
        $facility->author = $request->user()->id;
        $facility->facilityname = $request->facilityname;
        $facility->facilitytype = $request->facilitytype;
        $facility->browsertitle = $request->browsertitle;
        $facility->metakeyword = $request->metakeyword;
        $facility->metadescription = $request->metadescription;
        $facility->description = $request->description;

        //image update
        if($request->image != ''){
            if($facility->image != ''){
                $image = $this->load_image('facilityimage/'.$facility->image);
                if($image ) $image->remove_image();
            }
            $facility->image = $request->image;
        }

        $facility->save();

        if ((int) $facility->id > 0) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Facility successfully updated.',
                ]
                );
            } else {
                return redirect()->route('admin.facilitylist');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facility $facility)
    {
        if($facility->image != ''){
            $image = $this->load_image('facilityimage/'.$facility->image);
            if($image){
                $image->remove_image();
            }
        }
        $facility->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Facility successfully deleted.',
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function removeimage(Facility $facility)
    {
        if($facility->image != ''){
            $image = $this->load_image('facilityimage/'.$facility->image);
            if($image){
                $image->remove_image();
            }
        }
        $facility->image = '';
        $facility->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Facility image successfully deleted.',
        ]);
    }

    /**
     * Publish the specified resource from storage.
     *
     * @param  \App\Admin\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function publish(Facility $facility)
    {
        $status = ((int)$facility->status > 0) ? 0 : 1;
        $action = ((int)$facility->status > 0) ? 'Un Published' : 'Published';
        $facility->status = $status;
        $facility->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Facility successfully '.$action.'.',
        ]);
    }


    /**
     * List the specified resource as json.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function facilityList(Request $request)
    {

        $columns = array(
            0 => 'id',
            1 => 'facilityname',
            2 => 'description',
            3 => 'status'
        );
        $totalData = Facility::where('facilitytype', $request->input('type'))->count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $facilitys = Facility::where('facilitytype', $request->input('type'))
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $facilitys = Facility::where('facilitytype', $request->input('type'))
                ->where(function($query) use ($search) {
                    $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('facilityname', 'LIKE', "%{$search}%");
                })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Facility::where('facilitytype', $request->input('type'))
                ->where(function($query) use ($search) {
                    $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('facilityname', 'LIKE', "%{$search}%");
                })
                ->count();
        }
        $data = array();
        if (!empty($facilitys)) {
            foreach ($facilitys as $key => $facility) {

                $checkIcon = ((int)$facility->status > 0) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>';
                $checkText = ((int)$facility->status > 0) ? 'Un-Publish facility' : 'Publish facility';

                $nestedData = [];
                $nestedData[] = $facility->id;
                $nestedData[] = $facility->facilityname;
                $nestedData[] = '<a href="javascript:void(0);" title="'.$checkText.'" id="publish-'.$facility->facilityslug.'">'.$checkIcon.'</a>';
                $nestedData[] = '<a href="'.route('admin.editfacility', ['facility' => $facility->facilityslug, 'facilitytype' => $facility->facilitytype]).'" title="Edit facility"><i class="fa fa-edit"></i></a>';
                $nestedData[] = '<a href="javascript:void(0);" title="Delete facility" id="delete-'.$facility->facilityslug.'"><i class="fa fa-trash"></i></a>';
                $nestedData['DT_RowId'] = $facility->id;
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
