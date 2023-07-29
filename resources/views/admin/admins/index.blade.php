@extends('admin.layouts.master')
@section('title', 'Admins')
@section('main-header', 'Admins')
@section('header', 'Admins')
@section('title_header', 'Admins')
@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('admin.admins.create')}}" class="btn btn-primary">Create</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center text-nowrap border-bottom" id="basic-datatable">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">Name</th>
                                <th class="wd-15p border-bottom-0">Email</th>
                                <th class="wd-15p border-bottom-0">Status</th>
                                <th class="wd-15p border-bottom-0">Role</th>
                                <th class="wd-15p border-bottom-0">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $index=>$item)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>
                                        @if($item->status == 1)
                                            <span class="badge bg-success px-2 pb-1">Enable</span>
                                        @else
                                            <span class="badge bg-danger px-2 pb-1">Disable</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($item->getRoleNames()))
                                            @foreach ($item->getRoleNames() as $v)
                                                <label class="badge bg-success px-2 pb-1">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                            <a class="btn btn-success btn-sm" href="{{route('admin.admins.edit', $item->id)}}"><i class="fa fa-edit"></i></a>
                                            <button form="deleteForm" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>

                                            <form id="deleteForm" action="{{route('admin.admins.destroy', $item->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                            </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
