@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">User</h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ {{isset($user) ? $user->email : 'Add New' }}</span>
            </div>
        </div>
        <a class="btn btn-main-primary ml_auto" style="margin-left: 740px;" href="{{ route('users.index') }}">View User</a>


    </div>
    <!-- breadcrumb -->
    <!--Row-->
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        {{isset($user) ? 'Update': 'Add New' }}
                    </div>


                    <!--  start  -->
                    <form id="user-add-edit" action="{{isset($user) ? route('users.update',$user->id) : route('users.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ isset($user) ? method_field('PUT'):'' }}
                        <div class="pd-30 pd-sm-40 bg-gray-200">
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Name</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="name" placeholder="Enter your name" type="text" value="{{isset($user) ? $user->name : '' }}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Phone</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="phone" placeholder="enter your phone number" type="text" value="{{isset($user) ? $user->phone : '' }}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Email</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="email" placeholder="Enter your email" type="email" value="{{isset($user) ? $user->email : '' }}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Password</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="password" placeholder="Enter your password" type="password" value="">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20 advance_payout">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Gender</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <select name="gender" class="form-control">
                                        <option value="">Select Below</option>
                                        <option value="Male" {{ (isset($user) && $user->gender == 'Male') ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ (isset($user) && $user->gender == 'Female') ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ (isset($user) && $user->gender == 'Other') ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">City</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="city" placeholder="Enter your city" type="text" value="{{isset($user) && !empty($user->city) ? $user->city : ''}}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">State</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="state" placeholder="Enter your state" type="text" value="{{isset($user) && !empty($user->state) ? $user->state : ''}}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Address</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="address" placeholder="Enter your address" type="text" value="{{isset($user) && !empty($user->address) ? $user->address : ''}}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">GitHub Url</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="github_url" placeholder="Enter your github_url" type="text" value="{{isset($user) && !empty($user->github_url) ? $user->github_url : ''}}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Linkdin Url</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="linkdin_url" placeholder="Enter your linkdin_url" type="text" value="{{isset($user) && !empty($user->linkdin_url) ? $user->linkdin_url : ''}}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Zip Recruiter Url</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="ziprecuriter_url" placeholder="Enter your ziprecuriter_url" type="text" value="{{isset($user) && !empty($user->ziprecuriter_url) ? $user->ziprecuriter_url : ''}}">
                                </div>
                            </div>

                            
                            <div class="row row-xs align-items-center mg-b-20 ">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">User profile</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    @if(!empty($user->profile))
                                    <input type="file" class="dropify" name="profile" data-default-file="{{URL::asset('profile')}}/{{$user->profile}}">
                                    @else
                                    <input type="file" class="dropify" name="profile">
                                    @endif
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20 ">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Photo</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    @if(!empty($user->photo))
                                    <input type="file" class="dropify" name="photo" data-default-file="{{URL::asset('profile')}}/{{$user->photo}}">
                                    @else
                                    <input type="file" class="dropify" name="photo">
                                    @endif
                                </div>
                            </div>
                           
                        </div>
                        <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" type="submit">{{isset($user) ? 'Update' : 'Save' }}</button>
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
@if(isset($user))
{!! JsValidator::formRequest('App\Http\Requests\Admin\User\UpdateUserRequest','#user-add-edit') !!}
@else
{!! JsValidator::formRequest('App\Http\Requests\Admin\User\StoreUserRequest','#user-add-edit') !!}
@endif

@endsection