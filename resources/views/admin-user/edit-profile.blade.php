<!-- Modal -->
<form method="POST" action="{{ route('user.update',[Auth::user()->id]) }}">
<div id="edit-profile" class="modal fade" role="dialog">
    <div class="modal-dialog">

{{--        modal-lg--}}

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                Edit Profile

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">


                    @csrf
                    @method('PUT')

                <input type="hidden" name="action" value="update-profile" />


                <div class="form-group row">

                    <label class="col-sm-12 col-form-label text-md-left">{{ __('E-mail') }}</label>

                    <div class="col-md-12">
                        <input type="text" class="form-control"  value="{{ Auth::user()->email }}"  readonly disabled />

                    </div>
                </div>




                <div class="form-group row">

                        <label class="col-sm-12 col-form-label text-md-left">{{ __('Your Profile Name') }}</label>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" autofocus>

                        </div>
                    </div>






            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary pull-left">
                    {{ __('Update Profile') }}
                </button>



                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
</form>
