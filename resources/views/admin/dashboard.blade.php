@extends('admin.layouts.app')

@section('content')

<!-- container -->
<div class="container-fluid">

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi, welcome back!</h2>
                <p class="mg-b-0">Sales monitoring dashboard.</p>
            </div>
        </div>



    </div>
    <div class="main-container container-fluid">
        <div class="row row-sm">
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="card text-center" style="align-items: center;">
                    <img class="card-img-top w-10" style="height: 150px;width: 137px;" src="https://app.lazyapply.com/assests/linkedin.png" alt="">
                    <div class="card-body">
                        <h4 class="card-title mb-3">LINKDIN</h4>
                        <p class="card-text">740 million members with over 55 million registered companies.
                            The largest social network of professional networking and career development.
                            Make sure you have a complete profile along with a resume uploaded before start applying.
                            Make sure you are logged in to Linkedin before you start applying.</p>
                        <a class="btn btn-primary show_modal" id="linkdin-apply" href="javascript:void(0);">Start Applying</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="card text-center">
                    <img class="card-img-top w-10" src="https://app.lazyapply.com/assests/ziprecruiter.png" alt="">
                    <div class="card-body">
                        <h4 class="card-title mb-3">ZIPRECRUITER</h4>
                        <p class="card-text">110M+ job seekers have used ZipRecruiter.
                            #1 rated hiring site in the U.S.
                            Make sure you have a complete profile along with a resume uploaded, before start applying.
                            Make sure you are logged in to Ziprecruiter before you start applying</p>
                        <a class="btn btn-primary show_modal" id="zaprecruiter-apply" href="javascript:void(0);">Start Applying</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="modal show" id="apply_modal"  aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Please Enter Below Info</h6><button aria-label="Close" class="close hide_modal" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">

                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0">Skills</label>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            <input class="form-control" name="skills" placeholder="Enter your skills" type="text" id="skills">
                        </div>
                    </div>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0">Job Locations</label>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            <input class="form-control" name="job_location" placeholder="Enter your job locations" type="text" id="job_location">
                        </div>
                    </div>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0">Job Count</label>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            <input class="form-control" name="job_count" placeholder="Enter your job count" type="text" id="job_count">
                        </div>
                    </div>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0">Experience</label>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            <input class="form-control" name="experience" placeholder="Enter your experience" type="text" id="experience">
                        </div>
                    </div>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0">Job Type</label>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            <input class="form-control" name="job_type" placeholder="Enter your job type" type="text" id="job_type">
                        </div>
                    </div>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0">Date Posted</label>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            <input class="form-control" name="date_posted"  type="date" id="date_posted">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" type="button">Save changes</button>
                    <button class="btn ripple btn-secondary hide_modal" data-bs-dismiss="modal" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- /Container -->
    @endsection
    @section('scripts')
    <script>
        $(document).ready(function() {
            $(".show_modal").click(function() {
                $("#apply_modal").modal('show');
            });
            $(".hide_modal").click(function() {
                $("#apply_modal").modal('hide');
            });

        });
    </script>
    @endsection
