@extends('home')
@section('content')
<div class="container">
<div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="card-title mb-4">
                        <div class="d-flex justify-content-start">
                            <form method="POST" action="{{ route('image') }}">
                            <div class="image-container">
                                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" id="imgProfile" class="img-circle img-thumbnail" alt="avatar">
                                <div class="middle">
                                    <input type="button" class="btn btn-secondary" id="btnChangePicture" value="Change" />
                                    <input type="file" style="display: none;" id="profilePicture" name="file" />
                                </div>
                            </div>
                            <div class="userData ml-3">
                                <h3>USER PROFILE</h3>
                                <h6 class="d-block"><a href="javascript:void(0)">1,500</a> Video Uploads</h6>
                                <h6 class="d-block"><a href="javascript:void(0)">300</a> Blog Posts</h6>
                            </div>
                            <div class="ml-auto">
                                <input type="submit" class="site-btn register-btn btn btn-primary d-none" id="btnDiscard" value="Discard Changes" />
                            </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Basic Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="settingPassword-tab" data-toggle="tab" href="#settingPassword" role="tab" aria-controls="settingPassword" aria-selected="false">Setting Password</a>
                                </li>
                            </ul>
                            <div class="tab-content ml-1" id="myTabContent">
                                <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                    

                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">User Name</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{$user['username']}}
                                            <div class="group-input edit_profile">
                                                <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" />
                                                @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <hr />
                                  
                                    
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Email</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{$user['email']}}
                                            <div class="group-input edit_profile">
                                                <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{$user['email']}}" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <button type="submit" class="site-btn register-btn edit" style="margin-top: 10px;"><span>Edit</span></button>
                                    <button type="submit" class="site-btn register-btn save_btn" style="margin-top: 10px;"><span>Save</span></button>
                                    <!-- <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Something</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            Something
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Something</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            Something
                                        </div>
                                    </div>
                                    <hr /> -->

                                </div>
                                <div class="tab-pane fade" id="settingPassword" role="tabpanel" aria-labelledby="settingPassword-tab">
                                    <div class="col-lg-6 offset-lg-3">
                                        <div class="group-input">
                                            <label for="password">Old Password *</label>
                                            <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"  required>
                                            @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="group-input">
                                            <label for="password">New Password *</label>
                                            <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"  required>
                                            @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="group-input">
                                            <label for="con-pass">Confirm Password *</label>
                                            <input type="password" id="con-pass" name="passwordAgain"  class="form-control{{ $errors->has('passwordAgain') ? ' is-invalid' : '' }}"  required>
                                            @if ($errors->has('passwordAgain'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('passwordAgain') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <button type="submit" class="site-btn register-btn" style="margin-top: 10px;">Save</button>
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
<style>

</style>
@endsection