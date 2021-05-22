<!-- Modal -->
<form method="POST" action="{{ route('user.store') }}">
<div id="create" class="modal fade" role="dialog">
    <div class="modal-dialog">

{{--        modal-lg--}}

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                Create User

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

                    <label class="col-sm-12 col-form-label text-md-left">{{ __('E-mail') }}</label>

                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>

                    </div>
                </div>


                <div class="form-group row">

                    <label class="col-sm-12 col-form-label text-md-left">{{ __('Type') }}</label>

                    <div class="col-md-12">
                        <select name="type" class="form-control" id="">
                            <option value="">--Select--</option>
                            <option value="Admin">Admin</option>
                            <option value="Staff">Staff</option>
                        </select>
                    </div>

                </div>



                <div class="form-group row">

                    <label class="col-sm-12 col-form-label text-md-left">{{ __('Password') }}</label>

                    <div class="col-md-12">
                        <input  type="password" class="form-control" name="password" value="" autofocus>

                    </div>
                </div>


                <div class="form-group row">

                    <label class="col-sm-12 col-form-label text-md-left">{{ __('Confirm Password') }}</label>

                    <div class="col-md-12">
                        <input  type="password" class="form-control" name="password_confirmation" value="" autofocus>

                    </div>
                </div>




            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary pull-left">
                    {{ __('Create User') }}
                </button>



                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
</form>
