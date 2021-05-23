<!-- Modal -->
<form method="POST" action="{{ route('user.update',[Auth::user()->id]) }}">
<div id="logout-confirmation" class="modal fade" role="dialog">
    <div class="modal-dialog">

{{--        modal-lg--}}

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                Logout Confirmation

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">


                    @csrf
                    @method('PUT')


                <input type="hidden" name="action" value="logout" />


                    <div class="form-group row">

                        <label class="col-sm-12 col-form-label text-md-left">{{ __('Do You want to logout?') }}</label>

                    </div>


            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary pull-left">
                    {{ __('Yes') }}
                </button>


                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

            </div>
        </div>

    </div>
</div>
</form>
