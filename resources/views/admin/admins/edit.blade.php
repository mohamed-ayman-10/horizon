@extends('admin.layouts.master')
@section('title', 'Edit')
@section('main-header', 'Edit')
@section('header', 'Admins')
@section('title_header', 'Edit')
@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.admins.update', $admin->id)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" value="{{old('name', $admin->name)}}" class="form-control"
                                   placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{old('name', $admin->email)}}" class="form-control"
                                   placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password"
                                   autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option {{$admin->status == 1 ? 'selected' : ''}} value="1">Enable</option>
                                <option {{$admin->status == 0 ? 'selected' : ''}} value="0">Disable</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Roles</label>
                            {!! Form::select('roles[]', $roles,$adminRole, array('class' => 'form-control','multiple'))
                                !!}
                        </div>
                        <input type="submit" value="Update" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <!-- DATA TABLE JS-->
    <script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
    <script src="../assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
    <script src="../assets/plugins/datatable/js/jszip.min.js"></script>
    <script src="../assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
    <script src="../assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.html5.min.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.print.min.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.colVis.min.js"></script>
    <script src="../assets/plugins/datatable/dataTables.responsive.min.js"></script>
    <script src="../assets/plugins/datatable/responsive.bootstrap5.min.js"></script>
    <script src="../assets/js/table-data.js"></script>
@endsection
