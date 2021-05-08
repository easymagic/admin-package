<!-- Modal -->
<form method="POST" action="{{ route('workflow-stages.store') }}">
<div id="create" class="modal fade" role="dialog">
    <div class="modal-dialog">

{{--        modal-lg--}}

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                Create Stage

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">


                    @csrf

                {!! $hidden('workflow_id', $workflow_id) !!}




                    <div class="form-group row">

                        <label class="col-sm-12 col-form-label text-md-left">{{ __('Stage Name') }}</label>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="stage_name" value="{{ $stage_name }}" autofocus>

                        </div>

                    </div>


                <div class="form-group row">

                    <label class="col-sm-12 col-form-label text-md-left">{{ __('Position') }}</label>

                    <div class="col-md-12">
                        <input type="text" class="form-control" name="position" value="{{ $position }}" autofocus>
                    </div>

                </div>


                <div class="form-group row">

                    <label class="col-sm-12 col-form-label text-md-left">{{ __('Type Of Approval') }}</label>

                    <div class="col-md-12" data-stage-type-container>

                        <select name="type" id="type" class="form-control" style="margin-bottom: 5px;">
                            <option value="">--Select--</option>
                            <option value="user">User</option>
                            <option value="group">Group</option>
                        </select>

                        <select name="user_id" id="users" class="form-control" style="margin-bottom: 5px;">
                            <option value="0">--Select Users--</option>
                            @foreach ($users as $user)
                              <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>

                        <select name="workflow_group_id" id="groups" class="form-control">
                            <option value="0">--Select Group--</option>
                            @foreach ($groups as $group)
                             <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach

                        </select>


                    </div>

                </div>




            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary pull-left">
                    {{ __('Create Stage') }}
                </button>



                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
</form>
