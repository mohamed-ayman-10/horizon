@extends('admin.layouts.master')
@section('title', 'Admins')
@section('main-header', 'Admins')
@section('header', 'Admins')
@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <form action="{{route('admin.roles.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Permissions</label>
                    <hr>
                    <div class="d-flex flex-wrap gap-4">
                        @foreach($permissions as $permission)
                            <label class="form-label">
                                <input type="checkbox" name="permission[]" value="{{$permission->id}}" class="">
                                {{$permission->name}} <span class="ms-4">|</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
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
