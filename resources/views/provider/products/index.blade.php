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
                            <a href="{{url('/provider/products/create')}}" >
                                <button class="btn btn-success btn-block btn-rounded btn-outline  btn-success">
                                    {{__("general.addNewProduct")}}
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
                                        <th>{{__("general.Product_name")}}</th>
                                        <th>{{__("general.DESC")}}</th>
                                        <th>{{__("general.Status")}}</th>
                                        <th>{{__("general.Price")}}</th>
                                        <th>{{__("general.Edit")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($list as $lists)
                                    <tr>
                                        <td class="txt-dark centerCol">{{$loop->iteration}}</td>
                                        <td class="txt-dark centerCol">{{$lists->id}}</td>
                                        <td class="txt-dark centerCol">{{$lists->name}}</td>
                                        <td class="txt-dark centerCol">{{$lists->desc}}</td>

                                        <td class="centerCol">
                                            @if($lists->is_active == PRODUCT_ACTIVE)
                                            <span class="label label-success font-weight-100">{{__("general.active")}}</span>
                                            @else
                                            <span class="label label-danger font-weight-100">{{__("general.inactive")}}</span>
                                            @endif

                                        </td>
                                        <td class="centerCol">
                                            {{$lists->price}}
                                        </td>
                                        <td class="centerCol">
                                            <a href="{{url('provider/products/' . $lists->id . '/edit/')}}" class="text-inverse pr-10" title="Edit" data-toggle="tooltip">
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