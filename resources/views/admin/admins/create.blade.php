@extends('layouts.adminlayout')

@section('PageHeader')
{{__("general.Create_New_Admin")}}
@endsection

@section('PageLocation')
@parent

<li>
    <a href="#">
        {{__("general.Create_New_Admin")}}
    </a>
</li>
@endsection

@section('content')
@parent

<div class="row">
    <div class="col-md-12">
        <div class="panel-group accordion-struct" id="accordion_1" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading activestate" role="tab" id="heading_1">
                    <a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapse_1" aria-expanded="false">{{__('general.Create_New_Admin')}}</a>
                </div>
                <div id="collapse_1" class="panel-collapse collapse " role="tabpanel">
                    <div class="panel-body pa-15">
                        <div class="form-wrap">
                            <div class="form-body">
                                <form action="{{url('/admin/users/admin/' . $user->id)}}" method="POST">
                                    {{ method_field('PATCH') }}
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{$user->id}}" name="provider_id">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="txt-dark capitalize-font"><i class="fa fa-credit-card mr-10"></i>{{__("general.paymentTypesDiscounts")}}</h6>
                                            <hr class="light-grey-hr"/>
                                        </div>
                                    </div>
                                    <div class="form-actions mt-10">
                                        <button type="submit" class="btn btn-success mr-10 mb-30">{{__('general.Save')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.admin.show')
@endsection