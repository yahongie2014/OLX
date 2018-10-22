@extends('layouts.providerlayout')

@section('PageHeader')
{{__("general.providerLoading")}}
@endsection

@section('PageLocation')
@parent

<li>
    <a href="{{url('/provider/loading')}}">
        {{__("general.providerLoading")}}
    </a>
</li>
@endsection

@section('content')
@parent
<!-- Row -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <a href="{{url('/provider/loading/create')}}" >
                                <button class="btn btn-success btn-block btn-rounded btn-outline  btn-success">
                                    {{__("general.addNewLoading")}}
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table display responsive product-overview mb-30" id="loadingsTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__("general.loading_id")}}</th>
                                        <th>{{__("general.Name")}}</th>
                                        <th>{{__("general.Address")}}</th>
                                        <th>{{__("general.Status")}}</th>
                                        <th>{{__("general.default")}}</th>
                                        <th>{{__("general.Edit")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($loadings as $loading)
                                    <tr>
                                        <td class="txt-dark centerCol">{{$loop->iteration}}</td>
                                        <td class="txt-dark centerCol">{{$loading->id}}</td>
                                        <td class="txt-dark centerCol">{{$loading->name}}</td>
                                        <td class="txt-dark centerCol">{{$loading->address}}</td>

                                        <td class="centerCol">
                                            @if($loading->status == PROVIDER_LOADING_ACTIVE)
                                            <span class="label label-success font-weight-100">{{__("general.active")}}</span>
                                            @else
                                            <span class="label label-danger font-weight-100">{{__("general.inactive")}}</span>
                                            @endif

                                        </td>
                                        <td class="centerCol">
                                            @if($loading->default == PROVIDER_LOADING_DEFAULT)
                                            <span class="label label-primary font-weight-100">{{__("general.default")}}</span>

                                            @endif

                                        </td>

                                        <td class="centerCol">
                                            <a href="{{url('provider/loading/' . $loading->id . '/edit/')}}" class="text-inverse pr-10" title="Edit" data-toggle="tooltip">
                                                <i class="zmdi zmdi-edit txt-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
@parent
<script>
    $(document).ready(function(){
        "use strict";
        $('#loadingsTable').DataTable();
    });
</script>
@endsection