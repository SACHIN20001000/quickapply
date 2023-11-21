@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> Upload Resume</h4>
            </div>
        </div>


    </div>
    <!-- breadcrumb -->
    <!--Row-->
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">



                    <!--  start  -->
                    <form action="{{ route('resume.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="pd-30 pd-sm-40 bg-gray-100">
                            <div class="row row-xs align-items-center mg-b-20">

                                <div class="col-md-12 mg-t-5 mg-md-t-0">


                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Upload</label>
                                            </div>
                                            <div class="col-md-9">

                                                <input type="file" class="dropify" name="resume">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-9">
                                                @if($resume)
                                                <a href="{{$resume->file_path}}" class="btn btn-info" target="_blank">View Resume</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>


                            <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" type="submit">{{isset($global_settings) ? 'Update' : 'Save' }}</button>
                        </div>
                </div>
                </form>
                <!-- form end  -->
            </div>
        </div>
    </div>
    <!-- /row -->
</div>


@endsection
@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script>
    $('.editor').summernote({
        toolbar: [
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['insert', ['link', 'image', 'doc', 'video']],
            ['misc', ['codeview']],
        ],
        height: 400,

    });
    $('.dropify').dropify();
</script>


@endsection