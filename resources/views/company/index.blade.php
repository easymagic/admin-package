@extends('layouts.admin-layoutv2')

@section('title')
  Manage Users
@endsection


@section('content')

    <div class="col-lg-12 post-list" style="@yield('main-center-style','margin-left: 1%;');">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">

                    <div style="
    border-bottom: 3px solid #000000;
    margin-bottom: 17px;
    font-size: 18px;
">
                        Users
                    </div>

                    @include('admin-user.create')

                    @foreach ($users['records'] as $item)


                        @include('admin-user.user-edit')
                        @include('admin-user.user-change-password')


                    @endforeach


                    <div class="col-md-12" align="right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" style="margin-bottom: 11px;" data-target="#create">Add User</button>
                    </div>

                    <table class="table table-striped">
                        <tr>
                            <th>
                                Name
                            </th>
                            <th>
                                E-mail
                            </th>
                            <th>
                                Type
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Actions
                            </th>
                        </tr>
                        @foreach ($users['records'] as $item)


                            <tr>

                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    {{ $item->email }}
                                </td>

                                <td>
                                    {{ $item->type }}
                                </td>

                                <td>
                                    {{ $item->status_name }}
                                </td>

                                <td>
                                    <div class="dropdown show">
                                        <button class="btn btn-success dropdown-toggle btn-sm pull-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Action
                                        </button>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; transform: translate3d(-5px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">


                                            <a  type="button" data-toggle="modal" style="margin-bottom: 11px;" data-target="#user-edit{{ $item->id }}" class="dropdown-item" data-backdrop="false">Modify</a>


                                            <a  type="button" data-toggle="modal" style="margin-bottom: 11px;" data-target="#user-change-password{{ $item->id }}" class="dropdown-item" data-backdrop="false">Change Password</a>



                                            <form method="post" onsubmit="return confirm('Do you want to confirm this action?')" action="{{ route('user.update',$item->id) }}">

                                                @csrf
                                                @method('PUT')

                                                <input type="hidden" name="action" value="block" />


                                                <button type="submit" class="mb-1 dropdown-item btn btn-warning btn-sm" data-backdrop="false"  data-toggle="modal" data-target="#approveReject" >Block</button>

                                            </form>



                                            <form method="post" onsubmit="return confirm('Do you want to confirm this action?')" action="{{ route('user.update',$item->id) }}">

                                                @csrf
                                                @method('PUT')

                                                <input type="hidden" name="action" value="unblock" />

                                                <button type="submit" class="mb-1 dropdown-item btn btn-primary btn-sm" data-backdrop="false"  data-toggle="modal" data-target="#approveReject" >Unblock</button>

                                            </form>



                                            <form method="post" onsubmit="return confirm('Do you want to confirm this action?')" action="{{ route('user.destroy',$item->id) }}">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="mb-1 dropdown-item btn btn-danger btn-sm" data-backdrop="false"  data-toggle="modal" data-target="#approveReject" >Remove</button>

                                            </form>


                                        </div>
                                    </div>
                                </td>
                            </tr>

                        @endforeach
                    </table>

                    {{ $users['paginate']->links() }}



                </div>
            </div>

            <div class="col-lg-12" style="margin: 11.4%;"></div>
        </div>


    </div>

@endsection

