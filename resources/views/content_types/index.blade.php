@extends('layouts.master')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="card card-md">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="h3">Video Categories List.</h2>
                                <p class="m-0 text-muted">Video Categories List is design for show video list and read,
                                    create, update, and delete operations.</p>
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-primary btn-create" data-bs-toggle="modal"
                                    data-bs-target="#modal-video-category">
                                    <i class="ti ti-playlist-add"></i>
                                    Create new
                                </button>
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
                            <p>Video Categories</p>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox"
                                                aria-label="Select all invoices"></th>
                                        <th>No</th>
                                        <th>Categories</th>
                                        <th>Image</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contents as $i => $item)
                                        <tr>
                                            <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                    aria-label="Select invoice"></td>
                                            <td>{{ ++$i }}</td>
                                            <td><span class="text-muted">{{ $item->name }}</span></td>
                                            <td>
                                                <img src="{{ $item->image }}" alt="" srcset=""
                                                    class="avatar me-2">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-icon btn-edit"
                                                    data-bs-toggle="modal" data-bs-target="#modal-video-category"
                                                    data-id="{{ $item->id }}">
                                                    <i class="ti ti-pencil"></i>
                                                </button>
                                                <button type="button"
                                                    class="btn btn-primary btn-danger btn-icon btn-delete"
                                                    data-id="{{ $item->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#modal-danger"><i class="ti ti-playlist-x"></i>
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
    <div class="modal modal-blur fade" id="modal-video-category" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="contentTypeForm" name="contentTypeForm" method="post" class="form-horizontal"
                    enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">New Video Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3 align-items-end">
                            <input type="hidden" name="id" id="id" class="form-control">
                            <div class="col-auto">
                                <img id="preview-image-before-upload" class="avatar avatar-upload rounded" data-url=""
                                    src="https://icons.veryicon.com/png/o/miscellaneous/standard-general-linear-icon/plus-60.png"
                                    alt="preview" style="height: 64px; width: 64px;">
                                <input type="file" id="image" required name="image"
                                    class="form-control form-control-file" accept="image/*" id="exampleFormControlFile1"
                                    style="display: none">
                            </div>
                            <div class="col">
                                <label class="form-label">Name</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto" id="btn-save" data-bs-dismiss="modal">
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
                    <div class="text-muted">Do you really want to remove video category? What you've done cannot be undone.
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
            $('.avatar-upload').click(function() {
                $('#image').trigger('click');
            })

            $('#image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

            $('body').on('click', '.avatar-upload', function() {
                var url = $('#image').text();
            });

            $('body').on('click', '.btn-reload', function() {
                location.reload();
            })

            $('body').on('click', '.btn-create', function() {
                $('#contentTypeForm').trigger("reset");
                $('.modal-title').text("New Video Category");
            });

            $('#contentTypeForm').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    data: formData,
                    url: "{{ url('videos-categories') }}",
                    type: "POST",
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#contentTypeForm').trigger("reset");
                        $('#modal-success').modal('toggle');
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });

            $('body').on('click', '.btn-edit', function() {
                var id = $(this).data('id');
                $.get("{{ url('/videos-categories') }}" + '/' + id + '/edit', function(data) {
                    $('.modal-title').text("Edit Video Category");
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#image').text(data.image);
                    $('#preview-image-before-upload').attr('src', data.image);
                })
            });

            var _id;
            $('body').on('click', '.btn-delete', function() {
                _id = $(this).data("id");
            });

            $('body').on('click', '.btn-modal-delete', function() {

                $.ajax({
                    type: "DELETE",
                    url: "{{ url('videos-categories') }}" + '/' + _id,
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
