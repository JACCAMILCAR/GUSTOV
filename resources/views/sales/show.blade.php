@extends('layouts.master')
@section('content')
@section('css_sale')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/app-assets/css/pages/app-invoice.css">
@endsection
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <section class="invoice-view-wrapper">
                    <div class="row">
                        <div class="col-xl-9 col-md-8 col-12">
                            <div class="card invoice-print-area">
                                <div class="card-content">
                                    <div class="col-xs-6">
                                        <h5 class="text-center"><img alt="" src="{{ asset('frontend') }}/dist/assets/img/gustov.png"  width="100px" height="100px"/> "GUSTOV"</h5>
                                        <div class="col-xs-3 text-center">
                                        <h2>RECEIPT <h6><small>#{{$sales[0]->idReceipt}} - Control code: {{$sales[0]->controlCode}}</small></h6></h2>
                                    </div>
                                </div>
                                <div class="row invoice-info">
                                    <div class="col-6 mt-1">
                                        <div class="mb-1">
                                            <h6 class="invoice-from"><span>Name Costumer</span></h6>
                                        </div>
                                        <div class="mb-1">
                                            <h6><span>NIT</span></h6>
                                        </div>
                                        <div class="mb-1">
                                            <h6><span>Phone Costumer</span></h6>
                                        </div>
                                        <div class="mb-1">
                                            <h6><span>Date</span></h6>
                                        </div>
                                    </div>
                                    <div class="col-6 mt-1">
                                        <div class="mb-1">
                                            <span>{{$sales[0]->nameCostumer}}</span>
                                        </div>
                                        <div class="mb-1">
                                            <span>{{$sales[0]->nit}}</span>
                                        </div>
                                        <div class="mb-1">
                                            <span>{{$sales[0]->phoneCostumer}}</span>
                                        </div>
                                        <div class="mb-1">
                                            <span>{{$sales[0]->date}}</span>
                                        </div>
                                    </div>
                                </div>
                                <label for="">DETALLES</label>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Producto</th>
                                                <th scope="col">Descripción</th>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Precio Unitario</th>
                                                <th scope="col" class="text-center">Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total = 0.0?>
                                            @foreach($sales as $sale)
                                                <tr>
                                                    <td>{{$sale->name}}-{{$sale->descriptionMenu}}</td>
                                                    <td>{{$sale->description}}</td>
                                                    <td class="text-center">{{$sale->quantity}}</td>
                                                    <td class="text-center">{{$sale->price}}</td>
                                                    <?php $subtotal = $sale->quantity* $sale->price; $total = $total + $subtotal;?>
                                                    <td class="text-center">{{$subtotal}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4"><strong>Total</strong></td>
                                                <td class="text-center"><strong> BS {{$total}}</strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="row invoice-info text-center">
                                    <div class="col-6 mt-1">
                                        <div class="mb-1">
                                            <span>..........................................</span>
                                    </div>
                                    <h6 class="invoice-from">Entregue Conforme</h6>                       
                                    <div class="mb-1">
                                        <small>Nombre: {{Auth::user()->name}}</small>
                                    </div>
                                </div>
                                <div class="col-6 mt-1">
                                    <div class="mb-1">
                                        <span>..........................................</span>
                                    </div>
                                    <h6 class="invoice-to">Recibí Conforme</h6>
                                    <div class="mb-1">
                                        <small>Nombre: {{$sales[0]->nameCostumer}}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4 col-12">
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
            </div>
        </section>
    </div> 
</div>
</div>
@section('js_sale')
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