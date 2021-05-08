<?php

namespace App\Http\Controllers;

use App\Models\WorkFlow;
use App\Models\WorkFlowGroup;
use App\Models\WorkFlowStage;
use App\Traits\ResponseTrait;
use App\User;
use Illuminate\Http\Request;

class WorkFlowStageController extends Controller
{

    use ResponseTrait;

    function loadStages(){
        $query = WorkFlowStage::fetch()->orderBy('position','asc');
        $this->data['workflow_id'] = '0';

        if (\request()->filled('workflow_id')){
            $this->data['workflow_id'] = \request('workflow_id');
        }

        $query = $query->where('workflow_id',$this->data['workflow_id']);

        $this->data['stage_name'] = WorkFlowStage::getNextStageName($this->data['workflow_id']);
        $this->data['position'] = WorkFlowStage::getNextPosition($this->data['workflow_id']);

        $this->data['stages'] = $query->get();
    }

    function loadWorkFlows(){
        $this->data['workflows'] = WorkFlow::fetch()->get();
    }

    function loadUsers(){
        $this->data['users'] = User::fetchV2()->where('role','admin')->get();
    }

    function loadGroups(){
        $this->data['groups'] = WorkFlowGroup::fetch()->get();
    }


    public function index()
    {

        $this->loadWorkFlows();
        $this->loadStages();
        $this->loadUsers();
        $this->loadGroups();

        return view('workflow_stages.index',$this->data);

    }

    public function create()
    {



    }

    public function store(Request $request)
    {
        return $this->resolveResponse(WorkFlowStage::createWorkFlowStage());
    }

    public function show(WorkFlowStage $workFlowStage)
    {
        //
    }

    public function edit(WorkFlowStage $workFlowStage)
    {
        //
    }

    public function update(Request $request, $id)
    {
        return $this->resolveResponse(WorkFlowStage::updateWorkFlowStage($id));
    }

    public function destroy($id)
    {
        return $this->resolveResponse(WorkFlowStage::removeWorkFlowStage($id));
    }

}
