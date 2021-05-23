<!-- Modal -->
<form method="POST" action="{{ route('company.store') }}">
<div id="create" class="modal fade" role="dialog">
    <div class="modal-dialog">

{{--        modal-lg--}}

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                Create Company

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">


                    @csrf


                    <div class="form-group row">

                        <label class="col-sm-12 col-form-label text-md-left">{{ __('Name') }}</label>

                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

                        </div>
                    </div>



                <div class="form-group row">

                    <label class="col-sm-12 col-form-label text-md-left">{{ __('Admin-User') }}</label>

                    <div class="col-md-12">

                        <select name="user_id" id="" class="form-control">
                            <option value="1">--Default--</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->email }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>




            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary pull-left">
                    {{ __('Create Company') }}
                </button>


                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
</form>
