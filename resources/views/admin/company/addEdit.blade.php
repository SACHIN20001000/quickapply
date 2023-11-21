@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Compaines</h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ {{isset($company) ? $company->name : 'Add New' }}</span>
            </div>
        </div>
        <a class="btn btn-main-primary ml_auto" style="margin-left: 740px;" href="{{ route('company.index') }}">View Company</a>


    </div>
    <!-- breadcrumb -->
    <!--Row-->
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        {{isset($company) ? 'Update # '.$company->id : 'Add New' }}
                    </div>


                    <!--  start  -->
                    <form  id="user-add-edit" action="{{isset($company) ? route('company.update',$company->id) : route('company.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ isset($company) ? method_field('PUT'):'' }}
                        <div class="pd-30 pd-sm-40 bg-gray-200">
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Name</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="name"  placeholder="Enter your name" type="text" value="{{isset($company) ? $company->name : '' }}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Type</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <select name="type"  class="form-control">
                                      <option value="">Choose Below..</option>
                                      @if($insurances->count())
                                      @foreach($insurances as $insurance)
                                      <option value="{{$insurance->id}}" {{ (isset($company) && $insurance->id == $company->type) ? 'selected' : '' }}>{{$insurance->name}}</option>
                                      @endforeach
                                      @endif
                                     
                              </select>
                                </div>
                            </div>
                          
                            <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" type="submit">{{isset($company) ? 'Update' : 'Save' }}</button>
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
@if(isset($company))
{!! JsValidator::formRequest('App\Http\Requests\Admin\Company\UpdateCompanyRequest','#user-add-edit') !!}
@else
{!! JsValidator::formRequest('App\Http\Requests\Admin\Company\StoreCompanyRequest','#user-add-edit') !!}
@endif

@endsection


