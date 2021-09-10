@extends('layouts.master')
@section('content')
    @if(Session::has('Message'))
        <div class="alert alert-danger" role="alert">
            {{   Session::get('Message')   }}
        </div>
    @endif
    <div class="row py-lg-2">
        <div class="col-md-6">
            <h3>Add Menu</h3>
        </div>
        <div class="col-md-6">
            <a href="/menus/create" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">Add New Menu</a>
        </div>
    </div>
    <div class="card-header">
        <h6>Menu List</h6>
    </div>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>State</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>State</th>
                                    <th>Actions</th>
                                </tr>                                            
                            </tfoot>
                            <tbody>
                                @foreach($menus as $menu)
                                <tr > 
                                    <td>{{$menu['name']}}</td>
                                    <td>{{$menu['price']}}</td>
                                    <td>{{$menu['description']}}</td>
                                    @if($menu->state==1)
                                        <td><p class="p-2 bg-dark text-white">Active</p></td>
                                    @else
                                        <td><p class="p-2 bg-danger text-white">Inactive</p></td>
                                    @endif
                                    <td>
                                        <a href="/menus/{{ $menu['id'] }}/edit"><i class="fa fa-edit"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#deleteModal" data-menuid="{{$menu['id']}}"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach                                        
                            </tbody>
                        </table>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body">Select "delete" if you really want to delete the menu.</div>
                <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form method="POST" action="">
                    @method('DELETE')
                    @csrf
                    <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Delete</a>
                </form>
                </div>
            </div>
            </div>
    </div>
@section('js_user')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('frontend') }}/dist/assets/demo/chart-area-demo.js"></script>
    <script src="{{ asset('frontend') }}/dist/assets/demo/chart-bar-demo.js"></script>
    <script src="{{ asset('frontend') }}/dist/assets/demo/datatables-demo.js"></script>
    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var user_id = button.data('menuid') 
            var modal = $(this)
            modal.find('form').attr('action','/menus/' + user_id);
        })
    </script>
@endsection
@endsection