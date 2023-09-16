@extends('layouts.master')
@section('css')
    <style>
    .imagePreview{
        margin: 10px 0 15px 0;
        width: 15em;
        height:23em;
    }
    </style>
@endsection
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="card card-sm">
                    <div class="card-stamp card-stamp-lg">
                        <div class="card-stamp-icon bg-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M5 11a7 7 0 0 1 14 0v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-7">
                                </path>
                                <line x1="10" y1="10" x2="10.01" y2="10"></line>
                                <line x1="14" y1="10" x2="14.01" y2="10"></line>
                                <path d="M10 14a3.5 3.5 0 0 0 4 0"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <h3 class="h1">Create Book Categories</h3>
                                <div class="markdown text-muted">Book Categories is design for Book Categories list
                                    and
                                    read, create, update,
                                    and delete operations.
                                </div>
                                <div class="mt-3">
                                    <a href="{{ url('/sievphow/book-category') }}" class="btn btn-primary">
                                        <i class="ti ti-chevron-left"></i>
                                        Back
                                    </a>
                                </div>
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
                        <form action="{{ url('sievphow/book-category') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <p>Create Book Categories</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 offset-md-3 col-sm-12">
                                        <div class="form-group mb-3 ">
                                            <label for="" class="form-label required">Upload Image <small>with preview</small></label>
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2H_e0XRh3E2b7yW5k6cJshkUJ13jb334tdtCi69gKZUYtm8adWBB9L3g8Upo_b_WTMaA&usqp=CAU" class="imagePreview" alt="Image Preview" id="imagePreview">
                                            <input type="file" name="image" class="form-control" accept=".jpeg, .png, .jpg" id="imageInput">
                                        </div>
                                        <div class="form-group mb-3 ">
                                            <label class="form-label required">Name Khmer</label>
                                            <div>
                                                <input type="text" name="name_kh" id="name_kh" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group mb-3 ">
                                            <label class="form-label required">Name English</label>
                                            <div>
                                                <input type="text" name="name_en" id="name_en" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group mb-3 ">
                                            <label class="form-label required">Status</label>
                                            <div>
                                                <select type="text" name="status" id="select-tags status"
                                                    class="form-select select-tags select-option"
                                                    placeholder="Select a cagetory status">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i
                                        class="ti ti-square-rounded-check me-2"></i> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            
            $('#imageInput').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#imagePreview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

        });
    </script>
@endsection
