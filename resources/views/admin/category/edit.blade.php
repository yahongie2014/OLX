@extends('layouts.adminlayout')

@section('PageHeader')
{{__("general.updateCategory")}}
@endsection

@section('PageLocation')
@parent

<li>
    <a href="{{url('/admin/categories')}}">
        {{__("general.Categories")}}
    </a>
</li>
<li>
    <a href="#">
        {{__("general.updateCategory")}}
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
                    <form action="{{url('/admin/categories/' . $category->id)}}" enctype="multipart/form-data"  method="POST">
                        <div class="row">
                            <div class="col-sm-6">
                                <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>{{__("general.CategoryInformation")}}</h6>
                                <hr class="light-grey-hr"/>
                                {{ method_field('PATCH') }}
                                {{ csrf_field() }}
                                <input type="hidden" value="{{$category->id}}" name="category_id">
                                <div class="form-body overflow-hide">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-primary pr-10 pull-left">
                                            <input id="languageAvailability" value="1" name="is_active" type="checkbox" @if(old('is_active')) checked @elseif($category->is_active == CATEGORY_ACTIVE) checked @endif>
                                            <label for="languageAvailability"> {{__("general.available")}} </label>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                </div>
                                <div class="form-group {{ $errors->has('longitude') ? ' has-error' : '' }}">
                                    <label class="control-label mb-10" for="exampleInputuname_01" >{{__("general.longitude")}}</label>
                                    <div class="input-group">

                                        <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01" name="longitude" value="{{$category->longitude}}" required />
                                    </div>
                                    @if ($errors->has('longitude'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('longitude') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('latitudes') ? ' has-error' : '' }}">
                                    <label class="control-label mb-10" for="exampleInputuname_01" >{{__("general.latitudes")}}</label>
                                    <div class="input-group">

                                        <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01"name="latitudes"  value="{{$category->latitudes}}" required />
                                    </div>
                                    @if ($errors->has('latitudes'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('latitudes') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('icon') ? ' has-error' : '' }}">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="mt-40">
                                                <input type="file"
                                                       name="icon"
                                                       id="icon"
                                                       class="dropify"
                                                       data-default-file="{{asset(\Storage::url('Services/'.$category->icon))}}"
                                                       accept=".jpg,.jpeg,.png" />
                                            </div>
                                            @if ($errors->has('icon'))
                                                <span class="help-block"
                                                      style="color : red">
                                                <strong>{{ $errors->first('icon') }}</strong>
                                            </span>
                                            @endif

                                            <label class="control-label mb-10" for="exampleInputuname_01">{{__("general.Service")}}</label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-6 col-mx-auto">
                                <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-translate mr-10"></i>{{__("general.Localization")}}</h6>
                                <hr class="light-grey-hr"/>
                                <div class="panel panel-default card-view">
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-heading">
                                            {{__("general.Localization")}}
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-body overflow-hide">
                                                        <div id="english-link" class="form-group {{ $errors->has('en_name') ? ' has-error' : '' }}">
                                                            <label class="control-label mb-10" for="exampleInputuname_01" >{{__("general.name_en")}}</label>
                                                            <div class="input-group">

                                                                <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01" name="en_name" value=@if(old('en_name')) "{{old('en_name')}}" @else "{{$category->translate('en')->name }}" @endif required   />
                                                            </div>
                                                            @if ($errors->has('en_name'))
                                                                <span class="help-block">
                                                                <strong>{{ $errors->first('en_name') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div id="english-link"
                                                             class="form-group {{ $errors->has('en_desc') ? ' has-error' : '' }}">
                                                            <label class="control-label mb-10"
                                                                   for="exampleInputuname_01">{{__("general.en_desc")}}</label>
                                                            <div class="input-group">

                                                                <textarea class="form-control"
                                                                          id="exampleInputuname_01" name="en_desc"
                                                                          value="{{old('en_desc')}}">{{$category->translate("en")->desc}}</textarea>

                                                            </div>
                                                            @if ($errors->has('en_desc'))
                                                                <span class="help-block">
                                                                <strong>{{ $errors->first('en_desc') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>

                                                        <div id="arabic-link" class="form-group {{ $errors->has('ar_name') ? ' has-error' : '' }}">
                                                            <label class="control-label mb-10" for="exampleInputuname_01" >{{__("general.name_ar")}}</label>
                                                            <div class="input-group">
                                                                <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01" name="ar_name" value=@if(old('ar_name')) "{{old('ar_name')}}" @else "{{$category->translate('ar')->name }}"  @endif required   />
                                                            </div>
                                                            @if ($errors->has('name.'))
                                                                <span class="help-block">
                                                                <strong>{{ $errors->first('ar_name') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div id="arabic-link"
                                                             class="form-group {{ $errors->has('ar_desc') ? ' has-error' : '' }}">
                                                            <label class="control-label mb-10"
                                                                   for="exampleInputuname_01">{{__("general.ar_desc")}}</label>
                                                            <div class="input-group">

                                                                <textarea class="form-control"
                                                                          id="exampleInputuname_01" name="ar_desc"
                                                                          value="{{old('ar_desc')}}">{{$category->translate("ar")->desc}}</textarea>

                                                            </div>
                                                            @if ($errors->has('ar_desc'))
                                                                <span class="help-block">
                                                                <strong>{{ $errors->first('ar_desc') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-actions mt-10">
                                <button type="submit" class="btn btn-success mr-10 mb-30">{{__('general.Save')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">

</div>

@endsection

<!-- /Row -->
@section('footer')
@parent
<script>
    $(document).ready(function(){
        "use strict";
        $('#languagesTable').DataTable();
        $('.dropify').dropify();

    });
</script>
@endsection