@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-light">
                    <div class="card-header">Content Types List
                        <button type="button" style="width: min-content" class="btn me-2 btn-outline-success float-end"
                            data-toggle="modal" data-target="#exampleModal">Create</button>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered data-table">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($contents as $i => $item)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <img src="{{ $item->image }}" alt="" srcset=""
                                            class=" img-fluid img-thumbnail" width="100px">
                                    </td>
                                    <td>
                                        <div class="row mx-2">
                                            <button type="button" style="width: auto"
                                                class="btn me-2 btn-outline-primary btn-edit"
                                                data-id="{{ $item->id }}">Edit</button>
                                            <button type="button" style="width: auto"
                                                class="btn btn-outline-danger btn-delete"
                                                data-id="{{ $item->id }}">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="contentTypeForm" name="contentTypeForm" method="post" class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="postCrudModal exampleModalLabel">Create Content Type</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                id="formGroupExampleInput" placeholder="Enter name">
                        </div>
                        <div class="form-group mt-3">
                            <label for="exampleFormControlFile1">File input image</label>
                            <input type="file" id="image" name="image" class="form-control form-control-file"
                                accept="image/*" id="exampleFormControlFile1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn-save">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#contentTypeForm').submit(function(e) {
                e.preventDefault();
                $('#btn-save').html('Saving...');
                let formData = new FormData(this);

                $.ajax({
                    data: formData,
                    url: "{{ url('content-types-list') }}",
                    type: "POST",
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#contentTypeForm').trigger("reset");
                        $('#btn-save').html('Save');
                        location.reload();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#btn-save').html('Save');
                    }
                });
            });

            $('body').on('click', '.btn-edit', function() {
                $('#exampleModal').modal('toggle');

                var product_id = $(this).data('id');
                $.get("{{ url('content-types-list') }}" + '/' + product_id + '/edit', function(data) {
                    $('.modal-title').text("Edit Content Type");
                    $('#btn-save').html("Update");
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#image').text(data.image);
                })
            });

            $('body').on('click', '.btn-delete', function() {

                var product_id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "{{ url('content-types-list') }}" + '/' + product_id,
                    success: function(data) {
                        location.reload();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });
        });
    </script>
@endsection
