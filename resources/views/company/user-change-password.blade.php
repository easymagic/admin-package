<!-- Modal -->
<form method="POST" action="{{ route('user.update',[$item->id]) }}">
    <div id="user-change-password{{ $item->id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">

        {{--        modal-lg--}}

        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    Change User Password

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">


                    @csrf
                    @method('PUT')

                    <input type="hidden" name="action" value="change-user-password" />





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
                        {{ __('Change User Password') }}
                    </button>



                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
</form>
