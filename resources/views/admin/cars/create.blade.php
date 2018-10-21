@extends('layouts.adminlayout')

@section('PageHeader')
{{__("general.addNewCarType")}}
@endsection

@section('PageLocation')
@parent

<li>
    <a href="{{url('/admin/cartypes')}}">
        {{__("general.Car Types")}}
    </a>
</li>
<li>
    <a href="#">
        {{__("general.addNewCarType")}}
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
                    <form action="{{url('/admin/cartypes/')}}" enctype="multipart/form-data"  method="POST">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-card-giftcard mr-10"></i>{{__("general.CarTypeInformation")}}</h6>
                                <hr class="light-grey-hr"/>
                                {{ csrf_field() }}

                                <div class="form-body overflow-hide">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-primary pr-10 pull-left">
                                            <input id="languageAvailability" value="1" name="status" type="checkbox" @if(old('status')) checked @endif>
                                            <label for="languageAvailability"> {{__("general.available")}} </label>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="form-group {{ $errors->has('car_type_name') ? ' has-error' : '' }}">
                                        <label class="control-label mb-10" for="exampleInputuname_01" >{{__("general.car_type_name")}}</label>
                                        <div class="input-group">

                                            <input type="text" maxlength="100" class="form-control " id="exampleInputuname_01" name="car_type_name" value="{{old('car_type_name')}}" required />
                                        </div>
                                        @if ($errors->has('car_type_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('car_type_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-mx-auto">
                                <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-translate mr-10"></i>{{__("general.Localization")}}</h6>
                                <hr class="light-grey-hr"/>
                                <div class="panel panel-default card-view">
                                    <div class="panel-wrapper collapse in">

                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-body overflow-hide">
                                                        @foreach($languages as $language)
                                                        <div class="form-group {{ $errors->has('language.'. $language->id) ? ' has-error' : '' }}">
                                                            <label class="control-label mb-10" for="exampleInputuname_01" >{{$language->name}}</label>
                                                            <div class="input-group">

                                                                <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01" name="language[{{$language->id}}]" value="{{old('language.'. $language->id)}}"  />
                                                            </div>
                                                            @if ($errors->has('language.'. $language->id))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('language.'. $language->id) }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-mx-auto">
                                <div class="form-actions mt-10">
                                    <button type="submit" class="btn btn-success mr-10 mb-30">{{__('general.Save')}}</button>
                                </div>
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
    });
</script>
@endsection