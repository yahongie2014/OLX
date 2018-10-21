@extends('layouts.adminlayout')

@section('PageHeader')
{{__("general.Payment Types")}}
@endsection

@section('PageLocation')
@parent

<li>
    <a href="{{url('/admin/paytypes')}}">
        {{__("general.Payment Types")}}
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
                            <a href="{{url('/admin/paytypes/create')}}" >
                                <button class="btn btn-success btn-block btn-rounded btn-outline  btn-success">
                                    {{__("general.addNewPaymentType")}}
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table display responsive product-overview mb-30" id="languagesTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__("general.payment_type_id")}}</th>
                                        <th>{{__("general.Name")}}</th>
                                        <th>{{__("general.Status")}}</th>
                                        <th>{{__("general.Edit")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($paymentTypes as $paymentType)
                                    <tr>
                                        <td class="txt-dark centerCol">{{$loop->iteration}}</td>
                                        <td class="txt-dark centerCol">{{$paymentType->id}}</td>
                                        <td class="txt-dark centerCol">{{$paymentType->name}}</td>
                                        <td class="centerCol">
                                            @if($paymentType->status == PAYMENT_TYPE_ACTIVE)
                                                <span class="label label-success font-weight-100">{{__("general.active")}}</span>
                                            @else
                                                <span class="label label-danger font-weight-100">{{__("general.inactive")}}</span>
                                            @endif

                                        </td>

                                        <td class="centerCol">
                                            <a href="{{url('admin/paytypes/' . $paymentType->id . '/edit/')}}" class="text-inverse pr-10" title="Edit" data-toggle="tooltip">
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

<!-- /Row -->
@section('footer')
@parent
<script>
    $(document).ready(function(){
        "use strict";
        $('#languagesTable').DataTable();
    });
</script>
@endsection