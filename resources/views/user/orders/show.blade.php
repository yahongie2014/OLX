@extends('layouts.userlayout')

@section('PageHeader')

@endsection



@section('content')
@parent
<!-- MAP SEARCH BOX STYLING -->

@include('partials.orders.show', ['order' => $order , 'userType' => USER])
<div id="sa-warning"></div>
@endsection

@if($deliveryAccess != null)
@section('footer')
@parent
<script>
    $(function() {
        "use strict";

        var SweetAlert = function() {};

        //examples
        SweetAlert.prototype.init = function() {

            //Warning Message
            $('#sa-warning,.sa-warning').on('click',function(e){
                swal({
                    title: "{{__('general.youWantLogIn?')}}",
                    text: "{{__('general.youHaveToLogInToAcceptOrRejectOrder')}}",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f0c541",
                    confirmButtonText: "{{__('general.sign in')}}",
                    cancelButtonText: "{{__('general.Cancel')}}",
                    closeOnConfirm: false
                }, function(){
                    window.location.href = "{{url('/login')}}";
                });
                return false;
            });
        },
            //init
            $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert;

        $.SweetAlert.init();

        $(document).scroll(function() {
            if($(window).scrollTop() + $(window).height() > $(document).height() - (.1 * $(document).height())) {
                $('#sa-warning').trigger('click');
            }/*else if($(document).height() > $(window).height())        {
                if($(window).scrollTop() >= $(document).height() - $(window).height()){
                    $('#sa-warning').trigger('click');
                }
            }*/
        });
        //$('#orderDetailsDiv').bind('scroll',chk_scroll);
    });
    /*function chk_scroll(e)
    {
        var elem = $(e.currentTarget);
        if (elem[0].scrollHeight - elem.scrollTop() == elem.outerHeight())
        {
            $('#sa-warning').trigger('click');
        }

    }
*/
</script>
@endsection

@endif