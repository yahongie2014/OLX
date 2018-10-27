<div class="container-fluid pt-25">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissable alert-style-1">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="zmdi zmdi-alert-circle-o"></i>{{ __("general.error check fields") }}
        </div>
@endif
<!-- Row -->
    <div class="row">
        <div class="col-lg-9 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pb-0">
                        <div class="tab-struct custom-tab-1">
                            <ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
                                <li class="active" role="presentation">
                                    <a data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8"
                                       aria-expanded="false">
                                        <span>{{__("general.Profile")}}</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent_8">
                                <div id="profile_8" class="tab-pane fade active in" role="tabpanel">
                                    <!-- Row -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="">
                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body pa-0">
                                                        <div class="col-sm-12 col-xs-12">
                                                            <div class="form-wrap">
                                                                <form method="POST"
                                                                      action="{{ url('admin/users/admin/') }}">
                                                                    {{ csrf_field() }}
                                                                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }} ">
                                                                        <label class="control-label mb-10 brand-text-white"
                                                                               for="exampleInputName_1">{{__("general.Full Name")}}</label>
                                                                        <input type="text" name="name"
                                                                               class="form-control"
                                                                               id="exampleInputName_1"
                                                                               placeholder="{{__('general.Full Name Ex')}}"
                                                                               value="{{ old('name') }}" required>
                                                                        @if ($errors->has('name'))
                                                                            <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                                                        <label class="control-label mb-10 brand-text-white"
                                                                               for="exampleInputEmail_2">{{__("general.Email")}}</label>
                                                                        <input type="email" name="email"
                                                                               value="{{ old('email') }}"
                                                                               class="form-control"
                                                                               id="exampleInputEmail_2"
                                                                               placeholder="{{__('general.Email Ex')}}"
                                                                               required>
                                                                        @if ($errors->has('email'))
                                                                            <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                                                        <label class="pull-left control-label mb-10 brand-text-white"
                                                                               for="exampleInputpwd_2">{{__("general.Password")}}</label>
                                                                        <input type="password" name="password"
                                                                               class="form-control"
                                                                               id="exampleInputpwd_2" required>
                                                                        @if ($errors->has('password'))
                                                                            <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                                        <label class="pull-left control-label mb-10 brand-text-white"
                                                                               for="exampleInputpwd_3">{{__("general.Confirm Password")}}</label>
                                                                        <input type="password"
                                                                               name="password_confirmation"
                                                                               class="form-control"
                                                                               id="exampleInputpwd_3" required>
                                                                        @if ($errors->has('password_confirmation'))
                                                                            <span class="help-block">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                                                        <label class="control-label mb-10 brand-text-white"
                                                                               for="exampleInputName_1">{{__("general.Phone")}}</label>
                                                                        <input type="text" name="phone" maxlength="15"
                                                                               class="form-control allownumericwithoutdecimal"
                                                                               id="exampleInputName_1"
                                                                               placeholder="{{__('general.Phone Ex')}}"
                                                                               value="{{ old('phone') }}" required>
                                                                        @if ($errors->has('phone'))
                                                                            <span class="help-block">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                                                        @endif
                                                                    </div>

                                                                    <div class="form-group {{ $errors->has('language_id') ? ' has-error' : '' }}">
                                                                        <label class="control-label mb-10 brand-text-white">{{__("general.Language")}}</label>
                                                                        <select class="form-control select2"
                                                                                name="language_id">
                                                                            <option>{{__("general.Select")}}</option>
                                                                            @foreach($languages as $language)
                                                                                <option value="{{$language->id}}"
                                                                                        @if( old("language_id") == $language->id ) selected @endif>{{$language->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @if ($errors->has('language_id'))
                                                                            <span class="help-block">
                                                    <strong>{{ $errors->first('language_id') }}</strong>
                                                </span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group {{ $errors->has('country_id') ? ' has-error' : '' }}">
                                                                        <label class="control-label mb-10 brand-text-white">{{__("general.Country")}}</label>
                                                                        <select class="form-control select2"
                                                                                name="country_id" id="country_id"
                                                                                required>
                                                                            <option>{{__("general.Select")}}</option>
                                                                            @foreach($countries as $country)
                                                                                <option value="{{$country->id}}"
                                                                                        @if( old("country_id") == $country->id ) selected @endif>{{$country->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @if ($errors->has('country_id'))
                                                                            <span class="help-block">
                                                    <strong>{{ $errors->first('country_id') }}</strong>
                                                </span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group {{ $errors->has('city_id') ? ' has-error' : '' }}">
                                                                        <label class="control-label mb-10 brand-text-white">{{__("general.City")}}</label>
                                                                        <select class="form-control select2"
                                                                                name="city_id" id="city_id" required>
                                                                            <option>{{__("general.Select")}}</option>

                                                                        </select>
                                                                        @if ($errors->has('city_id'))
                                                                            <span class="help-block">
                                                    <strong>{{ $errors->first('city_id') }}</strong>
                                                </span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group {{ $errors->has('is_admin') ? ' has-error' : '' }}">
                                                                        <input hidden="hidden" name="is_admin"
                                                                               value="1">
                                                                        @if ($errors->has('is_admin'))
                                                                            <span class="help-block">
                                                    <strong>{{ $errors->first('is_admin') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">

                                                                            @if ($errors->has('image'))
                                                                                <span class="help-block"
                                                                                      style="color : red">
                                                                                    <strong>{{ $errors->first('image') }}</strong>
                                                                                </span>
                                                                            @endif

                                                                            <div class="mt-40">
                                                                                <input type="file"
                                                                                       name="image"
                                                                                       id="image"
                                                                                       class="dropify"
                                                                                       data-default-file=""
                                                                                       accept=".jpg,.jpeg,.png"/>
                                                                            </div>
                                                                            <label class="control-label mb-10"
                                                                                   for="exampleInputuname_01">{{__("general.profileImage")}}</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group text-center">
                                                                        <button type="submit"
                                                                                class="btn btn-info btn-success btn-rounded">{{__("general.Sign Up")}}</button>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- /Row -->


</div>

@section('footer')
    @parent
    <script>
        $(document).ready(function () {
            /* Select2 Init*/
            /* Select2 Init*/
            $(".select2").select2();

            /* Basic Init*/
            $('.dropify').dropify();

            // allow user only to type numbers only
            $(".allownumericwithoutdecimal").on("keypress keyup blur", function (event) {
                $(this).val($(this).val().replace(/[^\d].+/, ""));
                if ((event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });

            $("#country_id").change(function () {
                var postData = {_token: "{{ csrf_token() }}", country_id: $(this).val()}
                $.ajax({
                    url: '{{url("/user/country/cities")}}',
                    type: 'GET',
                    data: postData,
                    dataType: 'JSON',
                    success: function (result) {
                        //console.log(data);
                        if (result.status) {
                            $("#city_id option").remove();
                            $.each(result.result, function (key, value) {
                                $('#city_id')
                                    .append($("<option></option>")
                                        .attr("value", value.id)
                                        .text(value.name));
                            });


                        }

                    }
                });
            })

        })
    </script>



@endsection