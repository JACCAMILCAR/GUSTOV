@extends('layouts.master')
@section('content')
    <div class="row py-lg-2">
        <div class="col-md-6">
            <h2>Add User</h2>
        </div>
        <div class="col-md-6">
            <a href="/users/create" class="btn btn-success btn-lg float-md-right" role="button" aria-pressed="true">Add New User</a>
        </div>
    </div>
    <div class="card-header">
        <i class="fas fa-table mr-1"> User List</i>
    </div>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Name</th>
                        <th>email</th>
                        <th>Actions</th>
                </tr>                                            
            </tfoot>
            <tbody>
                @foreach($users as $user)
                    <tr > 
                        <td>{{$user['name']}}</td>
                        <td>{{$user['email']}}</td>
                        <td>
                            <a href="/users/{{ $user['id'] }}/edit"><i class="fa fa-edit"></i></a>
                            <a href="#" data-toggle="modal" data-target="#deleteModal" data-userid="{{$user['id']}}"><i class="fas fa-trash-alt"></i></a>
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
                <div class="modal-body">Select "delete" if you really want to delete the user.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="POST" action="">
                        @method('DELETE')
                        @csrf
                        <a class="btn btn-success" onclick="$(this).closest('form').submit();">Delete</a>
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
            var user_id = button.data('userid') 
            var modal = $(this)
            modal.find('form').attr('action','/users/' + user_id);
        })
    </script>
@endsection
@endsection