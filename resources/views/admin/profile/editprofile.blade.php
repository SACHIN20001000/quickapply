@extends('admin.layouts.app')

@section('content')
<!-- container opened -->
<div class="container">

  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
      <div class="d-flex">
        <h4 class="content-title mb-0 my-auto">Edit-Profile</h4>
      </div>
    </div>

  </div>
  <!-- breadcrumb -->

  <!-- row -->
  <div class="row row-sm">
    <!-- Col -->
    <div class="col-lg-4">
      <div class="card mg-b-20">
        <div class="card-body">
          <div class="ps-0">
            <div class="main-profile-overview">
              <div class="main-img-user profile-user">
                @if(!empty(Auth::user()->profile))
                <img alt="" src="{{URL::asset('profile')}}/{{Auth::user()->profile}}">
                @else
                <img src="../../assets/img/faces/6.jpg" alt="img">
                @endif
              </div>
              <div class="d-flex justify-content-between mg-b-20">
                <div>
                  <h5 class="main-profile-name">{{Auth::user()->name}}</h5>
                  <p class="main-profile-name-text">{{Auth::user()->email}}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Col -->
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <div class="mb-4 main-content-label">Personal Information</div>
          <form class="form-horizontal" id="profile-add-edit" action="{{route('updateUserProfile' , Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4 main-content-label">Name</div>

            <div class="form-group ">
              <div class="row">
                <div class="col-md-2">
                  <label class="form-label">User Name</label>
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="name" placeholder="User Name" value="{{Auth::user()->name}}">
                </div>
                <div class="col-md-2">
                  <label class="form-label">Upi</label>
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="upi" value="{{Auth::user()->upi}}">
                </div>

              </div>
            </div>
            <div class="form-group ">
              <div class="row">
                <div class="col-md-2">
                  <label class="form-label">Birthday</label>
                </div>
                <div class="col-md-4">
                  <input type="date" class="form-control" name="birthday" value="{{Auth::user()->birthday}}">
                </div>
                <div class="col-md-2">
                  <label class="form-label">Anniversary</label>
                </div>
                <div class="col-md-4">
                  <input type="date" class="form-control" name="anniversary" value="{{Auth::user()->anniversary}}">
                </div>
              </div>
            </div>


            <div class="form-group ">
              <div class="row">
                <div class="col-md-2">
                  <label class="form-label">User profile</label>
                </div>
                <div class="col-md-4">

                  @if(!empty(Auth::user()->profile))
                  <input type="file" class="dropify" name="profile" data-default-file="{{URL::asset('profile')}}/{{Auth::user()->profile}}">
                  @else
                  <input type="file" class="dropify" name="profile">
                  @endif
                </div>
                <div class="col-md-2">
                  <label class="form-label">Photo</label>
                </div>
                <div class="col-md-4">

                  @if(!empty(Auth::user()->photo))
                  <input type="file" class="dropify" name="photo" data-default-file="{{URL::asset('profile')}}/{{Auth::user()->photo}}">
                  @else
                  <input type="file" class="dropify" name="photo">
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group ">
              <div class="row">
                <div class="col-md-2">
                  <label class="form-label">Gender</label>
                </div>
                <div class="col-md-4">
                  <select name="gender" class="form-control">
                    <option value="">Select Below</option>
                    <option value="Male" {{ Auth::user()->gender == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ Auth::user()->gender == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ Auth::user()->gender == 'Other' ? 'selected' : '' }}>Other</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <label class="form-label">Phone</label>
                </div>
                <div class="col-md-4">
                  <input type="number" class="form-control" placeholder="enter your number" name="phone" value="{{Auth::user()->phone}}">
                </div>

              </div>
            </div>
            <div class="form-group ">
              <div class="row">
                <div class="col-md-2">
                  <label class="form-label">City</label>
                </div>
                <div class="col-md-4">
                  <input class="form-control" name="city" placeholder="Enter your city" type="text" value="{{Auth::user()->city}}">

                </div>
                <div class="col-md-2">
                  <label class="form-label">State</label>
                </div>
                <div class="col-md-4">
                  <input class="form-control" name="state" placeholder="Enter your state" type="text" value="{{Auth::user()->state}}">
                </div>

              </div>
            </div>
            <div class="row row-xs align-items-center mg-b-20">
              <div class="col-md-4">
                <label class="form-label mg-b-0">Address</label>
              </div>
              <div class="col-md-8 mg-t-5 mg-md-t-0">
                <input class="form-control" name="address" placeholder="Enter your address" type="text" value="{{Auth::user()->address}}">
              </div>
            </div>
            <div class="row row-xs align-items-center mg-b-20">
              <div class="col-md-4">
                <label class="form-label mg-b-0">GitHub Url</label>
              </div>
              <div class="col-md-8 mg-t-5 mg-md-t-0">
                <input class="form-control" name="github_url" placeholder="Enter your github_url" type="text" value="{{Auth::user()->github_url}}">
              </div>
            </div>
            <div class="row row-xs align-items-center mg-b-20">
              <div class="col-md-4">
                <label class="form-label mg-b-0">Linkdin Url</label>
              </div>
              <div class="col-md-8 mg-t-5 mg-md-t-0">
                <input class="form-control" name="linkdin_url" placeholder="Enter your linkdin_url" type="text" value="{{Auth::user()->linkdin_url}}">
              </div>
            </div>
            <div class="row row-xs align-items-center mg-b-20">
              <div class="col-md-4">
                <label class="form-label mg-b-0">Zip Recruiter Url</label>
              </div>
              <div class="col-md-8 mg-t-5 mg-md-t-0">
                <input class="form-control" name="ziprecuriter_url" placeholder="Enter your ziprecuriter_url" type="text" value="{{Auth::user()->ziprecuriter_url}}">
              </div>
            </div>

            <div class="mb-4 main-content-label">Salary Info</div>

            <div class="form-group ">
              <div class="row">
                <div class="col-md-3">
                  <label class="form-label">Current Salary</label>
                </div>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="current_salary" placeholder="Current Salary" value="{{Auth::user()->current_salary}}">
                </div>
              </div>
            </div>
            <div class="form-group ">
              <div class="row">
                <div class="col-md-3">
                  <label class="form-label">Expected Salary</label>
                </div>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="expected_salary" placeholder="Expected Salary" value="{{Auth::user()->expected_salary}}">
                </div>
              </div>
            </div>
            <div class="form-group ">
              <div class="row">
                <div class="col-md-3">
                  <label class="form-label">Work Knowledge</label>
                </div>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="work_knowledge" placeholder="Work Knowledge" value="{{Auth::user()->work_knowledge}}">
                </div>
              </div>
            </div>
            <div class="form-group ">
              <div class="row">
                <div class="col-md-3">
                  <label class="form-label">Country</label>
                </div>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="country" placeholder="Country" value="{{Auth::user()->country}}">
                </div>
              </div>
            </div>
            <div class="form-group ">
              <div class="row">
                <div class="col-md-3">
                  <label class="form-label">Notice Period</label>
                </div>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="notice_period" placeholder="Notice Period" value="{{Auth::user()->notice_period}}">
                </div>
              </div>
            </div>

        </div>
        <div class="mb-4 main-content-label">Contact Info</div>
        <div class="form-group ">
          <div class="row">
            <div class="col-md-3">
              <label class="form-label">Email<i>(required)</i></label>
            </div>
            <div class="col-md-9">
              <input type="text" class="form-control" readonly name="email" value="{{Auth::user()->email}}">
            </div>
          </div>
        </div>
        <div class="form-group ">
          <div class="row">
            <div class="col-md-3">
              <label class="form-label">Password</label>
            </div>
            <div class="col-md-9">
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
          </div>
        </div>
        <div class="form-group ">
          <div class="row">
            <div class="col-md-3">
              <label class="form-label">Confirm Password</label>
            </div>
            <div class="col-md-9">
              <input type="password" class="form-control" name="confirm_password" placeholder="Password">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary waves-effect waves-light">Update Profile</button>
    </div>
    </form>
  </div>

</div>
</div>
<!-- /Col -->
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
@endsection


@section('scripts')
<script>
  $('.dropify').dropify();
</script>
{!! JsValidator::formRequest('App\Http\Requests\Admin\Profile\UpdateUserProfile','#profile-add-edit') !!}


@endsection