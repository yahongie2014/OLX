@extends('layouts.adminlayout')

@section('PageHeader')
    {{__("general.Providers")}}
@endsection

@section('PageLocation')
    @parent

    <li>
        <a href="#">
            {{__("general.Providers")}}
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
                        <a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapse_1"
                           aria-expanded="false">{{__('general.Search')}}</a>
                    </div>
                    <div id="collapse_1" class="panel-collapse collapse " role="tabpanel">
                        <div class="panel-body pa-15">
                            <div class="form-wrap">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label mb-10">{{__("general.Name")}}  </label>
                                                <input type="text" class="form-control searchInputText"
                                                       id="provider_name">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label mb-10">{{__("general.Status")}}</label>
                                                <select class="selectpicker"
                                                        data-style="form-control btn-default btn-outline"
                                                        data-style="form-control btn-default btn-outline"
                                                        id="providerStatus">
                                                    <option value=""></option>
                                                    <option value="{{PROVIDER_INACTIVE}}">{{__("general.inactive")}}</option>
                                                    <option value="{{PROVIDER_ACTIVE}}">{{__("general.active")}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-actions mt-10">
                                                <button id="doSearch"
                                                        class="btn btn-success  mr-10"> {{__('general.Search')}}</button>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-actions mt-10">
                                                <button id="doClear"
                                                        class="btn btn-warning  mr-10"> {{__('general.Clear')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body row">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table display responsive product-overview mb-30" id="providersTable">
                                    <thead>
                                    <tr>
                                        <th>{{__("general.Provider_id")}}</th>
                                        <th>{{__("general.Name")}}</th>
                                        <th>{{__("general.Email")}}</th>
                                        <th>{{__("general.Photo")}}</th>
                                        <th>{{__("general.Status")}}</th>
                                        <th>{{__("general.Change Status")}}</th>
                                        <th>{{__("general.Show")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($providers as $user)
                                        <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            <img src=@if($user->image)
                                                    "{{asset(\Storage::url('Avatar/'.Auth::user()->image))}}"
                                                 @else {{asset("dist/img/user1.png")}}
                                                 @endif alt="user_auth"
                                                 class="user-auth-img img-circle"/>
                                        <td>
                                            @if($user->is_verify == 0)
                                                <span class="label label-danger font-weight-100">{{__("general.inactive")}}</span>
                                            @else
                                                <span class="label label-success font-weight-100">{{__("general.active")}}</span>
                                                @endif
                                        </td>
                                        <td>
                                            @if($user->is_verify == 0)
                                                <a href="{{url("admin/provider/activation/$user->id")}}">
                                                    <button class="btn btn-success btn-outline fancy-button btn-0">{{__("general.activate")}}</button>
                                                </a>
                                            @else
                                                <a href="{{url("admin/provider/activation/$user->id")}}">
                                                    <button class="btn btn-danger btn-outline fancy-button btn-0">{{__("general.deactivate")}}</button>
                                                </a>

                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{url("admin/profile/$user->id")}}" class="text-inverse pr-10"
                                               title="Edit" data-toggle="tooltip">
                                                <i class="zmdi zmdi-file txt-danger"></i>
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

@endsection

<!-- /Row -->
@section('footer')
    @parent
@endsection