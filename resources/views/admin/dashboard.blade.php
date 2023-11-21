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
                        <a class="btn btn-primary" id="linkdin-apply" href="javascript:void(0);">Start Applying</a>
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
                        <a class="btn btn-primary" id="zaprecruiter-apply" href="javascript:void(0);">Start Applying</a>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- /Container -->
    @endsection