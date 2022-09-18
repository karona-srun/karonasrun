@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-light">
                    <div class="card-header">Contents List
                        <button type="button" style="width: min-content" class="btn me-2 btn-outline-success float-end btn-create"
                            data-toggle="modal" data-target="#exampleModal">Create</button>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered data-table">
                            <tr>
                                <th>No</th>
                                <th>Content Type</th>
                                <th>Name</th>
                                <th>Youtube Id</th>
                                <th>Youtube Link</th>
                            </tr>
                            @foreach ($contents as $i => $item)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $item->content_type_id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->youtubeId }}</td>
                                    <td>{{ $item->youtubeLink }}</td>
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
                <form id="contentTypeForm" name="contentTypeForm" method="post" class="form-horizontal">
                    
                    <div class="modal-header">
                        <h5 class="modal-title" id="postCrudModal exampleModalLabel">Create Content</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                          <label for="formGroupExampleInput">Content Type</label>
                          <select name="content_type_id" id="content_type" class="form-select form-control">
                          </select>
                      </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                id="formGroupExampleInput" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Youtube Id</label>
                            <input type="text" id="youtubeId" name="youtubeId" class="form-control"
                                id="formGroupExampleInput" placeholder="Enter youtubeId">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Youtube Link</label>
                            <input type="text" id="youtubeLink" name="youtubeLink" class="form-control"
                                id="formGroupExampleInput" placeholder="Enter youtubeLink">
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

            $('body').on('click', '.btn-create', function() {
                $.get("{{ url('/api/content-types') }}", function(data) {
                  var temp = '';
                  var $select = $('#content_type'); 
                  $select.find('option').remove();  
                  $.each(data,function(key, value) 
                  {
                      $select.append('<option value=' + value['id'] + '>' + value['name'] + '</option>');
                  });
                })
            });

            $('#contentTypeForm').submit(function(e) {
                e.preventDefault();
                $('#btn-save').html('Saving...');
                var fd = new FormData(this);

                $.ajax({
                    data: fd,
                    url: "{{ url('/contents-list') }}",
                    processData: false,
                    contentType: false,
                    type: 'post',
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
                $('.btn-create').click();
                $('#exampleModal').modal('toggle');

                var product_id = $(this).data('id');
                $.get("{{ url('/contents-list') }}" + '/' + product_id + '/edit', function(data) {
                    $('.modal-title').text("Edit Content");
                    $('#btn-save').html("Update");
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#youtubeId').val(data.youtubeId);
                    $('#youtubeLink').val(data.youtubeLink);
                })
            });

            $('body').on('click', '.btn-delete', function() {
                var product_id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "{{ url('contents-list') }}" + '/' + product_id,
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
