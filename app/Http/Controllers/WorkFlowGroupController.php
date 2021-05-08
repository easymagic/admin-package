<?php

namespace App\Http\Controllers;

use App\Models\WorkFlowGroup;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class WorkFlowGroupController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    function loadGroups(){
        $this->data['groups'] = WorkFlowGroup::fetch()->get();
    }


    public function index()
    {
        $this->loadGroups();
        return view('workflow_groups.index',$this->data);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->resolveResponse(WorkFlowGroup::createGroup());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkFlowGroup  $workFlowGroup
     * @return \Illuminate\Http\Response
     */
    public function show(WorkFlowGroup $workFlowGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkFlowGroup  $workFlowGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkFlowGroup $workFlowGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkFlowGroup  $workFlowGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->resolveResponse(WorkFlowGroup::updateGroup($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkFlowGroup  $workFlowGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->resolveResponse(WorkFlowGroup::deleteGroup($id));
    }

}
