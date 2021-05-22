<!-- Modal -->
<form method="POST" action="{{ route('user.update',[$item->id]) }}">
    <div id="user-edit{{ $item->id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">

        {{--        modal-lg--}}

        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    Admin Edit User

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">


                    @csrf
                    @method('PUT')

                    <input type="hidden" name="action" value="update-user-profile" />


                    <div class="form-group row">

                        <label class="col-sm-12 col-form-label text-md-left">{{ __('Name') }}</label>

                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control" name="name" value="{{ $item->name }}" autofocus>
                        </div>
                    </div>



                    <div class="form-group row">

                        <label class="col-sm-12 col-form-label text-md-left">{{ __('Type') }}</label>

                        <div class="col-md-12">
                            <select name="type" class="form-control" id="">
                                <option  value="">--Select--</option>
                                <option {{ $item->type == 'Admin'? 'selected':'' }} value="Admin">Admin</option>
                                <option {{ $item->type == 'Staff'? 'selected':'' }} value="Staff">Staff</option>
                            </select>
                        </div>

                    </div>


                    <div class="form-group row">

                        <label class="col-sm-12 col-form-label text-md-left">{{ __('Company') }}</label>

                        <div class="col-md-12">
                            <select name="company_id" class="form-control" id="">
                                <option value="">--Select--</option>
                                @foreach ($companies as $company)
                                    <option {{ $company->id == $item->company_id? 'selected':'' }} value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>




                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary pull-left">
                        {{ __('Update User') }}
                    </button>



                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
</form>
