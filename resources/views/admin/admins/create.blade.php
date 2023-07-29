@extends('admin.layouts.master')
@section('title', 'Create')
@section('main-header', 'Create')
@section('header', 'Admins')
@section('title_header', 'Create')
@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{route('admin.admins.store')}}" method="post" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="new-password">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Roles</label>
                                <select name="roles[]" class="form-control" multiple>
                                    @foreach($roles as $role)
                                        <option value="{{$role}}">{{$role}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="submit" value="Create" class="btn btn-primary">
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
