@extends('layouts.main')

@section('content')


    <div class="col-lg-3" style="">
        <!-- search filter -->
{{--        @yield('side-bar','')--}}
    </div>
    <div class="col-lg-10 post-list" style="@yield('main-center-style','margin-left: 1%;');">


        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">

                    <div style="
    border-bottom: 3px solid #000000;
    margin-bottom: 17px;
    font-size: 18px;
">
                        Workflows Stages
                    </div>

                    <div class="col-md-12" style="padding: 0;">
                        <label for="">
                            Select Workflow
                            <select name="" id="workflow_id">
                                <option value="0">--Select--</option>
                                @foreach ($workflows as $item)
                                    <option {{ $selected($item->id == request('workflow_id')) }} value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </label>

                    </div>

                    @include('workflow_stages.create')

                    @foreach ($stages as $item)

                        @include('workflow_stages.edit')

                    @endforeach

                    <div class="col-md-12" align="right">
                        <a href="{{ route('workflow.index') }}" style="margin-bottom: 11px;" class="btn btn-sm btn-success">Workflows</a>
                        @if (!empty($workflow_id))

                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" style="margin-bottom: 11px;" data-target="#create">Add Stage</button>

                        @endif
                    </div>

                    <table class="table table-striped">
                        <tr>
                            <th>
                                Stage Name
                            </th>
                            <th>
                                Position
                            </th>
                            <th>
                                Type ( Approver )
                            </th>
                            <th style="text-align: right;">
                                Actions
                            </th>
                        </tr>
                        @foreach ($stages as $item)

                            <tr>

                                <td>
                                    {{ $item->stage_name }}
                                </td>

                                <td>
                                    {{ $item->position }}
                                </td>

                                <td>
                                    {{ $item->type }} ( {{ $item->type == 'user'? $item->user->name : ''  }}{{ $item->type == 'group'? $item->group->name : '' }} )
                                </td>

                                <td>
                                    <div class="dropdown show">
                                        <button class="btn btn-success dropdown-toggle btn-sm pull-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Action
                                        </button>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; transform: translate3d(-5px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">


                                            <a  type="button" data-toggle="modal" style="margin-bottom: 11px;" data-target="#edit{{ $item->id }}" class="dropdown-item" data-backdrop="false">Modify</a>

                                            <form method="post" onsubmit="return confirm('Do you want to confirm this action?')" action="{{ route('workflow-stages.destroy',$item->id) }}">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="dropdown-item btn btn-danger btn-sm" data-backdrop="false"  data-toggle="modal" data-target="#approveReject" >Remove</button>

                                            </form>

                                        </div>
                                    </div>
                                </td>
                            </tr>

                        @endforeach
                    </table>



                </div>
            </div>

            <div class="col-lg-12" style="margin: 11.4%;"></div>
        </div>



        @endsection


        @section('script')
            <script>

                $('#workflow_id').on('change',function(){

                    location.href = `{{ route('workflow-stages.index') }}?workflow_id=${$(this).val()}`;

                });


                $('[data-stage-type-container]').each(function(){

                    var $type = $(this).find('#type');
                    var $users = $(this).find('#users');
                    var $groups = $(this).find('#groups');

                    var actions = {
                        user:()=>{
                            $users.show();
                            $groups.hide();
                        },
                        group:()=>{
                            $users.hide();
                            $groups.show();
                        },
                        "":()=>{
                            $users.hide();
                            $groups.hide();
                        }
                    };

                    $type.on('change',function(){

                        var $sel = $(this).val();
                        if (actions[$sel]){
                            actions[$sel]();
                        }

                    });

                    $type.trigger('change');

                });
            </script>


    </div>

@endsection