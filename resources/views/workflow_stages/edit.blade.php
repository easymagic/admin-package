<!-- Modal -->
<form method="POST" action="{{ route('workflow-stages.update',[$item->id]) }}">
    <div id="edit{{ $item->id }}" class="modal fade" role="dialog">
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
                    @method('PUT')

                    {!! $hidden('workflow_id', $item->workflow_id) !!}




                    <div class="form-group row">

                        <label class="col-sm-12 col-form-label text-md-left">{{ __('Stage Name') }}</label>

                        <div class="col-md-12">
                            <input type="text"  class="form-control" name="stage_name" value="{{ $item->stage_name }}" autofocus>

                        </div>

                    </div>


                    <div class="form-group row">

                        <label class="col-sm-12 col-form-label text-md-left">{{ __('Position') }}</label>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="position" value="{{ $item->position }}" autofocus>
                        </div>

                    </div>


                    <div class="form-group row">

                        <label class="col-sm-12 col-form-label text-md-left">{{ __('Type Of Approval') }}</label>

                        <div class="col-md-12" data-stage-type-container>

                            <select name="type" id="type" class="form-control" style="margin-bottom: 5px;">
                                <option value="">--Select--</option>
                                <option {{ $selected($item->type == 'user') }} value="user">User</option>
                                <option {{ $selected($item->type == 'group') }} value="group">Group</option>
                            </select>

                            <select name="user_id" id="users" class="form-control" style="margin-bottom: 5px;">
                                <option value="0">--Select Users--</option>
                                @foreach ($users as $user)
                                    <option {{ $selected($user->id == $item->user_id) }} value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>

                            <select name="workflow_group_id" id="groups" class="form-control">

                                <option value="0">--Select Group--</option>
                                @foreach ($groups as $group)
                                    <option {{ $selected($group->id == $item->workflow_group_id) }} value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach

                            </select>


                        </div>

                    </div>




                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary pull-left">
                        {{ __('Update Stage') }}
                    </button>



                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
</form>
