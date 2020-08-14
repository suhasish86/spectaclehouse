<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Social;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function __construct()
    {
         $this->middleware('permission:social-list|social-create|social-edit|social-delete', ['only' => ['index','show']]);
         $this->middleware('permission:social-create', ['only' => ['create','store']]);
         $this->middleware('permission:social-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:social-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Social::latest()->paginate(5);
        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'linkurl' => 'required',
        ]);

        Social::create($request->all());

        return redirect()->route('products.index')
                        ->with('success','Social created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function show(Social $social)
    {
        return view('products.show',compact('social'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function edit(Social $social)
    {
        return view('products.edit',compact('social'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Social $social)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $social->update($request->all());

        return redirect()->route('products.index')
                        ->with('success','Social updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function destroy(Social $social)
    {
        $social->delete();

        return redirect()->route('products.index')
                        ->with('success','Social deleted successfully');
    }
}
