<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkFlowStage extends Model
{
    use HasFactory;
    protected $fillable = ['workflow_id','stage_name','position','type','user_id','workflow_group_id'];

    function workflow(){
        return $this->belongsTo(WorkFlow::class,'workflow_id');
    }

    function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    function group(){
        return $this->belongsTo(WorkFlowGroup::class,'workflow_group_id');
    }

    static function getFactory(){
        return new self;
    }

    static function fetch(){
        return self::getFactory()->newQuery();
    }

    static function getNextPosition($workFlowId){
        $record = self::fetch()->where('workflow_id',$workFlowId)->orderBy('position','desc');
        if (!$record->exists()){
            return 1;
        }
        return ($record->first()->position + 1);
    }

    static function getNextStageName($workFlowId){
        $record = self::fetch()->where('workflow_id',$workFlowId)->orderBy('position','desc');
        if (!$record->exists()){
            return 'Stage - 1';
        }
        return 'Stage - ' . ($record->first()->position + 1);

    }

    static function getValidation(){
      return [
          'workflow_id'=>'required',
          'stage_name'=>'required',
          'type'=>'required',
//          'position'=>'required',
          'user_id'=>'required',
          'workflow_group_id'=>'required'
      ];
    }

    static function createWorkFlowStage(){
      $data = request()->validate(self::getValidation());
      $data['position'] = self::getNextPosition($data['workflow_id']);
      $record = self::getFactory()->create($data);

      return [
          'message'=>'New workflow stage created successfully.',
          'error'=>false
      ];

    }

    static function updateWorkFlowStage($id){
      $data = request()->validate(self::getValidation());
      $record = self::fetch()->where('id',$id);

      if (!$record->exists()){
          return [
              'message'=>'Invalid record selected!',
              'error'=>true
          ];
      }

      $record->update($data);

      return  [
          'message'=>'Workflow stage updated successfully.',
          'error'=>false
      ];

    }

    static function removeWorkFlowStage($id){

       $record = self::fetch()->where('id',$id);
       $record->delete();

       return [
           'message'=>'Workflow stage removed',
           'error'=>false
       ];

    }


    static function isLastStage($stageId){

        $record = self::fetch()->where('id',$stageId)->first();
        $workFlowId = $record->workflow_id;
        $record = self::fetch()->where('workflow_id',$workFlowId)->orderBy('position','desc')->first();

        return ($record->id == $stageId);

    }





}
