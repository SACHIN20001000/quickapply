@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Group</h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ {{isset($group) ? $group->name : 'Add New' }}</span>
            </div>
        </div>
        <a class="btn btn-main-primary ml_auto" style="margin-left: 740px;" href="{{ route('group.index') }}">View Group</a>


    </div>
    <!-- breadcrumb -->
    <!--Row-->
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        {{isset($group) ? 'Update # '.$group->id : 'Add New' }}
                    </div>


                    <!--  start  -->
                    <form id="user-add-edit" action="{{isset($group) ? route('group.update',$group->id) : route('group.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ isset($group) ? method_field('PUT'):'' }}
                        <div class="pd-30 pd-sm-40 bg-gray-200">
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Name</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="name" placeholder="Enter your name" type="text" value="{{isset($group) ? $group->name : '' }}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Select User</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <select name="users_id[]" multiple="multiple" class="form-control">
                                        <option value="">Select</option>
                                        @if(isset($users) && $users->count())
                                        @foreach($users as $user)
                                        <?php
                                        $groupUsers = isset($group) ? explode(',', $group->users_id) : [];
                                        ?>
                                        <option value="{{$user->id}}" {{ in_array($user->id, $groupUsers) ? 'selected' : '' }}>{{$user->name}}</option>



                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>


                            <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" type="submit">{{isset($group) ? 'Update' : 'Save' }}</button>
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

{!! JsValidator::formRequest('App\Http\Requests\Admin\Group\StoreCommunicationGroupRequest','#user-add-edit') !!}

<script type="text/javascript">
    $(document).ready(function() {
        $("select").select2();
    });
</script>
@endsection