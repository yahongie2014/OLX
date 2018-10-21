@extends('layouts.adminlayout')

@section('PageHeader')
{{__("general.editLanguage")}}
@endsection

@section('PageLocation')
@parent

<li>
    <a href="{{url('/admin/languages')}}">
        {{__("general.Languages")}}
    </a>
</li>
<li>
    <a href="#">
        {{__("general.editLanguage")}}
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
                        <div class="col-sm-12">
                            <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-translate mr-10"></i>{{__("general.LanguageInformation")}}</h6>
                            <hr class="light-grey-hr"/>
                            <form action="{{url('/admin/languages/' . $language->id)}}" enctype="multipart/form-data"  method="POST">
                                {{ method_field('PATCH') }}
                                {{ csrf_field() }}
                                <input type="hidden" name="language_id" value="{{$language->id}}"/>
                                <div class="form-body overflow-hide">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-primary pr-10 pull-left">
                                            <input id="languageAvailability" value="1" name="languageAvailability" type="checkbox" @if(old('languageAvailability')) checked @elseif($language->status == LANGUAGE_ACTIVE)  checked @endif>
                                            <label for="languageAvailability"> {{__("general.available")}} </label>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <!--<div class="form-group">
                                        <div class="checkbox checkbox-primary pr-10 pull-left">
                                            <input id="languageDefault"  value="1" name="languageDefault" type="checkbox" @if(old('languageDefault')) checked @elseif($language->default == DEFAULT_LANGUAGE) @endif >
                                            <label for="languageDefault"> {{__("general.defaultLanguage")}} </label>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>-->

                                    <div class="form-group {{ $errors->has('language_name') ? ' has-error' : '' }}">
                                        <label class="control-label mb-10" for="exampleInputuname_01" >{{__("general.language_name")}}</label>
                                        <div class="input-group">

                                            <input type="text" class="form-control " id="exampleInputuname_01" name="language_name" value=@if(old('language_name')) "{{old('language_name')}}" @else "{{$language->name}}" @endif required />
                                        </div>
                                        @if ($errors->has('language_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('language_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('language_symbol') ? ' has-error' : '' }}">
                                        <label class="control-label mb-10" for="exampleInputuname_01">{{__("general.language_symbol")}}</label>
                                        <div class="input-group">

                                            <input type="text" maxlength="2" class="form-control " id="exampleInputuname_01" name="language_symbol" value=@if(old('language_symbol')) "{{old('language_symbol')}}" @else "{{$language->symbol}}" @endif required />
                                        </div>
                                        @if ($errors->has('language_symbol'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('language_symbol') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('language_direction') ? ' has-error' : '' }}">
                                        <div class="radio-list">
                                            <label class="control-label mb-10"> {{__("general.languageDirection")}} </label>
                                            <div class="radio-inline pl-0">
                                                <span class="radio radio-success">
                                                    <input type="radio" name="language_direction" id="radio_5" value="ltr" @if($language->direction == 'ltr') checked @endif>
                                                    <label for="radio_5">{{__("general.ltr")}}</label>
                                                </span>
                                            </div>
                                            <div class="radio-inline">
                                                <span class="radio radio-success">
                                                    <input type="radio" name="language_direction" id="radio_6" value="rtl" @if($language->direction == 'rtl') checked @endif>
                                                    <label for="radio_6">{{__("general.rtl")}}</label>
                                                </span>
                                            </div>
                                            @if ($errors->has('language_direction'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('language_direction') }}</strong>
                                            </span>
                                            @endif
                                        </div>
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