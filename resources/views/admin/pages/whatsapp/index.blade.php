@extends('admin.layouts.master')
@section('title', 'WhatsApp')
@section('main-header', 'WhatsApp')
@section('title_header', 'WhatsApp')
@section('header', 'Setting')
@section('content')
    <div class="card">
        <div class="card-header">
            <a data-bs-toggle="modal" data-bs-target="#update" class="btn btn-info">Update</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <td class="w-25">Number</td>
                    <td class="w-75">{{$data->number}}</td>
                </tr>
                <tr>
                    <td class="w-25">Title</td>
                    <td class="w-75">{{$data->title}}</td>
                </tr>
                <tr>
                    <td class="w-25">Description</td>
                    <td class="w-75">{{$data->description}}</td>
                </tr>
                <tr>
                    <td class="w-25">Button</td>
                    <td class="w-75">{{$data->button}}</td>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    {{-- Update Setting --}}
    <div class="modal fade" id="update">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Update Setting</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('admin.whatsapp.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Number</label>
                            <input type="number" name="number" class="form-control"
                                   value="{{old('number', $data->number)}}" placeholder="Number">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Title In Arabic</label>
                            <input type="text" name="title_ar" class="form-control"
                                   value="{{old('title_ar', $data->getTranslation('title', 'ar'))}}"
                                   placeholder="Title In Arabic">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Title In English</label>
                            <input type="text" name="title_en" class="form-control"
                                   value="{{old('title_en', $data->getTranslation('title', 'en'))}}"
                                   placeholder="Title In English">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description In Arabic</label>
                            <input type="text" name="description_ar" class="form-control"
                                   value="{{old('description_ar', $data->getTranslation('description', 'ar'))}}"
                                   placeholder="Description In Arabic">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description In English</label>
                            <input type="text" name="description_en" class="form-control"
                                   value="{{old('description_en', $data->getTranslation('description', 'en'))}}"
                                   placeholder="Description In English">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Button In Arabic</label>
                            <input type="text" name="button_ar" class="form-control"
                                   value="{{old('button_ar', $data->getTranslation('button', 'ar'))}}"
                                   placeholder="Button In Arabic">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Button In English</label>
                            <input type="text" name="button_en" class="form-control"
                                   value="{{old('button_en', $data->getTranslation('button', 'en'))}}"
                                   placeholder="Button In English">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let form = document.getElementById('filterForm');
        let select = document.getElementById('filterSelect');

        select.addEventListener('change', function () {
            form.submit();
        });
    </script>
@endsection
