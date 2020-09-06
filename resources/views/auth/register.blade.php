@extends('layouts.appClean')

@section('content')
<div ng-app="registerApp" ng-controller="registerController" class="content-wrapper d-flex align-items-center auth auth-bg-3 theme-one">
    <div class="row w-100">
        <div class="col-sm-6 col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
                <div class="logo-wrapper">
                    <h2 class="text-center mb-4">Register</h2>
                    <br/>
                </div>
                {!! Form::open(['route' => 'register', 'novalidate'=>'novalidate', 'id'=>'sign_up', 'role' => 'form', 'method' => 'POST', 'enctype' => 'multipart/form-data'] ) !!}
                    {{ csrf_field() }}
                    @if ($errors->any())
                        <div class="form-group">
                            @foreach ($errors->all() as $error)
                                <span class="help-block">
                                    <label class="error">{{ $error }}</label>
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <div ng-cloak ng-if="passwordError" class="form-group">
                        <span class="help-block">
                            <label class="error"><% passwordError %></label>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{ old('first_name') }}" name="first_name" placeholder="First Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{ old('last_name') }}" name="last_name" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                        <input 
                            type="text" 
                            class="form-control" 
                            name="id_number"
                            ng-model="id_number" 
                            ng-change="stripID(id_number)"
                            placeholder="ID Number" 
                            required>
                        </div>
                    </div>

                    <div class="form-group" style="pointer-events: none">
                        <div class="input-group">
                        <input 
                            type="text" 
                            class="form-control" 
                            ng-model="gender" 
                            placeholder="---" 
                            required>
                        </div>
                    </div>

                    <div class="form-group">
                        <select name="course_id" class="form-control form-control-line">
                            <option value="">Select Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->c_id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                        <input 
                            type="password" 
                            class="form-control" 
                            name="password" 
                            placeholder="Password"
                            ng-model="password"
                            ng-change="onChangePassword(password)"
                            required>
                        
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                        <input 
                            type="password" 
                            class="form-control" 
                            name="password_confirmation" 
                            placeholder="Confirm Password" 
                            ng-model="password_confirmation"
                            ng-change="onChangePassword(password_confirmation)"
                            required>
                        
                        </div>
                    </div>
                    <!-- <div class="form-group">
                      <label>Profile Picture</label>
                      <div class="input-group">
                        <input type="file" name="profile_picture" class="form-control file-upload-info" placeholder="Upload Image">
                      </div>
                    </div> -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary submit-btn btn-block">Register</button>
                    </div>
                    <div class="text-block text-center my-3">
                        <span class="text-small font-weight-semibold">Already have and account ?</span>
                        <a href="{{ url('/login') }}" class="text-black text-small">Login</a>
                    </div>
                {!! Form::close() !!}
            </div>
            <ul class="auth-footer"></ul>
            <!-- <p class="footer-text text-center" style="color: black;">© 2019 blasczykowski.io</p> -->
        </div>
    </div>
</div>
@endsection

@section('script')
    
    <script src="{{ asset('js/angular/angular.min.js') }}"></script>
    <script src="{{ asset('js/angular/angular-sanitize.min.js') }}"></script>
    <script src="{{ asset('js/underscore/underscore.min.js') }}"></script>

    <script>
    (function () {

            // Controller
            var registerApp = angular.module('registerApp', ['ngSanitize'], function($interpolateProvider) {
                $interpolateProvider.startSymbol('<%');
                $interpolateProvider.endSymbol('%>');
            });

            registerApp.controller('registerController', ['$scope','$http', '$window', '$filter','$timeout' , function($scope, $http, $window, $filter, $timeout) {

                $scope.passLength  = 0;
                $scope.passLengthT = 0;
                $scope.gender      = "---";

                $scope.stripID = function(idNumber) {
                    
                    if (idNumber == "") {
                        $scope.isMale = null;
                        $scope.gender = "---";
                        return;
                    }

                    var gender = idNumber.substr(6, 4),
                        dob    = idNumber.substr(0, 6),
                        isMale = null
                        
                    if (gender >= 0000 && gender <= 4999) {
                        isMale = false;
                    } else if (gender >= 5000 && gender <= 9999) {
                        isMale = true;
                    }

                    var data = {
                        dob: dob,
                        gender: isMale ? 'Male' : 'Female'
                    };

                    $scope.isMale = isMale;
                    $scope.gender = data.gender;
                }

                $scope.onChangeTrigger = function(trigger) {

                    $timeout(()=> $('#register-death_trigger_id').selectpicker('refresh'));
                };

                $scope.onChangePassword = function(password) {

                    if (password.length < 6) {
                        $scope.passwordError = 'Please enter password with at least 6 characters or more'
                    } else {
                        $scope.passwordError = null
                    }
                };

                $scope.updateQualification = function() {
                    console.log("updateQualification", $scope.qualification)
                };

            }]);
        })();
    </script>
@endsection