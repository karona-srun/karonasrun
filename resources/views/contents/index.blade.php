@extends('layouts.master')

@section('content')
    {{-- <div class="container">
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
                <form id="contentForm" name="contentForm" method="post" class="form-horizontal">
                    
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

            $('#contentForm').submit(function(e) {
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
                        $('#contentForm').trigger("reset");
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
    </script> --}}
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="card card-md">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="h3">Videos List.</h2>
                                <p class="m-0 text-muted">Videos List is design for show video list and read, create, update,
                                    and delete operations.</p>
                            </div>
                            <div class="col-auto">
                                <a href="#" class="btn btn-primary btn-create" data-bs-toggle="modal"
                                    data-bs-target="#modal-video">
                                    <i class="ti ti-playlist-add"></i>
                                    Create new
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <p>Videos List</p>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox"
                                                aria-label="Select all invoices"></th>
                                        <th>No</th>
                                        <th>Title Video</th>
                                        <th>Video Category</th>
                                        <th>Youtube ID</th>
                                        <th>Youtube Link</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contents as $i => $item)
                                        <tr>
                                            <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                    aria-label="Select invoice"></td>
                                            <td><span class="text-muted">{{ ++$i }}</span></td>
                                            <td>
                                                {{ $item->name }}
                                            </td>
                                            <td>
                                                {{ $item->contentType->name }}
                                            </td>
                                            <td>{{ $item->youtubeId }}</td>
                                            <td>{{ $item->youtubeLink }}</td>
                                            <td>
                                                <button type="button" class="btn btn-outline-primary btn-icon"
                                                    data-bs-toggle="modal" data-bs-target="#modal-video"
                                                    data-id="{{ $item->id }}">
                                                    <i class="ti ti-zoom-exclamation"></i>
                                                </button>
                                                <button type="button" class="btn btn-warning btn-edit btn-icon"
                                                    data-bs-toggle="modal" data-bs-target="#modal-video"
                                                    data-id="{{ $item->id }}">
                                                    <i class="ti ti-pencil"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-icon btn-delete"
                                                data-id="{{ $item->id }}" data-bs-toggle="modal"
                                                data-bs-target="#modal-danger">
                                                    <i class="ti ti-playlist-x"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            <p class="m-0 text-muted">Showing <span>1</span> to <span>{{ $contents->count() }}</span> of
                                <span>{{ $contents->total() }}</span> entries</p>
                            @if ($contents->lastPage() > 1)
                                <ul class="pagination m-0 ms-auto">
                                    @if ($contents->currentPage() != 1 && $contents->lastPage() >= 5)
                                        <li class="page-item">
                                            <a href="{{ $contents->url($contents->url(1)) }}" aria-label="Previous"
                                                class="page-link">
                                                <span aria-hidden="true">First</span>
                                            </a>
                                        </li>
                                    @endif
                                    {{-- @if ($contents->currentPage() != 1) --}}
                                    <li class="page-item">
                                        <a href="{{ $contents->url($contents->currentPage() - 1) }}" class="page-link me-2"
                                            aria-label="Previous">
                                            <i class="ti ti-chevron-left mr-5"
                                                style="position: absolute; margin-left: -20px;"></i>
                                            <span aria-hidden="true">Prev</span>
                                        </a>
                                    </li>
                                    {{-- @endif --}}
                                    @for ($i = max($contents->currentPage() - 2, 1); $i <= min(max($contents->currentPage() - 2, 1) + 4, $contents->lastPage()); $i++)
                                        @if ($contents->currentPage() == $i)
                                            <li class="active page-item">
                                            @else
                                            <li>
                                        @endif
                                        <a href="{{ $contents->url($i) }}" class="page-link">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    {{-- @if ($contents->currentPage() != $contents->lastPage()) --}}
                                    <li class="page-item">
                                        <a href="{{ $contents->url($contents->currentPage() + 1) }}" class="page-link"
                                            aria-label="Next">
                                            <span aria-hidden="true">Next</span>
                                            <i class="ti ti-chevron-right" style="position: absolute"></i>
                                        </a>
                                    </li>
                                    {{-- @endif --}}
                                    @if ($contents->currentPage() != $contents->lastPage() && $contents->lastPage() >= 5)
                                        <li class="page-item">
                                            <a href="{{ $contents->url($contents->lastPage()) }}" class="page-link"
                                                aria-label="Next">
                                                <span aria-hidden="true">Last</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modals')
    <div class="modal modal-blur fade" id="modal-video" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="contentForm" name="contentForm" method="post" class="form-horizontal">
                    <input type="hidden" id="id" name="id">
                    <div class="modal-header">
                        <h5 class="modal-title">New Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Videos Categories</label>
                            <select type="text" name="content_type_id" id="content_type" class="form-select"
                                placeholder="Select a video cagetory">
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Your name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Youtube Id</label>
                            <input type="text" class="form-control" id="youtubeId" name="youtubeId"
                                placeholder="Your youtube id">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Youtube Link</label>
                            <input type="text" class="form-control" id="youtubeLink" name="youtubeLink"
                                placeholder="Your youtube link">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            <i class="ti ti-file-check me-2"></i>
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 9v2m0 4v.01" />
                        <path
                            d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                    <h3>Are you sure?</h3>
                    <div class="text-muted">Do you really want to remove video? What you've done cannot be undone.
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                    Cancel
                                </a></div>
                            <div class="col"><a href="#" class="btn btn-danger btn-modal-delete w-100"
                                    data-bs-dismiss="modal">
                                    Delete
                                </a></div>
                        </div>
                    </div>
                </div>
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

            $('body').on('click','.btn-reload', function(){
                location.reload();
            })

            $('body').on('click', '.btn-create', function() {
                $('.modal-title').text("New Video");
                $.get("{{ url('/api/content-types') }}", function(data) {
                    var temp = '';
                    var $select = $('#content_type');
                    $select.find('option').remove();
                    $.each(data, function(key, value) {
                        $select.append('<option value=' + value['id'] + '>' + value[
                            'name'] + '</option>');
                    });
                })
            });

            $('#contentForm').submit(function(e) {
                e.preventDefault();
                var fd = new FormData(this);

                $.ajax({
                    data: fd,
                    url: "{{ url('/videos') }}",
                    processData: false,
                    contentType: false,
                    type: 'post',
                    success: function(data) {
                        $('#contentForm').trigger("reset");
                        $('#modal-success').modal('toggle');
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });

            $('body').on('click', '.btn-edit', function() {
                $('.btn-create').click();
                $('#modal-video').modal('toggle');

                var id = $(this).data('id');
                $.get("{{ url('/videos') }}" + '/' + id + '/edit', function(data) {
                    $('.modal-title').text("Edit Video");
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#youtubeId').val(data.youtubeId);
                    $('#youtubeLink').val(data.youtubeLink);
                })
            });
            
            var _id;
            $('body').on('click', '.btn-delete', function() {
                _id = $(this).data("id");
            });

            $('body').on('click', '.btn-modal-delete', function() {

                $.ajax({
                    type: "DELETE",
                    url: "{{ url('videos') }}" + '/' + _id,
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
