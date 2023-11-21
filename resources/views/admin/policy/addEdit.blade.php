@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Policy</h4>
                @include('admin.policy.common')
            </div>
        </div>


        <div class="d-flex my-xl-auto right-content">
            <div class="pe-1 mb-xl-0">
                <div class="btn-group dropdown">
                    <a class="btn btn-main-primary" href="{{ route('policy.index') }}">View Policy</a>
                </div>
            </div>

        </div>

    </div>
    <style type="text/css">
        .background {
            margin: 10px 5px;
        }

        .main-form-group {
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgb(0 0 0 / 10%);
            background: #e8eaf3;
            border: 0px solid #e3e8f7;
        }

        .main-form-group .form-label {
            font-size: 12px;
            text-align: left;
            font-weight: 700;
            color: #031b4e;
        }

        .select2-container--default .select2-selection--single {
            border-color: #ebebff;
            height: 30px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            font-size: 12px !important;
            line-height: 1 !important;
            padding-left: 8px;
            color: #6e7f96;
        }

        .main-form-group .form-control {
            color: #6e7f96;
        }

        .formgroup-wrapper .form-control {
            height: 30px !important;
            font-size: 12px;
            padding: 8px;
            border: 1px solid #ebebff;
        }

        .card-body {
            padding: 10px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            width: 18px;
            height: 30px;
        }

        label[for="file-up"] {
            text-align: center;
            display: block;
        }

        label[for="file-up"] svg {
            width: 24px;
            cursor: pointer;
        }

        input#file-up {
            display: none;
        }

        a.remove_us svg {
            width: 12px;
            height: 12px;
            fill: #dd0909;
            transform: translateY(-4px) translateX(-3px);
            cursor: pointer;
        }

        a.view_files,
        a.remove_us {
            cursor: pointer !important;
        }

        a.view_files svg {
            width: 18px;
            stroke: #363636;
            cursor: pointer;
        }
    </style>
    <!-- breadcrumb -->
    <!--Row-->
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        {{isset($policy) ? 'Update # '.$policy->id : 'Add New' }}
                    </div>


                    <!--  start  -->
                    <form id="user-add-edit" action="{{isset($policy) ? route('policy.update',$policy->id) : route('policy.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ isset($policy) ? method_field('PUT'):'' }}
                        <div class="pd-30 pd-sm-40 bg-gray-400">

                            <div class="container general-details">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center ">
                                            <div class="col-sm-2">
                                                <div>General Details</div>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="row main-row">
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Reference Type</label>
                                                                <select name="user_type" class="form-control reference_type">
                                                                    <option value="">Select</option>
                                                                    @if(isset($roles) && $roles->count())
                                                                    @foreach($roles as $role)
                                                                    <option value="{{$role->id}}" {{ (isset($policy->user_type) && $role->id == $policy->user_type) ? 'Selected' : '' }}>{{$role->name }}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label "> Reference Name</label>
                                                                <select name="user_id" class="form-control  dynamic-user-id">
                                                                    <option value="">Select</option>
                                                                    @if(isset($users) && $users->count())
                                                                    @foreach($users as $user)
                                                                    <option value="{{$user->id}}" {{ (isset($policy->user_id) && $user->id == $policy->user_id) ? 'selected' : '' }}>{{$user->name}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">INSURANCE TYPE </label>
                                                                <select name="insurance_id" class="select2 form-control" id="insurance_id">
                                                                    <option value="">Select Below</option>
                                                                    @if($insurances->count())
                                                                    @foreach($insurances as $insurance)
                                                                    <option value="{{$insurance->id}}" {{ (isset($policy) && $insurance->id == $policy->insurance_id) ? 'selected' : '' }}>{{$insurance->name}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Insurer</label>
                                                                <select name="company_id" class="select2 form-control common- " id="company_id">
                                                                    <option value="">Select Below</option>
                                                                    @if($companies->count())
                                                                    @foreach($companies as $company)
                                                                    <option value="{{$company->id}}" {{ (isset($policy) && $company->id == $policy->company_id) ? 'selected' : '' }}>{{$company->name}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">PRODUCT</label>
                                                                <select name="product_id" class="select2 form-control" id="product_id">
                                                                    <option value="">Select Below</option>
                                                                    @if(isset($products) && $products->count())
                                                                    @foreach($products as $product)
                                                                    <option value="{{$product->id}}" {{ (isset($policy) && $product->id == $policy->product_id) ? 'selected' : '' }}>{{$product->name}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Sub Product</label>
                                                                <select name="subproduct_id" class="select2 form-control" id="subproduct_id">
                                                                    <option value="">Select Below</option>
                                                                    @if(isset($subProducts) && $subProducts->count())
                                                                    @foreach($subProducts as $subProduct)
                                                                    <option value="{{$subProduct->id}}" data-id="{{$subProduct->name}}" {{ (isset($policy) && $subProduct->id == $policy->subproduct_id) ? 'selected' : '' }}>{{$subProduct->name}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row main-row">
                                                    <div>
                                                        <div class="row row-xs formgroup-wrapper">


                                                            <div class="col-lg-6  text-center ">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">TYPE OF BUSINESS</label>
                                                                    <select name="bussiness_type" class="form-control" id="bussiness_type">
                                                                        <option value="">Select</option>
                                                                        @if((isset($policy)) && $policy->subProduct->name == 'TRAVEL')
                                                                        <option value="New" {{ (isset($policy) && "New" == $policy->bussiness_type) ? 'selected' : '' }}>New</option>
                                                                        <option value="Extension" {{ (isset($policy) && "Extension" == $policy->bussiness_type) ? 'selected' : '' }}>Extension</option>

                                                                        @elseif((isset($policy)) && $policy->subProduct->name == 'HEALTH')
                                                                        <option value="Fresh" {{ (isset($policy) && "Fresh" == $policy->bussiness_type) ? 'selected' : '' }}>Fresh</option>
                                                                        <option value="Port" {{ (isset($policy) && "Port" == $policy->bussiness_type) ? 'selected' : '' }}>Port</option>
                                                                        <option value="Renewal" {{ (isset($policy) && "Renewal" == $policy->bussiness_type) ? 'selected' : '' }}>Renewal</option>
                                                                        @elseif((isset($policy)) && $policy->subProduct->name == 'FIRE')
                                                                        <option value="New" {{ (isset($policy) && $policy->bussiness_type === 'New') ? 'selected' : '' }}>New</option>
                                                                        <option value="Rollover" {{ (isset($policy) && $policy->bussiness_type === 'Rollover') ? 'selected' : '' }}>Rollover</option>
                                                                        <option value="Renewal" {{ (isset($policy) && $policy->bussiness_type === 'Renewal') ? 'selected' : '' }}>Renewal</option>

                                                                        @elseif((isset($policy)) && $policy->subProduct->name == 'WC')
                                                                        <option value="New" {{ (isset($policy) && $policy->bussiness_type === 'New') ? 'selected' : '' }}>New</option>
                                                                        <option value="Rollover" {{ (isset($policy) && $policy->bussiness_type === 'Rollover') ? 'selected' : '' }}>Rollover</option>
                                                                        <option value="Renewal" {{ (isset($policy) && $policy->bussiness_type === 'Renewal') ? 'selected' : '' }}>Renewal</option>
                                                                        <option value="Enhancement" {{ (isset($policy) && $policy->bussiness_type === 'Enhancement') ? 'selected' : '' }}>Enhancement</option>
                                                                        @elseif((isset($policy)) && $policy->subProduct->name == 'MARINE')
                                                                        <option value="New" {{ (isset($policy) && $policy->bussiness_type === 'New') ? 'selected' : '' }}>New</option>
                                                                        <option value="Rollover" {{ (isset($policy) && $policy->bussiness_type === 'Rollover') ? 'selected' : '' }}>Rollover</option>
                                                                        <option value="Renewal" {{ (isset($policy) && $policy->bussiness_type === 'Renewal') ? 'selected' : '' }}>Renewal</option>
                                                                        <option value="Enhancement" {{ (isset($policy) && $policy->bussiness_type === 'Enhancement') ? 'selected' : '' }}>Enhancement</option>
                                                                        @else
                                                                        <option value="New" {{ (isset($policy) && "New" == $policy->bussiness_type) ? 'selected' : '' }}>New</option>
                                                                        <option value="Rollover" {{ (isset($policy) && "Rollover" == $policy->bussiness_type) ? 'selected' : '' }}>Rollover</option>
                                                                        <option value="Renewal" {{ (isset($policy) && "Renewal" == $policy->bussiness_type) ? 'selected' : '' }}>Renewal</option>
                                                                        <option value="Used" {{ (isset($policy) && "Used" == $policy->bussiness_type) ? 'selected' : '' }}>Used</option>

                                                                        @endif

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label "> TRANSACTION TYPE</label>
                                                                    <select name="mis_transaction_type" class="form-control">
                                                                        <option value="">Select</option>
                                                                        @if((isset($policy)) && $policy->subProduct->name == 'TRAVEL')
                                                                        <option value="New" {{ (isset($policy) && "New" == $policy->bussiness_type) ? 'selected' : '' }}>New</option>
                                                                        <option value="Extension" {{ (isset($policy) && "Extension" == $policy->bussiness_type) ? 'selected' : '' }}>Extension</option>

                                                                        @elseif((isset($policy)) && $policy->subProduct->name == 'HEALTH')
                                                                        <option value="Base" {{ (isset($policy->mis_transaction_type) && $policy->mis_transaction_type === 'Base') ? 'selected' : '' }}>Base</option>
                                                                        <option value="Topup" {{ (isset($policy->mis_transaction_type) && $policy->mis_transaction_type === 'Topup') ? 'selected' : '' }}>Topup</option>
                                                                        <option value="Critical" {{ (isset($policy->mis_transaction_type) && $policy->mis_transaction_type === 'Critical') ? 'selected' : '' }}>Critical</option>
                                                                        <option value="PA" {{ (isset($policy->mis_transaction_type) && $policy->mis_transaction_type === 'PA') ? 'selected' : '' }}>PA</option>
                                                                        <option value="Others" {{ (isset($policy->mis_transaction_type) && $policy->mis_transaction_type === 'Others') ? 'selected' : '' }}>Others</option>
                                                                        <option value="Endorsement" {{ (isset($policy->mis_transaction_type) && $policy->mis_transaction_type === 'Endorsement') ? 'selected' : '' }}>Endorsement</option>
                                                                        @elseif((isset($policy)) && $policy->subProduct->name == 'FIRE')
                                                                        <option value="Laghu" {{ (isset($policy->mis_transaction_type) && $policy->mis_transaction_type === 'Laghu') ? 'selected' : '' }}>Laghu</option>
                                                                        <option value="Sooksham" {{ (isset($policy->mis_transaction_type) && $policy->mis_transaction_type === 'Sooksham') ? 'selected' : '' }}>Sooksham</option>
                                                                        <option value="Package" {{ (isset($policy->mis_transaction_type) && $policy->mis_transaction_type === 'Package') ? 'selected' : '' }}>Package</option>
                                                                        <option value="Others" {{ (isset($policy->mis_transaction_type) && $policy->mis_transaction_type === 'Others') ? 'selected' : '' }}>Others</option>
                                                                        <option value="Endorsement" {{ (isset($policy->mis_transaction_type) && $policy->mis_transaction_type === 'Endorsement') ? 'selected' : '' }}>Endorsement</option>

                                                                        @elseif((isset($policy)) && $policy->subProduct->name == 'WC')
                                                                        <option value="Package" {{ (isset($policy->mis_transaction_type) && 'Package' == $policy->mis_transaction_type) ? 'selected' : '' }}>Package</option>
                                                                        <option value="SOAD" {{ (isset($policy->mis_transaction_type) && 'SOAD' == $policy->mis_transaction_type) ? 'selected' : '' }}>SOAD</option>
                                                                        <option value="TP" {{ (isset($policy->mis_transaction_type) && 'TP' == $policy->mis_transaction_type) ? 'selected' : '' }}>TP</option>
                                                                        <option value="Endorsement" {{ (isset($policy->mis_transaction_type) && 'Endorsement' == $policy->mis_transaction_type) ? 'selected' : '' }}>Endorsement</option>
                                                                        @elseif((isset($policy)) && $policy->subProduct->name == 'MARINE')
                                                                        <option value="RAIL" {{ (isset($policy->mis_transaction_type) && $policy->mis_transaction_type === 'RAIL') ? 'selected' : '' }}>RAIL</option>
                                                                        <option value="ROAD" {{ (isset($policy->mis_transaction_type) && $policy->mis_transaction_type === 'ROAD') ? 'selected' : '' }}>ROAD</option>
                                                                        <option value="AIR" {{ (isset($policy->mis_transaction_type) && $policy->mis_transaction_type === 'AIR') ? 'selected' : '' }}>AIR</option>
                                                                        <option value="SEA" {{ (isset($policy->mis_transaction_type) && $policy->mis_transaction_type === 'SEA') ? 'selected' : '' }}>SEA</option>
                                                                        <option value="COURIER" {{ (isset($policy->mis_transaction_type) && $policy->mis_transaction_type === 'COURIER') ? 'selected' : '' }}>COURIER</option>
                                                                        <option value="ALL" {{ (isset($policy->mis_transaction_type) && $policy->mis_transaction_type === 'ALL') ? 'selected' : '' }}>ALL</option>
                                                                        @else
                                                                        <option value="Package" {{ (isset($policy->mis_transaction_type) && 'Package' == $policy->mis_transaction_type) ? 'selected' : '' }}>Package</option>
                                                                        <option value="SOAD" {{ (isset($policy->mis_transaction_type) && 'SOAD' == $policy->mis_transaction_type) ? 'selected' : '' }}>SOAD</option>
                                                                        <option value="TP" {{ (isset($policy->mis_transaction_type) && 'TP' == $policy->mis_transaction_type) ? 'selected' : '' }}>TP</option>
                                                                        <option value="Endorsement" {{ (isset($policy->mis_transaction_type) && 'Endorsement' == $policy->mis_transaction_type) ? 'selected' : '' }}>Endorsement</option>

                                                                        @endif

                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>


                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Policy Holder Name</label>
                                                                <input class="form-control" name="holder_name" type="text" value="{{isset($policy) ? $policy->holder_name : '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Policy Holder Phone </label>
                                                                <input class="form-control" name="phone" type="number" id="phoneInput" value="{{ isset($policy) ? $policy->phone : '' }}">
                                                                <span id="phoneError" class="text-danger"></span>


                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Policy Holder Email</label>
                                                                <input class="form-control" name="email" type="email" value="{{isset($policy) ? $policy->email : '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">CHANNEL NAME</label>
                                                                <select name="channel_name" class="select2 form-control common- " id="channel_name">
                                                                    <option value="">Select Below</option>
                                                                    @if($channels->count())
                                                                    @foreach($channels as $channel)
                                                                    <option value="{{$channel->name}}" {{ (isset($policy) && $channel->name == $policy->channel_name) ? 'selected' : '' }}>{{$channel->name}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-12">

                                                            <div class="main-form-group background">
                                                                <label class="form-label">Remarks
                                                                </label>
                                                                <textarea name="remarks" class="form-control " cols="30" rows="60" id="remarks">{{isset($policy) ? $policy->remarks : ''}}</textarea>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>




                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container liability-details">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center ">
                                            <div class="col-sm-2">
                                                <div>Details</div>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="row main-row">
                                                    <div class="row row-xs formgroup-wrapper">

                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">COVERAGES REQUIRED
                                                                </label>
                                                                <input type="text" name="measures_taken_after_loss" value="{{isset($policy) ? $policy->measures_taken_after_loss : ''}}" class="form-control feild" id="measures_taken_after_loss">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="main-form-group background">

                                                                <p class="mg-t-10 mg-b-1">Sum Insured</p>
                                                                <input type="text" name="sum_insured" value="{{isset($policy) ? $policy->sum_insured : ''}}" class="form-control " id="sum_insured">
                                                            </div>
                                                        </div>


                                                    </div>


                                                </div>





                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container vehicle-details">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center ">
                                            <div class="col-sm-2">
                                                <div>Vehicle Details</div>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="row main-row">


                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Vehicle Reg No </label>
                                                                <input type="text" name="reg_no" value="{{isset($policy) ? $policy->reg_no : ''}}" class="form-control " id="reg_no">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Make</label>
                                                                <select name="make" id="make" class="form-control ">
                                                                    <option value="">Select</option>
                                                                    @if($make->count())
                                                                    @foreach($make as $makes)
                                                                    <option value="{{$makes->id}}" {{ (isset($policy) && $makes->id == $policy->make) ? 'selected' : '' }}>{{$makes->name}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Model</label>
                                                                <select name="model" class="select2 form-control " id="model">
                                                                    <option value="">Select Below</option>
                                                                    @if(isset($model) && $model->count() && isset($policy) )
                                                                    @foreach($model as $models)
                                                                    <option value="{{$models->id}}" {{ (isset($policy) && $models->id == $policy->model) ? 'selected' : '' }}>{{$models->name}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Variant</label>
                                                                <select name="varriant" class="select2 form-control " id="varriant">
                                                                    <option value="">Select </option>
                                                                    @if(isset($varients) && $varients->count())
                                                                    @foreach($varients as $varriant)
                                                                    @if($varriant->type == 'varriant')
                                                                    <option value="{{$varriant->name}}" {{ (isset($policy) && $varriant->name == $policy->varriant) ? 'selected' : '' }}>{{$varriant->name}}</option>
                                                                    @endif
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">

                                                        <div class="col-lg-3  text-center vehicle-sub-class">
                                                            <div class="main-form-group background vehicle-sub-class">
                                                                <label class="form-label">Vehicle Sub Class </label>
                                                                <select name="vehicle_cc" class="select2 form-control" id="cc">
                                                                    <option value="">Select Below</option>
                                                                    <option value="tractor" {{ (isset($policy) && $policy->cc === 'tractor') ? 'selected' : '' }}>Tractor</option>
                                                                    <option value="ambulance" {{ (isset($policy) && $policy->cc === 'ambulance') ? 'selected' : '' }}>Ambulance</option>
                                                                    <option value="excavator" {{ (isset($policy) && $policy->cc === 'excavator') ? 'selected' : '' }}>Excavator</option>
                                                                    <option value="crane" {{ (isset($policy) && $policy->cc === 'crane') ? 'selected' : '' }}>Crane</option>
                                                                    <option value="others" {{ (isset($policy) && $policy->cc === 'others') ? 'selected' : '' }}>Others</option>
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center cc-kw">
                                                            <div class="main-form-group background cc-kw">
                                                                <label class="form-label">CC/KW </label>
                                                                <select name="cc" class="select2 form-control " id="cc">
                                                                    <option value="">Select Below</option>
                                                                    @if(isset($varients) && $varients->count())
                                                                    @foreach($varients as $varient)
                                                                    @if($varient->type == 'cc')
                                                                    <option value="{{$varient->name}}" {{ (isset($policy) && $varient->name == $policy->cc) ? 'selected' : '' }}>{{$varient->name}}</option>
                                                                    @endif
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center gvw">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">GVW </label>
                                                                <select name="gvw" class="form-control " id="gvw">
                                                                    <option value="">Select</option>
                                                                    <option value=">2500" {{ (isset($policy) && ">2500" == $policy->gvw) ? 'selected' : '' }}>>2500</option>
                                                                    <option value="2501 to 3500" {{ (isset($policy) && "2501 to 3500" == $policy->gvw) ? 'selected' : '' }}>2501 to 3500</option>
                                                                    <option value="3501 to 7500" {{ (isset($policy) && "3501 to 7500" == $policy->gvw) ? 'selected' : '' }}>3501 to 7500</option>
                                                                    <option value="7501 to 12000" {{ (isset($policy) && "7501 to 12000" == $policy->gvw) ? 'selected' : '' }}>7501 to 12000</option>
                                                                    <option value="12001 to 20000" {{ (isset($policy) && "12001 to 20000" == $policy->gvw) ? 'selected' : '' }}>12001 to 20000</option>
                                                                    <option value="20000 to 25000" {{ (isset($policy) && "20000 to 25000" == $policy->gvw) ? 'selected' : '' }}>20000 to 25000</option>
                                                                    <option value="25000 to 40000" {{ (isset($policy) && "25000 to 40000" == $policy->gvw) ? 'selected' : '' }}>25000 to 40000</option>
                                                                    <option value=">40000" {{ (isset($policy) && ">40000" == $policy->gvw) ? 'selected' : '' }}>>40000</option>
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Fuel</label>
                                                                <select name="fuel" class="select2 form-control " id="fuel">
                                                                    <option value="">Select Below</option>
                                                                    @if(isset($varients) && $varients->count())
                                                                    @foreach($varients as $varient)
                                                                    @if($varient->type == 'fuel')
                                                                    <option value="{{$varient->name}}" {{ (isset($policy) && $varient->name == $policy->fuel) ? 'selected' : '' }}>{{$varient->name}}</option>
                                                                    @endif
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background seating">
                                                                <label class="form-label">Seating Capacity</label>
                                                                <select name="seating_capacity" class="select2 form-control " id="seating">
                                                                    <option value="">Select Below</option>
                                                                    @if(isset($varients) && $varients->count())
                                                                    @foreach($varients as $varient)
                                                                    @if($varient->type == 'seating')
                                                                    <option value="{{$varient->name}}" {{ (isset($policy) && $varient->name == $policy->seating_capacity) ? 'selected' : '' }}>{{$varient->name}}</option>
                                                                    @endif
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="main-form-group background seating-pcv">
                                                                <label class="form-label">Pax carrying limit</label>
                                                                <input type="number" name="seating_capacity" value="{{isset($policy) ? $policy->seating_capacity : ''}}" class="form-control " id="seating_capacity">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">MFR YEAR</label>
                                                                <Select name="mfr_year" id="mfr_year" class="form-control ">
                                                                    <option value="">Select</option>
                                                                    <option value="2023" {{ (isset($policy) && "2023" == $policy->mfr_year) ? 'selected' : '' }}>2023</option>
                                                                    <option value="2022" {{ (isset($policy) && "2022" == $policy->mfr_year) ? 'selected' : '' }}>2022</option>
                                                                    <option value="2021" {{ (isset($policy) && "2021" == $policy->mfr_year) ? 'selected' : '' }}>2021</option>
                                                                    <option value="2020" {{ (isset($policy) && "2020" == $policy->mfr_year) ? 'selected' : '' }}>2020</option>
                                                                    <option value="2019" {{ (isset($policy) && "2019" == $policy->mfr_year) ? 'selected' : '' }}>2019</option>
                                                                    <option value="2018" {{ (isset($policy) && "2018" == $policy->mfr_year) ? 'selected' : '' }}>2018</option>
                                                                    <option value="2017" {{ (isset($policy) && "2017" == $policy->mfr_year) ? 'selected' : '' }}>2017</option>
                                                                    <option value="2016" {{ (isset($policy) && "2016" == $policy->mfr_year) ? 'selected' : '' }}>2016</option>
                                                                    <option value="2015" {{ (isset($policy) && "2015" == $policy->mfr_year) ? 'selected' : '' }}>2015</option>
                                                                    <option value="2014" {{ (isset($policy) && "2014" == $policy->mfr_year) ? 'selected' : '' }}>2014</option>
                                                                    <option value="2013" {{ (isset($policy) && "2013" == $policy->mfr_year) ? 'selected' : '' }}>2013</option>
                                                                    <option value="2012" {{ (isset($policy) && "2012" == $policy->mfr_year) ? 'selected' : '' }}>2012</option>
                                                                    <option value="2011" {{ (isset($policy) && "2011" == $policy->mfr_year) ? 'selected' : '' }}>2011</option>
                                                                    <option value="2010" {{ (isset($policy) && "2010" == $policy->mfr_year) ? 'selected' : '' }}>2010</option>
                                                                    <option value="2009" {{ (isset($policy) && "2009" == $policy->mfr_year) ? 'selected' : '' }}>2009</option>
                                                                    <option value="2008" {{ (isset($policy) && "2008" == $policy->mfr_year) ? 'selected' : '' }}>2008</option>
                                                                    <option value="2007" {{ (isset($policy) && "2007" == $policy->mfr_year) ? 'selected' : '' }}>2007</option>
                                                                    <option value="2006" {{ (isset($policy) && "2006" == $policy->mfr_year) ? 'selected' : '' }}>2006</option>
                                                                    <option value="2005" {{ (isset($policy) && "2005" == $policy->mfr_year) ? 'selected' : '' }}>2005</option>
                                                                    <option value="2004" {{ (isset($policy) && "2004" == $policy->mfr_year) ? 'selected' : '' }}>2004</option>
                                                                    <option value="2003" {{ (isset($policy) && "2003" == $policy->mfr_year) ? 'selected' : '' }}>2003</option>
                                                                    <option value="2002" {{ (isset($policy) && "2002" == $policy->mfr_year) ? 'selected' : '' }}>2002</option>
                                                                    <option value="2001" {{ (isset($policy) && "2001" == $policy->mfr_year) ? 'selected' : '' }}>2001</option>
                                                                    <option value="2000" {{ (isset($policy) && "2000" == $policy->mfr_year) ? 'selected' : '' }}>2000</option>
                                                                    <option value="1999" {{ (isset($policy) && "1999" == $policy->mfr_year) ? 'selected' : '' }}>1999</option>
                                                                    <option value="1998" {{ (isset($policy) && "1998" == $policy->mfr_year) ? 'selected' : '' }}>1998</option>
                                                                    <option value="1997" {{ (isset($policy) && "1997" == $policy->mfr_year) ? 'selected' : '' }}>1997</option>
                                                                    <option value="1996" {{ (isset($policy) && "1996" == $policy->mfr_year) ? 'selected' : '' }}>1996</option>
                                                                    <option value="1995" {{ (isset($policy) && "1995" == $policy->mfr_year) ? 'selected' : '' }}>1995</option>
                                                                </Select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>





                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container motor-policy-details">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center ">
                                            <div class="col-sm-2">
                                                <div>Policy Details</div>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="row main-row">


                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">POLICY NO </label>
                                                                <input type="text" name="policy_no" value="{{isset($policy) ? $policy->policy_no : ''}}" class="form-control " id="policy_no">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Eligible NCB</label>
                                                                <select name="ncb_in_existing_policy" id="ncb_in_existing_policy" class="form-control ">
                                                                    <option value="">Select</option>
                                                                    <option value="0" {{ (isset($policy) && "0" == $policy->ncb_in_existing_policy) ? 'selected' : '' }}>0</option>
                                                                    <option value="20" {{ (isset($policy) && "20" == $policy->ncb_in_existing_policy) ? 'selected' : '' }}>20</option>
                                                                    <option value="25" {{ (isset($policy) && "25" == $policy->ncb_in_existing_policy) ? 'selected' : '' }}>25</option>
                                                                    <option value="35" {{ (isset($policy) && "35" == $policy->ncb_in_existing_policy) ? 'selected' : '' }}>35</option>
                                                                    <option value="45" {{ (isset($policy) && "45" == $policy->ncb_in_existing_policy) ? 'selected' : '' }}>45</option>
                                                                    <option value="50" {{ (isset($policy) && "50" == $policy->ncb_in_existing_policy) ? 'selected' : '' }}>50</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">POLICY START DATE</label>
                                                                <input type="date" name="start_date" value="{{isset($policy) ? $policy->start_date : ''}}" class="form-control start_date" id="start_date">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Policy Expiry Date</label>
                                                                <input type="date" name="expiry_date" value="{{isset($policy) ? $policy->expiry_date : ''}}" class="form-control expiry_date" id="expiry_date">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">IDV/Sum insured</label>
                                                                <input type="number" name="sum_insured" value="{{isset($policy) ? $policy->sum_insured : ''}}" class="form-control" id="sum_insured">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">OD Premium</label>
                                                                <input type="number" name="od_premium" onkeyup="netPremium()" value="{{isset($policy) ? $policy->od_premium : ''}}" class="form-control " id="od_premium">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Add On Premium</label>
                                                                <input type="number" name="add_on_premium" onkeyup="netPremium()" value="{{isset($policy) ? $policy->add_on_premium : ''}}" class="form-control " id="add_on_premium">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">TP Premium</label>

                                                                <input type="number" name="tp_premium" onkeyup="netPremium()" value="{{isset($policy) ? $policy->tp_premium : ''}}" class="form-control " id="tp_premium">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">PA+OTHERS</label>
                                                                <input type="number" name="others" value="{{isset($policy) ? $policy->others : ''}}" onkeyup="netPremium()" class="form-control " id="others">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Net Premium</label>
                                                                <input type="number" name="net_premium" onkeyup="grossPremium()" value="{{isset($policy) ? $policy->net_premium : ''}}" class="form-control net_premium">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">GST</label>
                                                                <input type="number" name="gst" onkeyup="grossPremium()" value="{{isset($policy) ? $policy->gst : ''}}" class="form-control gst">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">GROSS PREMIUM
                                                                </label>
                                                                <input type="number" name="gross_premium" value="{{isset($policy) ? $policy->gross_premium : ''}}" class="form-control gross_premium ">

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>





                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container non-motor-policy-details">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center ">
                                            <div class="col-sm-2">
                                                <div>Policy Details</div>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="row main-row">
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">POLICY NO
                                                                </label>
                                                                <input type="text" name="policy_no_normal" value="{{isset($policy) ? $policy->policy_no : ''}}" class="form-control common- " id="policy_no">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">POLICY START DATE</label>
                                                                <input type="date" name="start_date_normal" value="{{isset($policy) ? $policy->start_date : ''}}" class="form-control start_date" id="start_date">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Policy Expiry Date</label>
                                                                <input type="date" name="expiry_date_normal" value="{{isset($policy) ? $policy->expiry_date : ''}}" class="form-control expiry_date" id="expiry_date">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Net Premium</label>
                                                                <input type="number" name="net_premium_normal" onkeyup="grossFirePremium()" value="{{isset($policy) ? $policy->net_premium : ''}}" class="form-control net_premium gross_net_premium">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">GST</label>
                                                                <input type="number" name="gst_normal" onkeyup="grossFirePremium()" value="{{isset($policy) ? $policy->gst : ''}}" class="form-control gst gross_gst">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label "> GROSS PREMIUM
                                                                </label>
                                                                <input type="number" name="gross_premium_normal" value="{{isset($policy) ? $policy->gross_premium : ''}}" class="form-control gross_premium grossFirePremium">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>





                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container health-section">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table card-table table-striped table-vcenter text-nowrap mb-0 dataTable no-footer">
                                                    <thead>
                                                        <th>MEMBER NAME</th>
                                                        <th>DOB</th>
                                                        <th>AGE</th>
                                                        <th>RELATION</th>
                                                        <th>SUM INSURED</th>
                                                        <th>PED</th>
                                                        <th>Hx HISTORY</th>
                                                        <th>UPLOAD</th>
                                                        <th>
                                                            <div class="btn-info btn add-health">Add</div>
                                                        </th>
                                                    </thead>
                                                    <tbody class="health-body">
                                                        @if(isset($policy->health_type) && !empty($policy->health_type))

                                                        <?php
                                                        $health_type = json_decode($policy->health_type);
                                                        ?>
                                                        @foreach($health_type->health_name as $key=> $name)

                                                        <tr>
                                                            <td><input type="text" class="form-control" name="health_name[]" value="{{$name??''}}"></td>

                                                            <td><input type="date" class="form-control" name="health_dob[]" value="{{$health_type->health_dob[$key]??''}}"></td>

                                                            <td><input type="text" class="form-control" name="health_age[]" value="{{$health_type->health_age[$key]??''}}"></td>
                                                            <td><input type="text" class="form-control" name="health_relation[]" value="{{$health_type->health_relation[$key]??''}}"></td>
                                                            <td><input type="text" class="form-control" name="health_sum_insured[]" value="{{$health_type->health_sum_insured[$key]??''}}"></td>
                                                            <td><input type="text" class="form-control" name="health_pre_existing_disease[]" value="{{$health_type->health_pre_existing_disease[$key] ?? ''}}"></td>
                                                            <td><input type="checkbox" class="checkbox" name="health_hospitalization[]"></td>
                                                            <td>
                                                                <label for="file-up"><svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                                                        <title />
                                                                        <g data-name="1" id="_1">
                                                                            <path d="M324.3,387.69H186a15,15,0,0,1-15-15V235.8H114.81a15,15,0,0,1-11.14-25.05L244,55.1a15,15,0,0,1,22.29,0L406.6,210.75a15,15,0,0,1-11.14,25.05H339.3V372.69A15,15,0,0,1,324.3,387.69ZM201,357.69H309.3V220.8a15,15,0,0,1,15-15h37.44L255.13,87.55,148.53,205.8H186a15,15,0,0,1,15,15Z" />
                                                                            <path d="M390.84,452.15H119.43a65.37,65.37,0,0,1-65.3-65.3V348.68a15,15,0,0,1,30,0v38.17a35.34,35.34,0,0,0,35.3,35.3H390.84a35.33,35.33,0,0,0,35.29-35.3V348.68a15,15,0,1,1,30,0v38.17A65.37,65.37,0,0,1,390.84,452.15Z" />
                                                                        </g>
                                                                    </svg></label>
                                                                <input type="file" id="file-up" class="form-control" name="health_hospitalization_upload[]">
                                                                @if(isset($health_type->health_hospitalization_upload[$key]))

                                                                <a href="{{URL::asset('attachments')}}/{{$health_type->health_hospitalization_upload[$key] ?? ''}}" target="_blank">{{$health_type->health_hospitalization_upload[$key] ?? ''}}</a>
                                                                @endif


                                                            </td>
                                                            <td>
                                                                <div type="button" class="btn btn-danger delete-health">Delete</div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        <tr>
                                                            <td><input type="text" class="form-control" name="health_name[]"></td>

                                                            <td><input type="date" class="form-control" name="health_dob[]"></td>

                                                            <td><input type="text" class="form-control" name="health_age[]"></td>
                                                            <td><input type="text" class="form-control" name="health_relation[]"></td>
                                                            <td><input type="text" class="form-control" name="health_sum_insured[]"></td>
                                                            <td><input type="text" class="form-control" name="health_pre_existing_disease[]"></td>
                                                            <td><input type="checkbox" class="checkbox" name="health_hospitalization[]"></td>
                                                            <td><input type="file" class="form-control" name="health_hospitalization_upload[]"></td>
                                                            <td>
                                                                <div type="button" class="btn btn-danger delete-health">Delete</div>
                                                            </td>
                                                        </tr>


                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container marine-details">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center ">

                                            <div class="col-sm-12">
                                                <div class="row main-row">


                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-4  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">COMMODITY
                                                                </label>
                                                                <input type="text" name="commodity_type" value="{{isset($policy) ? $policy->commodity_type : ''}}" class="form-control " id="commodity_type">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">VOYAGE
                                                                </label>
                                                                <select name="voyage" class="select2 form-control " id="mode_of_transport">
                                                                    <option value="">Select Below</option>
                                                                    <option value="INLAND" {{ (isset($policy) && "INLAND" == $policy->voyage) ? 'selected' : '' }}>INLAND</option>
                                                                    <option value="IMPORT" {{ (isset($policy) && "IMPORT" == $policy->voyage) ? 'selected' : '' }}>IMPORT</option>
                                                                    <option value="EXPORT" {{ (isset($policy) && "EXPORT" == $policy->voyage) ? 'selected' : '' }}>EXPORT</option>
                                                                    <option value="ALL TYPE" {{ (isset($policy) && "ALL TYPE" == $policy->voyage) ? 'selected' : '' }}>ALL TYPE</option>

                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">MODE OF TRANSIT
                                                                </label>
                                                                <select name="mode_of_transport" class="select2 form-control " id="mode_of_transport">
                                                                    <option value="">Select Below</option>
                                                                    <option value="RAIL" {{ (isset($policy) && "RAIL" == $policy->mode_of_transport) ? 'selected' : '' }}>RAIL</option>
                                                                    <option value="ROAD" {{ (isset($policy) && "ROAD" == $policy->mode_of_transport) ? 'selected' : '' }}>ROAD</option>
                                                                    <option value="AIR" {{ (isset($policy) && "AIR" == $policy->mode_of_transport) ? 'selected' : '' }}>AIR</option>
                                                                    <option value="SEA" {{ (isset($policy) && "SEA" == $policy->mode_of_transport) ? 'selected' : '' }}>SEA</option>
                                                                    <option value="COURIER" {{ (isset($policy) && "COURIER" == $policy->mode_of_transport) ? 'selected' : '' }}>COURIER</option>
                                                                    <option value="ALL" {{ (isset($policy) && "ALL" == $policy->mode_of_transport) ? 'selected' : '' }}>ALL</option>
                                                                </select>
                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper background">
                                                        <div class="col-lg-6 ">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <p class="mg-t-10 mg-b-1">Type</p>
                                                                    <select name="type" class="select2 form-control " id="type">
                                                                        <option value="">Select Below</option>
                                                                        <option value="SINGLE TRANSIT" {{ (isset($policy) && "SINGLE TRANSIT" == $policy->type) ? 'selected' : '' }}>SINGLE TRANSIT</option>
                                                                        <option value="OPEN POLICY" {{ (isset($policy) && "OPEN POLICY" == $policy->type) ? 'selected' : '' }}>OPEN POLICY</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <p class="mg-t-10 mg-b-1">Commodity Type</p>
                                                                    <input type="text" name="commodity_type" value="{{isset($policy) ? $policy->commodity_type : ''}}" class="form-control " id="commodity_type">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <p class="mg-t-10 mg-b-1">Mode Of Transport</p>
                                                                    <select name="mode_of_transport" class="select2 form-control " id="mode_of_transport">
                                                                        <option value="">Select Below</option>
                                                                        <option value="RAIL" {{ (isset($policy) && "RAIL" == $policy->mode_of_transport) ? 'selected' : '' }}>RAIL</option>
                                                                        <option value="ROAD" {{ (isset($policy) && "ROAD" == $policy->mode_of_transport) ? 'selected' : '' }}>ROAD</option>
                                                                        <option value="AIR" {{ (isset($policy) && "AIR" == $policy->mode_of_transport) ? 'selected' : '' }}>AIR</option>
                                                                        <option value="SEA" {{ (isset($policy) && "SEA" == $policy->mode_of_transport) ? 'selected' : '' }}>SEA</option>
                                                                        <option value="COURIER" {{ (isset($policy) && "COURIER" == $policy->mode_of_transport) ? 'selected' : '' }}>COURIER</option>
                                                                        <option value="ALL" {{ (isset($policy) && "ALL" == $policy->mode_of_transport) ? 'selected' : '' }}>ALL</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <p class="mg-t-10 mg-b-1">Cover Type</p>
                                                                    <select name="cover_type" class="select2 form-control " id="cover_type">
                                                                        <option value="">Select Below</option>
                                                                        <option value="ITC A" {{ (isset($policy) && "ITC A" == $policy->cover_type) ? 'selected' : '' }}>ITC A</option>
                                                                        <option value="ITC B" {{ (isset($policy) && "ITC B" == $policy->cover_type) ? 'selected' : '' }}>ITC B</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <p class="mg-t-10 mg-b-1">Sum Insured</p>
                                                                    <input type="text" name="sum_insured" value="{{isset($policy) ? $policy->sum_insured : ''}}" class="form-control " id="sum_insured">
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <p class="mg-t-10 mg-b-1">Per Sending Limt</p>
                                                                    <input type="text" name="per_sending_limit" value="{{isset($policy) ? $policy->per_sending_limit : ''}}" class="form-control " id="per_sending_limit">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <p class="mg-t-10 mg-b-1">Per Location Limit</p>
                                                                    <input type="text" name="per_location_limit" value="{{isset($policy) ? $policy->per_location_limit : ''}}" class="form-control " id="per_location_limit">
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <p class="mg-t-10 mg-b-1">Estimated Annual Sum Insured</p>
                                                                    <input type="text" name="estimate_annual_sum" value="{{isset($policy) ? $policy->estimate_annual_sum : ''}}" class="form-control " id="estimate_annual_sum">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <p class="mg-t-10 mg-b-1">Basis Of Valuation</p>
                                                                    <input type="text" name="basic_of_valuation" value="{{isset($policy) ? $policy->basic_of_valuation : ''}}" class="form-control " id="basic_of_valuation">
                                                                </div>

                                                                <div class="col-lg-6">

                                                                    <p class="mg-t-10 mg-b-1">Details Of Commodity Type</p>
                                                                    <select name="commodity_details" class="select2 form-control " id="commodity_details">
                                                                        <option value="">Select Below</option>
                                                                        <option value="BOXES" {{ (isset($policy) && "BOXES" == $policy->commodity_details) ? 'selected' : '' }}>BOXES</option>
                                                                        <option value="CONTAINER" {{ (isset($policy) && "CONTAINER" == $policy->commodity_details) ? 'selected' : '' }}>CONTAINER</option>
                                                                        <option value="WEIGHT" {{ (isset($policy) && "WEIGHT" == $policy->commodity_details) ? 'selected' : '' }}>WEIGHT</option>
                                                                        <option value="NO OF PACKAGES" {{ (isset($policy) && "NO OF PACKAGES" == $policy->commodity_details) ? 'selected' : '' }}>NO OF PACKAGES</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Packing Description
                                                                </label>
                                                                <input type="text" name="packing_description" value="{{isset($policy) ? $policy->packing_description : ''}}" class="form-control " id="packing_description">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container wc-details">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center ">

                                            <div class="col-sm-12">
                                                <div class="row main-row">


                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-4  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Industry Type
                                                                </label>
                                                                <input type="text" name="industry_type" value="{{isset($policy) ? $policy->industry_type : ''}}" class="form-control feild" id="industry_type">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Total No Of Workers
                                                                </label>
                                                                <input type="text" name="worker_number" value="{{isset($policy) ? $policy->worker_number : ''}}" class="form-control feild" id="worker_number">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">DURATION OF POLICY

                                                                </label>
                                                                <input type="text" name="wc_policy" value="{{isset($policy) ? $policy->wc_policy : ''}}" class="form-control feild" id="wc_policy">
                                                            </div>
                                                        </div>



                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="row main-row">

                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Job Profile
                                                                </label>
                                                                <select name="job_profile" class="select2 form-control feild" id="job_profile">
                                                                    <option value="">Select Below</option>
                                                                    <option value="SKILLED" {{ (isset($policy) && "SKILLED" == $policy->job_profile) ? 'selected' : '' }}>SKILLED</option>
                                                                    <option value="SEMISKILLED" {{ (isset($policy) && "SEMISKILLED" == $policy->job_profile) ? 'selected' : '' }}>SEMISKILLED</option>
                                                                    <option value="UNSKILLED" {{ (isset($policy) && "UNSKILLED" == $policy->job_profile) ? 'selected' : '' }}>UNSKILLED</option>

                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Salery Per Month
                                                                </label>
                                                                <input type="text" name="salary_per_month" value="{{isset($policy) ? $policy->salary_per_month : ''}}" class="form-control feild" id="salary_per_month">

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="row main-row">

                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Medical Extension
                                                                </label>
                                                                <input type="text" name="medical_extension" value="{{isset($policy) ? $policy->medical_extension : ''}}" class="form-control feild" id="medical_extension">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Occupation Disease
                                                                </label>
                                                                <input type="text" name="occupation_disease" value="{{isset($policy) ? $policy->occupation_disease : ''}}" class="form-control feild" id="occupation_disease">

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="row main-row">

                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Compressed Air Disease Extension
                                                                </label>
                                                                <input type="text" name="compressed_air_disease" value="{{isset($policy) ? $policy->compressed_air_disease : ''}}" class="form-control feild" id="compressed_air_disease">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Terrorism Cover
                                                                </label>
                                                                <input type="text" name="terrorism_cover" value="{{isset($policy) ? $policy->terrorism_cover : ''}}" class="form-control feild" id="terrorism_cover">

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="row main-row">

                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Sub Contractor Cover
                                                                </label>
                                                                <input type="text" name="sub_contractor_cover" value="{{isset($policy) ? $policy->sub_contractor_cover : ''}}" class="form-control feild" id="sub_contractor_cover">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Multiple Location
                                                                </label>
                                                                <input type="text" name="multiple_location" value="{{isset($policy) ? $policy->multiple_location : ''}}" class="form-control feild" id="multiple_location">

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container home-details">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center ">

                                            <div class="col-sm-12">
                                                <div class="row main-row">


                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Measures Taken After Loss
                                                                </label>
                                                                <input type="text" name="measures_taken_after_loss" value="{{isset($policy) ? $policy->measures_taken_after_loss : ''}}" class="form-control feild" id="measures_taken_after_loss">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Loss Date
                                                                </label>
                                                                <input type="text" name="loss_date" value="{{isset($policy) ? $policy->loss_date : ''}}" class="form-control feild" id="loss_date">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Loss In Amount

                                                                </label>
                                                                <input type="text" name="loss_in_amount" value="{{isset($policy) ? $policy->loss_in_amount : ''}}" class="form-control feild" id="loss_in_amount">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Address Risk Location

                                                                </label>
                                                                <input type="text" name="address_risk_location" value="{{isset($policy) ? $policy->address_risk_location : ''}}" class="form-control feild" id="address_risk_location">
                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Cover Opted
                                                                </label>
                                                                <input type="text" name="cover_opted" value="{{isset($policy) ? $policy->cover_opted : ''}}" class="form-control feild" id="cover_opted">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Policy Inception Date
                                                                </label>
                                                                <input type="text" name="policy_inception_date" value="{{isset($policy) ? $policy->policy_inception_date : ''}}" class="form-control feild" id="policy_inception_date">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Tenure

                                                                </label>
                                                                <input type="text" name="tenure" value="{{isset($policy) ? $policy->tenure : ''}}" class="form-control feild" id="tenure">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Construction Type

                                                                </label>
                                                                <select name="construction_type" class="form-control feild" id="construction_type">
                                                                    <option value="">Select</option>
                                                                    <option value="PUCCA" {{ (isset($policy) && "PUCCA" == $policy->construction_type) ? 'selected' : '' }}>PUCCA</option>
                                                                    <option value="KUTCHA" {{ (isset($policy) && "KUTCHA" == $policy->construction_type) ? 'selected' : '' }}>KUTCHA</option>
                                                                </select>
                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Age Of the Building
                                                                </label>
                                                                <input type="text" name="age_of_building" value="{{isset($policy) ? $policy->age_of_building : ''}}" class="form-control feild" id="age_of_building">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Basement for Building
                                                                </label>
                                                                <input type="text" name="basement_for_building" value="{{isset($policy) ? $policy->basement_for_building : ''}}" class="form-control feild" id="basement_for_building">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Basement for Content

                                                                </label>
                                                                <input type="text" name="basement_for_content" value="{{isset($policy) ? $policy->basement_for_content : ''}}" class="form-control feild" id="basement_for_content">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Claim
                                                                </label>
                                                                <input type="text" name="claims" value="{{isset($policy) ? $policy->claims : ''}}" class="form-control feild" id="claims">

                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Building Carpet Area
                                                                </label>
                                                                <input type="text" name="building_carpet_area" value="{{isset($policy) ? $policy->building_carpet_area : ''}}" class="form-control feild" id="building_carpet_area">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Building Cost Of Construction
                                                                </label>
                                                                <input type="text" name="building_cost_of_construction" value="{{isset($policy) ? $policy->building_cost_of_construction : ''}}" class="form-control feild" id="building_cost_of_construction">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Building Sum Insured

                                                                </label>
                                                                <input type="text" name="building_sum_insured" value="{{isset($policy) ? $policy->building_sum_insured : ''}}" class="form-control feild" id="building_sum_insured">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Content Sum Insured
                                                                </label>
                                                                <input type="text" name="content_sum_insured" value="{{isset($policy) ? $policy->content_sum_insured : ''}}" class="form-control feild" id="content_sum_insured">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Rent of Alternative Accommodation
                                                                </label>
                                                                <input type="text" name="rent_alternative_accommodation" value="{{isset($policy) ? $policy->rent_alternative_accommodation : ''}}" class="form-control feild" id="rent_alternative_accommodation">

                                                            </div>
                                                        </div>



                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container fire-details">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center ">

                                            <div class="col-sm-12">
                                                <div class="row main-row">


                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">COVERAGE TYPE
                                                                </label>
                                                                <input type="text" name="measures_taken_after_loss" value="{{isset($policy) ? $policy->measures_taken_after_loss : ''}}" class="form-control feild" id="measures_taken_after_loss">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Address Risk Location

                                                                </label>
                                                                <input type="text" name="address_risk_location" value="{{isset($policy) ? $policy->address_risk_location : ''}}" class="form-control feild" id="address_risk_location">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">RISK LOCATION PINCODE


                                                                </label>
                                                                <input type="text" name="pincode" value="{{isset($policy) ? $policy->pincode : ''}}" class="form-control feild" id="pincode">
                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Occupancy
                                                                </label>
                                                                <input type="text" name="occupancy" value="{{isset($policy) ? $policy->occupancy : ''}}" class="form-control feild" id="occupancy">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Occupancy Tarriff
                                                                </label>
                                                                <input type="text" name="occupancy_tarriff" value="{{isset($policy) ? $policy->occupancy_tarriff : ''}}" class="form-control feild" id="occupancy_tarriff">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Building
                                                                </label>
                                                                <input type="text" name="building" value="{{isset($policy) ? $policy->building : ''}}" class="form-control feild" id="building">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Plant And Machinery
                                                                </label>
                                                                <input type="text" name="plant_machine" value="{{isset($policy) ? $policy->plant_machine : ''}}" class="form-control feild" id="plant_machine">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Furniture Fixture And Fittings

                                                                </label>
                                                                <input type="text" name="furniture_fixure" value="{{isset($policy) ? $policy->furniture_fixure : ''}}" class="form-control feild" id="furniture_fixure">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Stock In Process
                                                                </label>
                                                                <input type="text" name="stock_in_process" value="{{isset($policy) ? $policy->stock_in_process : ''}}" class="form-control feild" id="stock_in_process">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Finished Stock
                                                                </label>
                                                                <input type="text" name="finished_stock" value="{{isset($policy) ? $policy->finished_stock : ''}}" class="form-control feild" id="finished_stock">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Other Contents
                                                                </label>
                                                                <input type="text" name="other_contents" value="{{isset($policy) ? $policy->other_contents : ''}}" class="form-control feild" id="other_contents">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Claim In last 3 Years
                                                                </label>
                                                                <input type="radio" name="clain_in_last_three_year" <?php if (isset($policy) && $policy->clain_in_last_three_year === 'Yes') echo 'checked'; ?> value="Yes" class="feild mg-b-0" id="clain_in_last_three_year">Yes
                                                                <input type="radio" name="clain_in_last_three_year" <?php if (isset($policy) && $policy->clain_in_last_three_year === 'No') echo 'checked'; ?> value="No" class=" feild mg-b-0" id="clain_in_last_three_year">No

                                                            </div>
                                                        </div>

                                                        <div class="claim-yes" style="display:flex">
                                                            <div class="col-lg-3 clain_in_last_three_year_yes">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Loss Details
                                                                    </label>
                                                                    <input type="text" name="loss_details" value="{{isset($policy) ? $policy->loss_details : ''}}" class="form-control feild" id="loss_details">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 clain_in_last_three_year_yes">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Loss In Amount
                                                                    </label>
                                                                    <input type="text" name="loss_in_amount" value="{{isset($policy) ? $policy->loss_in_amount : ''}}" class="form-control feild" id="loss_in_amount">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 clain_in_last_three_year_yes">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Loss Date
                                                                    </label>
                                                                    <input type="text" name="loss_date" value="{{isset($policy) ? $policy->loss_date : ''}}" class="form-control feild" id="loss_date">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 clain_in_last_three_year_yes">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Measures Taken After Loss
                                                                    </label>
                                                                    <input type="text" name="measures_taken_after_loss" value="{{isset($policy) ? $policy->measures_taken_after_loss : ''}}" class="form-control feild" id="measures_taken_after_loss">
                                                                </div>
                                                            </div>
                                                        </div>



                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container travel-details">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center ">

                                            <div class="col-sm-12">
                                                <div class="row main-row">


                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Visiting Country
                                                                </label>

                                                                <select name="visiting_country" class="form-control" id="visiting_country">
                                                                    <option value="">Select</option>
                                                                    <option value="INCUDING US/CANADA" {{ (isset($policy) && "INCUDING US/CANADA" == $policy->visiting_country) ? 'selected' : '' }}>INCUDING US/CANADA</option>
                                                                    <option value="EXCLUDING US/CANADA" {{ (isset($policy) && "EXCLUDING US/CANADA" == $policy->visiting_country) ? 'selected' : '' }}>EXCLUDING US/CANADA</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Date Of Departure

                                                                </label>
                                                                <input type="date" name="date_of_departure" value="{{isset($policy) ? $policy->date_of_departure : ''}}" class="form-control feild" id="date_of_departure">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Date of Arrival
                                                                </label>
                                                                <input type="date" name="date_of_arrival" value="{{isset($policy) ? $policy->date_of_arrival : ''}}" class="form-control feild" id="date_of_arrival">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">No Of Days
                                                                </label>
                                                                <input type="number" name="no_of_days" value="{{isset($policy) ? $policy->no_of_days : ''}}" class="form-control feild" id="no_of_days">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">No Of Person
                                                                </label>
                                                                <input type="text" name="no_person" value="{{isset($policy) ? $policy->no_person : ''}}" class="form-control feild" id="no_person">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Passport details

                                                                </label>
                                                                <input type="text" name="passport_datails" value="{{isset($policy) ? $policy->passport_datails : ''}}" class="form-control feild" id="passport_datails">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0 dataTable no-footer">
                                                            <thead>
                                                                <th>NAME</th>
                                                                <th>DOB</th>
                                                                <th>AGE</th>
                                                                <th>SUM INSURED</th>
                                                                <th>PRE EXISTING DISEASE</th>
                                                                <th>
                                                                    <div class="btn-info btn add-travel">Add</div>
                                                                </th>
                                                            </thead>
                                                            <tbody class="travel-body">
                                                                @if(isset($policy->travel_type) && !empty($policy->travel_type))

                                                                <?php
                                                                $travel_type = json_decode($policy->travel_type);
                                                                ?>
                                                                @foreach($travel_type->travel_name as $key=> $name)

                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="travel_name[]" value="{{$name ?? ''}}"></td>

                                                                    <td><input type="date" class="form-control" name="travel_dob[]" value="{{$travel_type->travel_dob[$key] ?? ''}}"></td>

                                                                    <td><input type="text" class="form-control" name="travel_age[]" value="{{$travel_type->travel_age[$key] ?? ''}}"></td>
                                                                    <td><input type="text" class="form-control" name="travel_sum_insured[]" value="{{$travel_type->travel_sum_insured[$key] ?? ''}}"></td>
                                                                    <td><input type="text" class="form-control" name="travel_pre_existing_disease[]" value="{{$travel_type->travel_pre_existing_disease[$key] ?? ''}}"></td>

                                                                    <td>
                                                                        <div type="button" class="btn btn-danger delete-travel">Delete</div>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                                @else
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="travel_name[]"></td>

                                                                    <td><input type="date" class="form-control" name="travel_dob[]"></td>

                                                                    <td><input type="text" class="form-control" name="travel_age[]"></td>
                                                                    <td><input type="text" class="form-control" name="travel_sum_insured[]"></td>
                                                                    <td><input type="text" class="form-control" name="travel_pre_existing_disease[]"></td>
                                                                    <td>
                                                                        <div type="button" class="btn btn-danger delete-travel">Delete</div>
                                                                    </td>
                                                                </tr>


                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container payment-details">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center ">
                                            <div class="col-sm-2">
                                                <div>PREMIUM PAYMENT DETAILS</div>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="row main-row">


                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">PREMIUM RECEIVED </label>
                                                                <input type="number" name="mis_amount_paid" onkeyup="findShortAMOUNT()" value="{{isset($policy) ? $policy->mis_amount_paid : ''}}" class="form-control mis_amount_paid">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">IN A/C
                                                                </label>
                                                                <input type="text" name="mis_received_bank_detail" value="{{isset($policy) ? $policy->mis_received_bank_detail : ''}}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">PAYMENT METHOD</label>
                                                                <select name="mis_payment_method" class="form-control">
                                                                    <option value="">Select</option>
                                                                    <option value="Cheque" {{ (isset($policy->mis_payment_method) && 'Cheque' == $policy->mis_payment_method) ? 'selected' : '' }}>Cheque</option>
                                                                    <option value="DD/Draft" {{ (isset($policy->mis_payment_method) && 'DD/Draft' == $policy->mis_payment_method) ? 'selected' : '' }}>DD/Draft</option>
                                                                    <option value="Bank Transfer" {{ (isset($policy->mis_payment_method) && 'Bank Transfer' == $policy->mis_payment_method) ? 'selected' : '' }}>Bank Transfer</option>
                                                                    <option value="Online" {{ (isset($policy->mis_payment_method) && 'Online' == $policy->mis_payment_method) ? 'selected' : '' }}>Online</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">PREMIUM SHORT
                                                                </label>
                                                                <input type="number" name="mis_short_premium" value="{{isset($policy) ? $policy->mis_short_premium : ''}}" class="form-control mis_short_premium">
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">PREMIUM DEPOSITED</label>
                                                                <input type="number" name="mis_premium_deposit" value="{{isset($policy) ? $policy->mis_premium_deposit : ''}}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">TO A/C
                                                                </label>
                                                                <input type="text" name="mis_deposit_bank_detail" value="{{isset($policy) ? $policy->mis_deposit_bank_detail : ''}}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">PAYMENT METHOD</label>
                                                                <select name="mis_deposit_payment_method" class="form-control">
                                                                    <option value="">Select</option>
                                                                    <option value="Cheque" {{ (isset($policy->mis_deposit_payment_method) && 'Cheque' == $policy->mis_deposit_payment_method) ? 'selected' : '' }}>Cheque</option>
                                                                    <option value="DD/Draft" {{ (isset($policy->mis_deposit_payment_method) && 'DD/Draft' == $policy->mis_deposit_payment_method) ? 'selected' : '' }}>DD/Draft</option>
                                                                    <option value="Bank Transfer" {{ (isset($policy->mis_deposit_payment_method) && 'Bank Transfer' == $policy->mis_deposit_payment_method) ? 'selected' : '' }}>Bank Transfer</option>
                                                                    <option value="Online" {{ (isset($policy->mis_deposit_payment_method) && 'Online' == $policy->mis_deposit_payment_method) ? 'selected' : '' }}>Online</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">PAYMENT SOURCE
                                                                </label>
                                                                <input type="text" name="premium_payment_source" value="{{isset($policy) ? $policy->premium_payment_source : ''}}" class="form-control " id="premium_payment_source">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container payout-details">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center ">
                                            <div class="col-sm-2">
                                                <div>PAYOUT DETAILS</div>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="row main-row">

                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">COMMISSION BASE
                                                                </label>
                                                                <select name="commission_base" class="form-control" id="commission_base">
                                                                    <option value="">Select Below</option>
                                                                    <option value="od" {{ (isset($policy->commission_base) && 'od' == $policy->commission_base) ? 'selected' : '' }}>OD</option>
                                                                    <option value="net" {{ (isset($policy->commission_base) && 'net' == $policy->commission_base) ? 'selected' : '' }}>Net</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Base amount</label>
                                                                <input type="number" name="mis_commissionable_amount" value="{{isset($policy) ? $policy->mis_commissionable_amount : ''}}" onkeyup="commission()" class="form-control" id="mis_commissionable_amount">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">PERCENTAGE</label>
                                                                <input type="number" name="mis_percentage" value="{{isset($policy) ? $policy->mis_percentage : ''}}" onkeyup="commission()" class="form-control" id="mis_percentage">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">AMOUNT
                                                                </label>
                                                                <input type="text" name="mis_commission" value="{{isset($policy) ? $policy->mis_commission : ''}}" class="form-control" id="mis_commission">
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">PAYOUT SETTLED</label>
                                                                <input type="number" name="payout_settled" value="{{isset($policy) ? $policy->payout_settled : ''}}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">INVOICE
                                                                </label>
                                                                <input type="number" name="mis_invoice" value="{{isset($policy) ? $policy->invoice_id : ''}}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">MONTH SETTLED</label>
                                                                <input type="date" name="month_settled" value="{{isset($policy->invoice->invoice_date ) ? date('Y-m-d', strtotime($policy->invoice->invoice_date )) : ''}}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">RECOVERY</label>
                                                                <input type="text" name="payout_recovery" value="{{isset($policy) ? $policy->payout_recovery : ''}}" class="form-control ">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container">

                                <div class="card">
                                    <div class="card-body">
                                        <h4>Attachment</h4>
                                        <input type="file" name="attachment[]" id="attachment" multiple class="form-control  tableData">
                                        @if(isset($policy->policyAttachment) && !empty($policy->policyAttachment))

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>File Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($policy->policyAttachment as $key => $attachment)
                                                <tr>
                                                    <td>
                                                        <a href="{{ URL::asset('attachments') }}/{{ $attachment->file_name }}" target="_blank">{{ $attachment->file_name }}</a>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger delete-attachment" data-attachment-id="{{ $attachment->id }}">Delete</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @endif

                                    </div>
                                </div>
                            </div>


                            <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5 submit-btn" type="submit" value="upload">{{isset($policy) ? 'Update' : 'Save' }}</button>
                            <input name="button-type" type="submit" class="btn btn-info pd-x-30 mg-r-5 mg-t-5 submit-btn" value="{{isset($policy) ? 'Update & Email' : 'Save & Email' }}">
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        $('.delete-attachment').on('click', function() {
            var attachmentId = $(this).data('attachment-id');
            var row = $(this).closest('tr');

            Swal.fire({
                title: 'Delete Attachment?',
                text: 'Are you sure you want to delete this attachment?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route("delAttachment", ":attachmentId") }}'.replace(':attachmentId', attachmentId),
                        success: function(data) {
                            row.remove();
                            toastr.success('Attachment deleted successfully');
                        },
                        error: function() {
                            toastr.error('An error occurred while deleting the attachment.');
                        }
                    });
                }
            });
        });
    });

    $(document).ready(function() {
        $("select").select2();
        $('.dropify').dropify();
        $('.normal').show();
        $('.health').hide();
        $('.fire').hide();
        $('.wc').hide();
        $('.marine').hide();
        $('.motor-policy-details').hide();
        $('.vehicle-details').hide();
        $('.non-motor-policy-details').hide();
        $('.marine-details').hide();
        $('.health-section').hide();
        $('.wc-details').hide();
        $('.home-details').hide();

        $('.fire-details').hide();
        $('.travel-details').hide();
        $('.travel-busness').hide();
        $('.normal-business').show();
        $('.seating').show();
        $('.seating-pcv').hide();
        $('.liability-details').hide();

        document.getElementById('user-add-edit').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Enter key press ko rokna
            }
        });

        $(document).on('click', '.add-health', function() {
            $(".health-body").append(`  <tr>
                                                            <td><input type="text" class="form-control" name="health_name[]"></td>

                                                            <td><input type="date" class="form-control" name="health_dob[]"></td>

                                                            <td><input type="text" class="form-control" name="health_age[]"></td>
                                                            <td><input type="text" class="form-control" name="health_relation[]"></td>
                                                            <td><input type="text" class="form-control" name="health_sum_insured[]"></td>
                                                            <td><input type="text" class="form-control" name="health_pre_existing_disease[]"></td>
                                                            <td><input type="checkbox" class="checkbox" name="health_hospitalization[]"></td>
                                                            <td><input type="file" class="form-control" name="health_hospitalization_upload[]"></td>
                                                            <td>
                                                                <div type="button" class="btn btn-danger delete-health">Delete</div>
                                                            </td>
                                                        </tr>`)

        });
        $(document).on('click', '.delete-health', function() {
            $(this).parents('tr').remove()

        });
        $(document).on('click', '.add-travel', function() {
            $(".travel-body").append(`  <tr>
                                                            <td><input type="text" class="form-control" name="travel_name[]"></td>

                                                            <td><input type="date" class="form-control" name="travel_dob[]"></td>

                                                            <td><input type="text" class="form-control" name="travel_age[]"></td>
                                                            <td><input type="text" class="form-control" name="travel_sum_insured[]"></td>
                                                            <td><input type="text" class="form-control" name="travel_pre_existing_disease[]"></td>
                                                            <td>
                                                                <div type="button" class="btn btn-danger delete-travel">Delete</div>
                                                            </td>
                                                        </tr>`)

        });
        $(document).on('click', '.delete-travel', function() {
            $(this).parents('tr').remove()

        });
        $('.claim-yes').hide();
        if ($('#clain_in_last_three_year').is(':checked')) {
            $('.claim-yes').show();
        }

        // Show/hide the claim-yes div based on radio button selection
        $('input[name="clain_in_last_three_year"]').change(function() {
            if ($(this).val() == 'Yes') {
                $('.claim-yes').show();
            } else {
                $('.claim-yes').hide();
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#insurance_id').change(function() {

            if ($(this).val() != '') {

                var insurance_id = $(this).val();
                $.ajax({
                    url: "{{ route('getProduct') }}",
                    method: "post",
                    data: {
                        insurance_id: insurance_id,
                    },
                    success: function(result) {
                        $('#product_id').html(result);
                    }

                });
            }
        });
        $('#commission_base').change(function() {
            if ($(this).val() !== '') {
                var val = $(this).val();
                if (val === 'net') {
                    if ($('#product_id').val() == 1) {
                        $('#mis_commissionable_amount').val(parseFloat($('.net_premium').val()));
                    } else {
                        $('#mis_commissionable_amount').val(parseFloat($('.gross_net_premium').val()));
                    }
                } else {
                    var odPremium = parseFloat($('#od_premium').val() || 0);
                    var addOnPremium = parseFloat($('#add_on_premium').val() || 0);
                    $('#mis_commissionable_amount').val(odPremium + addOnPremium);
                }
                $('#mis_percentage').trigger('keyup');
            }
        });

        $('.reference_type').change(function() {
            if ($(this).val() != '') {

                var role = $(this).val();
                $.ajax({
                    url: "{{ route('getUsers') }}",
                    method: "post",
                    data: {
                        role: role,
                    },
                    success: function(result) {
                        $('.dynamic-user-id').html(result);
                    }
                });
            }
        });
        $('#make').change(function() {
            if ($(this).val() != '') {

                var make = $(this).val();
                $.ajax({
                    url: "{{ route('getModel') }}",
                    method: "post",
                    data: {
                        make: make,
                    },
                    success: function(result) {
                        $('#model').html(result['model']);
                    }

                });
            }
        });
        $('#model').change(function() {
            if ($(this).val() != '') {

                var make = $(this).val();
                $.ajax({
                    url: "{{ route('getVarient') }}",
                    method: "post",
                    data: {
                        make: make,
                    },
                    success: function(result) {
                        $('#varriant').html(result['varriant']);
                        $('#cc').html(result['cc']);
                        $('#fuel').html(result['fuel']);
                        $('#od').html(result['od']);
                        $('#seating').html(result['seating']);
                        $('#showroom').html(result['showroom']);
                        $('#tp_premium').html(result['tp']);

                    }

                });
            }
        });
        $('#product_id').change(function() {
            if ($(this).val() != '') {

                var product_id = $(this).val();
                $.ajax({
                    url: "{{ route('getSubProduct') }}",
                    method: "post",
                    data: {
                        product_id: product_id,
                    },
                    success: function(result) {
                        $('#subproduct_id').html(result);
                    }
                });
            }
        });

        $('#subproduct_id').change(function() {
            if ($(this).val() != '') {

                var subproduct_id = $(this).val();
                $.ajax({
                    url: "{{ route('getMake') }}",
                    method: "post",
                    data: {
                        subproduct_id: subproduct_id,
                    },
                    success: function(result) {
                        console.log(result);
                        $('#make').html(result);
                    }
                });
            }
            var subproduct = $(this).find(':selected').data("id");
            if (subproduct != '') {
                subproduct = $.trim(subproduct).toLowerCase();

                change(subproduct);
                changeTransactionOption(subproduct)

            }


        });
        let editSubproductId = "{{$policy->subProduct->name ?? ''}}";
        if (editSubproductId != '') {
            editSubproductId = $.trim(editSubproductId).toLowerCase();
            change(editSubproductId);
        }
    });

    function addAttachment() {
        $("#attachment_dynamic").append('  <tr> <td><input type="file" name="attachment[]"  id="attachment"  class="form-control dropify tableData"></td><td><button type="button"  class="btn btn-danger deleteatt" style="background: red">Delete</button></td></tr>')
        $('.dropify').dropify();

    }
    $(document).on('click', '.deleteatt', function() {
        $(this).closest('tr').remove();
    });

    function changeTransactionOption(subproduct) {
        //for transaction
        const transactionTypeSelect = $('select[name="mis_transaction_type"]');
        const optionsByTransactionType = {
            'travel': ['New', 'Extension'],
            'health': ['Base', 'Topup', 'Critical', 'PA', 'Others', 'Endorsement'],
            'fire': ['Laghu', 'Sooksham', 'Package', 'Others', 'Endorsement'],
            'wc': ['Package', 'SOAD', 'TP', 'Endorsement'],
            'marine': ['RAIL', 'ROAD', 'AIR', 'SEA', 'COURIER', 'ALL'],
        };
        const availableOptions = optionsByTransactionType[subproduct] || optionsByTransactionType['wc'];
        transactionTypeSelect.empty();
        transactionTypeSelect.append('<option value="">Select</option>');
        $.each(availableOptions, function(index, option) {
            transactionTypeSelect.append($('<option>', {
                value: option,
                text: option
            }));
        });

        //same for business
        //for business
        const businessTypeSelect = $('select[name="bussiness_type"]');
        const optionsByBusinessType = {
            'travel': ['New', 'Extension'],
            'health': ['Fresh', 'Port', 'Renewal'],
            'fire': ['New', 'Rollover', 'Renewal'],
            'wc': ['New', 'Rollover', 'Renewal', 'Enhancement'],
            'marine': ['New', 'Rollover', 'Renewal', 'Enhancement'],
            'default': ['New', 'Rollover', 'Renewal', 'Used']

        };
        const availableBusinessOptions = optionsByBusinessType[subproduct] || optionsByBusinessType['default'];
        businessTypeSelect.empty();
        businessTypeSelect.append('<option value="">Select</option>');
        $.each(availableBusinessOptions, function(index, option) {
            businessTypeSelect.append($('<option>', {
                value: option,
                text: option
            }));
        });

    }

    function change(subproduct) {

        if (subproduct == 'cpm' || subproduct == 'car' || subproduct == 'miscd') {
            $('.motor-policy-details').show();
            $('.vehicle-details').show();
            $('.non-motor-policy-details').hide();
            $('.gvw').hide();
            $('.cc-kw').hide();
            $('.vehicle-sub-class').show();
            $('.health-section').hide();
            $('.marine-details').hide();
            $('.wc-details').hide();
            $('.home-details').hide();
            $('.fire-details').hide();
            $('.travel-details').hide();
            $('.travel-busness').hide();
            $('.normal-business').show();
            $('.seating').show();
            $('.seating-pcv').hide();
            $('.normal').show();
            $('.health').hide();
            $('.fire').hide();
            $('.wc').hide();
            $('.marine').hide();
            $('.liability-details').hide();



        }
        if (subproduct == 'marine') {

            $('.motor-policy-details').hide();
            $('.vehicle-details').hide();
            $('.non-motor-policy-details').show();
            $('.health-section').hide();
            $('.marine-details').show();
            $('.wc-details').hide();
            $('.home-details').hide();
            $('.fire-details').hide();
            $('.travel-details').hide();
            $('.travel-busness').hide();
            $('.normal-business').show();
            $('.liability-details').hide();

            $('.seating').show();
            $('.seating-pcv').hide();
            $('.normal').hide();
            $('.health').hide();
            $('.fire').hide();
            $('.wc').hide();
            $('.marine').show();

        }
        if (subproduct == 'liability' || subproduct == 'others') {
            $('.motor-policy-details').hide();
            $('.vehicle-details').hide();
            $('.non-motor-policy-details').show();
            $('.health-section').hide();
            $('.marine-details').hide();
            $('.wc-details').hide();
            $('.fire-details').hide();
            $('.travel-busness').hide();
            $('.normal-business').show();
            $('.home-details').hide();
            $('.travel-details').hide();
            $('.normal').show();
            $('.health').hide();
            $('.fire').hide();
            $('.wc').hide();
            $('.marine').hide();
            $('.liability-details').show();

        }

        if (subproduct == 'wc') {
            $('.gvw').hide();
            $('.cc-kw').show();
            $('.vehicle-sub-class').hide();
            $('.motor-policy-details').hide();
            $('.vehicle-details').hide();
            $('.non-motor-policy-details').show();
            $('.health-section').hide();
            $('.wc-details').show();
            $('.marine-details').hide();
            $('.home-details').hide();
            $('.fire-details').hide();
            $('.travel-details').hide();
            $('.travel-busness').hide();
            $('.normal-business').show();
            $('.seating').show();
            $('.seating-pcv').hide();
            $('.normal').hide();
            $('.health').hide();
            $('.fire').hide();
            $('.wc').show();
            $('.marine').hide();
            $('.liability-details').hide();

        }
        if (subproduct == 'fire' || subproduct == 'burglary') {
            $('.motor-policy-details').hide();
            $('.vehicle-details').hide();
            $('.non-motor-policy-details').show();
            $('.health-section').hide();
            $('.marine-details').hide();
            $('.wc-details').hide();
            $('.fire-details').show();
            $('.travel-details').hide();
            $('.travel-busness').hide();
            $('.normal-business').show();
            $('.liability-details').hide();

            $('.home-details').hide();
            $('.normal').hide();
            $('.health').hide();
            $('.fire').show();
            $('.wc').hide();
            $('.marine').hide();
        }
        if (subproduct == 'home') {
            $('.motor-policy-details').hide();
            $('.vehicle-details').hide();
            $('.non-motor-policy-details').show();
            $('.health-section').hide();
            $('.wc-details').hide();
            $('.marine-details').hide();
            $('.home-details').show();
            $('.fire-details').hide();
            $('.travel-details').hide();
            $('.travel-busness').hide();
            $('.normal-business').show();
            $('.normal').show();
            $('.health').hide();
            $('.fire').hide();
            $('.wc').hide();
            $('.marine').hide();
            $('.liability-details').hide();

        }
        if (subproduct == 'health') {
            $('.motor-policy-details').hide();
            $('.vehicle-details').hide();
            $('.non-motor-policy-details').show();
            $('.health-section').show();
            $('.marine-details').hide();
            $('.wc-details').hide();

            $('.fire-details').hide();
            $('.home-details').hide();
            $('.travel-details').hide();
            $('.travel-busness').hide();
            $('.normal-business').show();
            $('.normal').hide();
            $('.health').show();
            $('.fire').hide();
            $('.wc').hide();
            $('.marine').hide();
            $('.liability-details').hide();

        }
        if (subproduct == 'travel') {
            $('.motor-policy-details').hide();
            $('.vehicle-details').hide();
            $('.non-motor-policy-details').show();
            $('.health-section').hide();
            $('.marine-details').hide();
            $('.wc-details').hide();
            $('.fire-details').hide();
            $('.travel-details').show();
            $('.travel-busness').show();
            $('.normal-business').hide();
            $('.home-details').hide();
            $('.normal').show();
            $('.health').hide();
            $('.fire').hide();
            $('.wc').hide();
            $('.marine').hide();
            $('.liability-details').hide();


        }


        if (subproduct == 'pvr') {
            $('.gvw').hide();
            $('.cc-kw').show();
            $('.vehicle-sub-class').hide();
            $('.motor-policy-details').show();
            $('.health-section').hide();
            $('.vehicle-details').show();
            $('.non-motor-policy-details').hide();
            $('.marine-details').hide();
            $('.wc-details').hide();
            $('.home-details').hide();
            $('.fire-details').hide();
            $('.travel-details').hide();
            $('.travel-busness').hide();
            $('.normal-business').show();
            $('.seating').show();
            $('.seating-pcv').hide();
            $('.normal').show();
            $('.health').hide();
            $('.fire').hide();
            $('.wc').hide();
            $('.marine').hide();
            $('.liability-details').hide();


        }
        if (subproduct == 'pvt car') {
            $('.gvw').hide();
            $('.cc-kw').show();
            $('.vehicle-sub-class').hide();
            $('.motor-policy-details').show();
            $('.vehicle-details').show();
            $('.non-motor-policy-details').hide();
            $('.health-section').hide();
            $('.marine-details').hide();
            $('.wc-details').hide();
            $('.travel-details').hide();
            $('.travel-busness').hide();
            $('.normal-business').show();
            $('.home-details').hide();
            $('.fire-details').hide();
            $('.seating').show();
            $('.seating-pcv').hide();
            $('.normal').show();
            $('.health').hide();
            $('.fire').hide();
            $('.wc').hide();
            $('.marine').hide();
            $('.liability-details').hide();

        }
        if (subproduct == 'gcv') {
            $('.motor-policy-details').show();
            $('.gvw').show();
            $('.cc-kw').hide();
            $('.vehicle-sub-class').hide();
            $('.vehicle-details').show();
            $('.non-motor-policy-details').hide();
            $('.health-section').hide();
            $('.marine-details').hide();
            $('.wc-details').hide();
            $('.home-details').hide();
            $('.fire-details').hide();
            $('.travel-details').hide();
            $('.travel-busness').hide();
            $('.normal-business').show();
            $('.seating').show();
            $('.seating-pcv').hide();
            $('.normal').show();
            $('.health').hide();
            $('.fire').hide();
            $('.wc').hide();
            $('.marine').hide();
            $('.liability-details').hide();

        }
        if (subproduct == 'pcv') {
            $('.gvw').hide();
            $('.cc-kw').show();
            $('.vehicle-sub-class').hide();
            $('.motor-policy-details').show();
            $('.vehicle-details').show();
            $('.non-motor-policy-details').hide();
            $('.health-section').hide();
            $('.marine-details').hide();
            $('.wc-details').hide();
            $('.fire-details').hide();
            $('.travel-details').hide();
            $('.travel-busness').hide();
            $('.normal-business').show();
            $('.home-details').hide();
            $('.seating').hide();
            $('.seating-pcv').show();
            $('.normal').show();
            $('.health').hide();
            $('.fire').hide();
            $('.wc').hide();
            $('.marine').hide();
            $('.liability-details').hide();

        }
        if (subproduct == 'tw') {
            $('.gvw').hide();
            $('.cc-kw').show();
            $('.vehicle-sub-class').hide();
            $('.motor-policy-details').show();
            $('.vehicle-details').show();
            $('.non-motor-policy-details').hide();
            $('.health-section').hide();
            $('.marine-details').hide();
            $('.wc-details').hide();
            $('.fire-details').hide();
            $('.travel-busness').hide();
            $('.normal-business').show();
            $('.home-details').hide();
            $('.travel-details').hide();
            $('.seating').show();
            $('.seating-pcv').hide();
            $('.normal').show();
            $('.health').hide();
            $('.fire').hide();
            $('.wc').hide();
            $('.marine').hide();
            $('.liability-details').hide();

        }



    }

    function commission() {
        var commission_amount = parseFloat($("#mis_commissionable_amount").val());
        var commission_perc = parseFloat($("#mis_percentage").val());
        var commission_calc = commission_amount * commission_perc / 100;
        $("#mis_commission").val(commission_calc);
    }

    function netPremium() {
        var od_premium = parseFloat($("#od_premium").val());
        var tp_premium = parseFloat($("#tp_premium").val());
        var add_on_premium = parseFloat($("#add_on_premium").val());
        var others = parseFloat($("#others").val());

        var netpremium = parseFloat(od_premium || 0) + parseFloat(tp_premium || 0) + parseFloat(add_on_premium || 0) + parseFloat(others || 0);

        if (!isNaN(netpremium)) {
            $(".net_premium").val(netpremium);
        } else {
            $(".net_premium").val('');
        }
    }

    function grossPremium() {
        var net_premium = parseFloat($(".net_premium").val());
        var gst = parseFloat($(".gst").val());


        var gross_premium = parseFloat(net_premium || 0) + parseFloat(gst || 0);
        if (!isNaN(gross_premium)) {
            $(".gross_premium").val(gross_premium);
        } else {
            $(".gross_premium").val('');
        }
    }

    function grossFirePremium() {
        var net_premium = parseFloat($(".gross_net_premium").val());
        var gst = parseFloat($(".gross_gst").val());


        var gross_premium = parseFloat(net_premium || 0) + parseFloat(gst || 0);
        if (!isNaN(gross_premium)) {
            $(".grossFirePremium").val(gross_premium);
        } else {
            $(".grossFirePremium").val('');
        }
    }

    function findShortAMOUNT() {
        var product_id = $("#product_id").val();
        if (product_id == 2) {

            var gross_premium = parseFloat($(".grossFirePremium").val());
        } else {
            var gross_premium = parseFloat($(".gross_premium").val());

        }
        var mis_amount_paid = parseFloat($(".mis_amount_paid").val());


        var mis_short_premium = parseFloat(gross_premium || 0) - parseFloat(mis_amount_paid || 0);

        if (!isNaN(mis_short_premium)) {
            $(".mis_short_premium").val(mis_short_premium);
        } else {
            $(".mis_short_premium").val('');
        }
    }
</script>
<script>
    $(document).ready(function() {
        $(document).on('change', '.start_date', function() {
            const selectedStartDate = new Date($(this).val());
            const expiryDate = new Date(selectedStartDate);
            expiryDate.setFullYear(selectedStartDate.getFullYear() + 1);
            expiryDate.setDate(selectedStartDate.getDate() - 1); // Subtract one day
            const formattedExpiryDate = expiryDate.toISOString().split('T')[0];
            $('.expiry_date').val(formattedExpiryDate);
        });
        const phoneInput = document.getElementById('phoneInput');
        const phoneError = document.getElementById('phoneError');

        phoneInput.addEventListener('input', function() {
            const phoneValue = this.value.replace(/\D/g, ''); // Remove non-digit characters


            if (/^\d{10}$/.test(phoneValue)) {
                // Valid 10-digit phone number
                phoneError.textContent = ''; // Clear any previous error message
            } else {
                // Invalid phone number, show an error message
                phoneError.textContent = 'Phone number must be 10 digits long';
            }

        });

    });
</script>
@endsection