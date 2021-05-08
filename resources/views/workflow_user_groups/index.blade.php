@extends('layouts.main')

@section('content')

    <div class="col-lg-10 post-list" style="@yield('main-center-style','margin-left: 1%;');">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">

                    <div style="
    border-bottom: 3px solid #000000;
    margin-bottom: 17px;
    font-size: 18px;
">
                        User Groups
                    </div>
                    <div class="col-md-12">
                        <select onchange="location.href=`{{ route('workflow-user-group.index') }}?grp=${this.value}`;" name="" id="group-filter" style="margin-bottom: 11px;">
                            <option value="">--Filter Groups--</option>
                            @foreach ($groups as $group)
                              <option {{ $selected(request()->filled('grp') && request('grp') == $group->id) }} value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>

{{--                    @include('workflow.create')--}}

                    @foreach ($users as $item)


                        @include('workflow_user_groups.edit')


                    @endforeach


                    <table class="table table-striped">
                        <tr>
                            <th>
                                Name
                            </th>
                            <th>
                                E-mail
                            </th>
                            <th>
                                Actions
                            </th>
                        </tr>
                        @foreach ($users as $item)


                            <tr>

                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    {{ $item->email }}
                                </td>

                                <td>
                                    <form action="{{ route('workflow-user-group.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $item->id }}" />
                                    <select onchange="this.form.submit()" name="workflow_group_id" class="form-control" id="">
                                        <option value="">--Select--</option>
                                        @foreach ($groups as $group)
                                            <option {{ $selected($userHasGroup($item,$group)) }} value="{{ $group->id }}">{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                    </form>

                                    @foreach ($getUserGroups($item) as $group)
                                        <form {!! $confirm() !!} action="{{ route('workflow-user-group.destroy',[$item->email . '|' . $group->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button style="margin-top: 11px;" class="form-control btn btn-danger btn-sm">Remove {{ $group->name }}</button>
                                        </form>
                                    @endforeach

                                </td>
                            </tr>

                        @endforeach
                    </table>

                    <div>
                        {{ $users->appends($_GET)->links() }}
                    </div>


                </div>
            </div>

            <div class="col-lg-12" style="margin: 11.4%;"></div>
        </div>


    </div>

@endsection