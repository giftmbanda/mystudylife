@extends('layouts.app')

@section('content')
<div class="content-wrapper" ng-app="translateApp" ng-controller="translateController">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="header">
                        <h2>TRANSLATE</h2>
                    </div>

                    <form name="translate_form" id="translate_form" ng-submit="translate()">
                        {{ csrf_field() }}
                        <div class="form-group has-feedback">
                            <div class="row">
                                <div class="col-md-6 no-padding">
                                    <label for="from_language" class="col-md-12 control-label">From Language</label>
                                    <div class="col-md-12 input-group">
                                        <select 
                                            class="form-control" 
                                            name="from_language" 
                                            id="from_language"
                                            ng-model="from_language"
                                            ng-change="onFromChange(from_language)">
                                            <option value="">Select Language</option>
                                            <option ng-repeat="item in fromLanguages" ng-value="item.key"><% item.label %></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 no-padding">
                                    <label for="to_language" class="col-md-12 control-label">To Language</label>
                                    <div class="col-md-12 input-group">
                                        <select 
                                            class="form-control" 
                                            name="to_language" 
                                            id="to_language"
                                            ng-model="to_language">
                                            <option value="">Select Language</option>
                                            <option ng-repeat="item in toLanguages" ng-value="item.key"><% item.label %></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <br/>
                            <div class="form-group has-feedback row">
                                <label for="email" class="col-md-3 control-label">Original Text</label>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input id="original_text" class="form-control" placeholder="Translate text" name="original_text" type="text">
                                        <label class="input-group-addon" for="original_text"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group has-feedback row" ng-cloak ng-if="errors !== null">
                                <span class="help-block col-sm-12" ng-repeat="error in errors">
                                    <label class="error"><% error %></label>
                                </span>
                            </div>

                        </div>

                        <button ng-show="!loading" ng-cloak class="btn btn-primary waves-effect" type="submit">translate</button>
                        <button ng-show="loading" ng-cloak class="btn btn-primary waves-effect" type="button">loading ...</button>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <div ng-if="translation != null" class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="header">
                        <h5>Result</h5>
                    </div>

                    <div class="form-group has-feedback">
                        <div class="row">
                            <div class="col-md-12">
                                <h2><% translation.translatable ? translation.translated_text : translation.suggested_text %></h2>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>

    <div class="row" ng-cloack ng-show="translation && !translation.translatable && !translation.suggested_text">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="header">
                        <h2>What is your suggestion?</h2>
                    </div>

                    <form name="translate_form_suggest" id="translate_form_suggest" ng-submit="suggest()">
                        {{ csrf_field() }}
                        <div class="form-group has-feedback">

                            <br/>
                            <div class="form-group has-feedback row">
                                <label for="email" class="col-md-12 control-label">Suggested Translation</label>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input id="suggested_text" class="form-control" placeholder="Translate text" name="suggested_text" type="text">
                                        <label class="input-group-addon" for="suggested_text"></label>
                                        <input id="translation_id" ng-value="translation.id" name="translation_id" type="hidden">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <button ng-show="!sLoading" ng-cloak class="btn btn-primary waves-effect" type="submit">save</button>
                        <button ng-show="sLoading" ng-cloak class="btn btn-primary waves-effect" type="button">loading ...</button>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">My Tranlsations</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Original Text
                                    </th>
                                    <th>
                                        Translated Text
                                    </th>
                                    <th>
                                        Translatable
                                    </th>
                                    <th>
                                        Suggested Text
                                    </th>
                                    <th>
                                        Suggestion Approved?
                                    </th>
                                    <th>
                                        From Language
                                    </th>
                                    <th>
                                        To Language
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-cloack ng-repeat="translation in translations">
                                    <td class="font-weight-medium">
                                        <% $index + 1 %>
                                    </td>
                                    <td>
                                        <% translation.original_text %>
                                    </td>
                                    <td>
                                        <% translation.translated_text %>
                                    </td>
                                    <td>
                                       <% translation.translatable ? 'Yes' : 'No' %>
                                    </td>
                                    <td>
                                        <% translation.suggested_text ? translation.suggested_text : '---' %>
                                    </td>
                                    <td ng-if="translation.suggested_text">
                                        <% translation.suggestion_approved ? 'Yes' : 'No' %>
                                    </td>
                                    <td ng-if="!translation.suggested_text">
                                        ---
                                    </td>
                                    <td>
                                        <% getLabelForLanguage(translation.from_language) %>
                                    </td>
                                    <td>
                                        <% getLabelForLanguage(translation.to_language) %>
                                    </td>
                                </tr>
                                <tr ng-cloak ng-if="translations == null">
                                    <td colspan="7" class="font-weight-medium text-center">
                                        Nothing to show for now.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('js/angular/angular.min.js') }}"></script>
    <script src="{{ asset('js/angular/angular-sanitize.min.js') }}"></script>
    <script src="{{ asset('js/angular/ng-pickadate.js') }}"></script>
    <script src="{{ asset('js/underscore/underscore.min.js') }}"></script>
    <script src="{{ asset('js/moment/moment.js') }}"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.simpleWeather/3.1.0/jquery.simpleWeather.min.js"></script>
    <script>
        // Controller
        var translateApp = angular.module('translateApp', ['ngSanitize'], function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });

        translateApp.controller('translateController', ['$scope','$http', '$window', '$filter','$timeout' , function($scope, $http, $window, $filter, $timeout) {
            $scope.languages     = {!! $languages !!};
            $scope.fromLanguages   = {!! $languages !!};
            $scope.toLanguages     = {!! $languages !!};
            $scope.translations  = {!! $translations !!};
            $scope.translation   = null;
            $scope.loading       = false;
            $scope.errors        = null;

            $scope.translate = function() {

                var form = $('#translate_form');

                $.ajax({
                    type: "POST",
                    url: "/translation/create",
                    data: $(form).serialize(),
                    beforeSend: function() { 
                        $scope.loading = true;
                    },
                    success: function(response) {
                        $timeout(function(){
                            $scope.loading = false;
                            $scope.errors = null;
                            
                            // update my translations list
                            $scope.translations = response.translations
                            $scope.translation = response.translation
                        })
                    },
                    error: function(response) {
                        $timeout(function(){
                            $scope.errors = response.responseJSON.hasOwnProperty('errors') ? response.responseJSON.errors : ['An unknown error has occured, please try again later!'];
                            $scope.loading = false;
                            $scope.translation = null;
                        })
                    }

                });
            };

            $scope.suggest = function() {

                var form = $('#translate_form_suggest');

                $.ajax({
                    type: "POST",
                    url: "/translation/create-suggestion",
                    data: $(form).serialize(),
                    beforeSend: function() { 
                        $scope.sLoading = true;
                    },
                    success: function(response) {
                        $timeout(function() {

                            $scope.sLoading = false;
                            $scope.sErrors = null;

                            // update my translations list
                            $scope.translations = response.translations
                            $scope.translation = response.translation
                        })
                    },
                    error: function(response) {
                        $timeout(function(){
                            $scope.sErrors = response.responseJSON.hasOwnProperty('errors') ? response.responseJSON.errors : ['An unknown error has occured, please try again later!'];
                            $scope.sLoading = false;
                        })
                    }

                });
            };

            $scope.onFromChange = function(fromLanguage) {
                $scope.toLanguages = _.filter($scope.languages, function(l){ return l.key != fromLanguage; })
            };

            $scope.getLabelForLanguage = function(key) {
                switch (key) {
                    case 'en':
                        return 'English';
                    case 'zu':
                        return 'Zulu';
                    case 'st':
                        return 'Sesotho';
                    default:
                        return 'Unknown';
                }
            };
        }]);
    </script>
@endsection