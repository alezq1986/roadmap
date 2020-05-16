<?php

namespace App\Http\Controllers;

use App\Roadmap;
use Illuminate\Http\Request;

class RoadmapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();

        $where = array();

        if (!empty($data)) {

            if ($request->has('id') && $request->get('id') != null) {
                array_push($where, ['id', '=', $request->get('id')]);
            }

            if ($request->has('data_base_de') && $request->get('data_base_de') != null) {
                array_push($where, ['data_base', '>=', $request->get('data_base_de')]);
            }

            if ($request->has('data_base_ate') && $request->get('data_base_ate') != null) {
                array_push($where, ['data_base', '<=', $request->get('data_base_ate')]);
            }

            $roadmaps = Roadmap::where($where)->orderBy('id', 'ASC')->paginate(10);

        } else {

            $roadmaps = Roadmap::orderBy('id', 'ASC')->paginate(10);
        }

        return view('roadmaps.index', ['roadmaps' => $roadmaps, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Roadmap $roadmap
     * @return \Illuminate\Http\Response
     */
    public function show(Roadmap $roadmap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Roadmap $roadmap
     * @return \Illuminate\Http\Response
     */
    public function edit(Roadmap $roadmap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Roadmap $roadmap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Roadmap $roadmap)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Roadmap $roadmap
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roadmap $roadmap)
    {
        //
    }
}
