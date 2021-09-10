@extends('layouts.master')
@section('content')
    @section('css_report')
        <link rel="stylesheet" href="{{ asset('frontend') }}/css/sweet-alert.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/css/normalize.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/css/jquery.mCustomScrollbar.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/app-assets/vendors/css/vendors.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/app-assets/css/components.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/app-assets/css/core/menu/menu-types/vertical-menu.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/app-assets/css/core/colors/palette-gradient.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/app-assets/css/pages/app-invoice.css">
    @endsection
    <div class="card-header">
        <h4 class="card-title">Daily Reports</h4>
    </div>
    <div class="tab-content px-1 pt-1">
        <div role="tabpanel" class="tab-pane active" id="tabLable11" aria-expanded="true" aria-labelledby="baseLable1-tab1">
            <div class="float-right">
                <div class="card invoice-action-wrapper shadow-none border">
                    <div class="card-body">
                        <div class="invoice-action-btn">
                            <button class="btn btn-primary btn-block invoice-print">
                                <span>Print</span>
                            </button>
                        </div>  
                        <div class="invoice-action-btn">
                            <a href="{{ url()->previous() }}" class="btn btn-primary btn-block">Go back</a>
                        </div>
                    </div>
                </div>
            </div>
            <h5 class="text-center"><img alt="" src="{{ asset('frontend') }}/dist/assets/img/gustov.png"  width="100px" height="100px"/>"GUSTOV"</h5>
            <h4 class="text-center">Daily Reports</h4>
            <div class = "content-all"> 
                <div class="form-group">
                    <label for="articulo">Report Date </label>
                    <input type="date" name="date" id="date">
                </div>
                <div class="form-group">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <th width="15%"> Sale ID</th>
                            <th width="15%">Date</th>
                            <th width="15%">Name costumer</th>
                            <th width="15%">Name menu</th>
                            <th width="15%">Quantity</th>
                            <th width="15%">Price</th>
                            </tr>
                        </thead>
                    </table>
                    <div id="permissions_box">
                        <div class="table-responsive">
                            <div id="permissions_checkbox_list">
                            </div>
                            <h3 id="total" name="total">0.00</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js_report')
        <script>
			$(document).ready(function(){
				var permissions_box = $('#permissions_box');
				var permissions_checkbox_list = $('#permissions_checkbox_list');
				permissions_box.hide();
				$('#date').on('change', function(){                     
					valor = $('#date').val();
                    date = new Date(valor);
                    var year = date.getFullYear();
                    var month = date.getMonth();
                    var day = date.getUTCDate();
					permissions_checkbox_list.empty();
					$.ajax({
						url:"/reports",
						method:'get',
						dataType: 'json',
						data:{
							year: year,
                            month: month,
                            day: day,
						}
					}).done(function(data){
                        var subTotal =0;
                        var quantitySubTotal =0;
                        var priceSubTotal=0;
                        var total=0;
                        cont = data.length;
                        for(var i =0;i<cont;i++){
                            permissions_box.show();
                            quantitySubTotal = quantitySubTotal + data[i].quantity;
                            priceSubTotal = priceSubTotal + data[i].price;
                            subTotal= data[i].quantity * data[i].price;
                            total = total + subTotal;
                            $(permissions_checkbox_list).append(
                                '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">'+
                                    '<thead>'+
                                        '<tr>'+
                                            '<td width="15%">'+data[i].id+'</td>'+
                                            '<td width="15%">'+data[i].date+'</td>'+
                                            '<td width="15%">'+data[i].nameCostumer+'</td>'+
                                            '<td width="15%">'+data[i].name+'</td>'+
                                            '<td width="15%">'+data[i].quantity+'</td>'+
                                            '<td width="15%">'+data[i].price+'</td>'+
                                        '</tr>'+
                                    '</thead>'+
                                '</table>'
                            );
                            if(i==cont-1){
                                $("#total").html("Total Bs " + total);
                            }
                        }
					});
				});
			});
	    </script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="{{ asset('frontend') }}/js/modernizr.js"></script>
        <script src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>
        <script src="{{ asset('frontend') }}/js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="{{ asset('frontend') }}/js/sweet-alert.min.js"></script>
        <script src="{{ asset('frontend') }}/app-assets/vendors/js/vendors.min.js"></script>
        <script src="{{ asset('frontend') }}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
        <script src="{{ asset('frontend') }}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
        <script src="{{ asset('frontend') }}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
        <script src="{{ asset('frontend') }}/app-assets/js/core/app-menu.js"></script>
        <script src="{{ asset('frontend') }}/app-assets/js/core/app.js"></script>
        <script src="{{ asset('frontend') }}/app-assets/js/scripts/components.js"></script>
        <script src="{{ asset('frontend') }}/app-assets/js/scripts/footer.js"></script>
        <script src="{{ asset('frontend') }}/app-assets/js/scripts/pages/app-invoice.js"></script>
    @endsection
@endsection