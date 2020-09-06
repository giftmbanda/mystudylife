@extends('layouts.app')

@section('css')
    <link 
    rel="stylesheet" 
    href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
    integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
    crossorigin=""/>
    <style>
        #gmap_basic_example {
            height:400px;
            width:100%;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid" ng-app="checkinApp" ng-controller="checkinController">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Attend A session</h4> 
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- row -->

        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">My Subjects</h3>
                    <p ng-show="message"><% message %></p>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <br/>
                            <a class="btn btn-primary submit-btn btn-block" href="https://locate-me.herokuapp.com/location?backUrl={{ url()->current() }}">Update My Location</a>
                        </div>
                        <div ng-cloak ng-if="isInClass" class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <br/>
                            <a class="btn btn-primary submit-btn btn-block" href="{{ route('user.attend', $subject->s_id) }}">Check In</a>
                        </div>
                    </div>
                    <br/>
                    <div id="gmap_basic_example" style="z-index:1;" class="gmap"></div>
                    <div ng-cloak ng-show="isLoading">
                        <p>Loading ...</p>
                    </div>
                </div>
            </div>

        </div>
       
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <!-- <footer class="footer text-center"> 2017 © Pixel Admin brought to you by wrappixel.com </footer> -->
@endsection
@section('scripts')
    @parent
    
    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('theme/pixel-html/js/dashboard1.js') }}"></script>
    <script src="{{ asset('theme/plugins/bower_components/toast-master/js/jquery.toast.js') }}"></script>

    <script src="{{ asset('js/angular/angular.min.js') }}"></script>
    <script src="{{ asset('js/angular/angular-sanitize.min.js') }}"></script>
    <script src="{{ asset('js/underscore/underscore.min.js') }}"></script>
    
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
    integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
    crossorigin=""></script>
    
    <script>
        // Controller
        var checkinApp = angular.module('checkinApp', ['ngSanitize'], function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });

        
        checkinApp.controller('checkinController', ['$scope','$http', '$window', '$filter','$timeout', '$compile', function($scope, $http, $window, $filter, $timeout, $compile) {
            $scope.message = null;
            $scope.isLoading = false;
            $scope.radius = 5

            // Custom Map settings
            $scope.radiusLayer          = null;
            $scope.myLocationMarker     = null;
            $scope.markers              = [];

            $scope.isInClass = false;


            $scope.initMarkers = function(currentPosition) {
                $scope.markers = _.map($scope.venues, function(location) {

                    var icon = new L.Icon.Default();
                        icon.options.shadowSize = [0,0];

                    var marker = L.marker(location, {icon : icon})

                    var distance = (marker.getLatLng().distanceTo(currentPosition) / 1000).toFixed(2);
                    
                    var popHtml = `
                        <strong>Name:</strong> ${location.title} <br>
                        <strong>Location:</strong> ${location.location}<br> 
                        <strong>Distance:</strong> ${distance} KM from your location<br>
                        `;
                    
                    marker.bindPopup(popHtml);

                    return marker;
                })
            };

            $scope.updateStatus = function() {
                /** 
                 * is the user anywhere inside the radius of the given venue?
                 * */
                
                // we get the radius of the circle in metres
                var radius = $scope.radiusLayer.getRadius();

                // lets get the center of the the circle
                var circleCenterPoint = $scope.radiusLayer.getLatLng();

                // determine if the given location is in bounds
                var isInCircleRadius = Math.abs(circleCenterPoint.distanceTo($scope.myLocationMarker.getLatLng()))

                $scope.initMarkers($scope.myLocationMarker.getLatLng());

                // Add markers to map
                _.map($scope.markers, function(marker) { $scope.map.addLayer(marker) })

                if (isInCircleRadius <= radius) {
                    // hip hoorray you are inside the circle, meaning you are in class
                    // now that youre in class, we can now log your attendance, remember that a session also has time
                    // when you get there and you are quite late, then oops

                    //@TODO post create attendance for this user
                    console.warn("You are in class FAM")
                    $timeout(function(){
                        $scope.isInClass = true;
                    })
                } else {
                    console.warn("You are not class FAM")
                    $timeout(function(){
                        $scope.isInClass = false;
                    })
                }
            };

            var LeafIcon = L.Icon.extend({
                options: {
                    iconSize:     [20, 20],
                    iconAnchor:   [22, 94],
                    popupAnchor:  [-3, -76]
                }
            });

            $scope.eventLocation = {
                lat: {!! $venue->latitude !!},
                lng: {!! $venue->longitude !!},
                title: "{{ $venue->name }}",
                location: "{{ $venue->location }}"
            }

            $scope.venues = [
                $scope.eventLocation
            ]

            var url = new URL(window.location.href);
            var location = url.searchParams.get("location");

            $scope.myLocation = {
                lat: location ? JSON.parse(location).lat : 0,
                lng: location ? JSON.parse(location).lng : 0
            };


            // Initialise map
            $scope.map = L.map('gmap_basic_example').setView($scope.myLocation, 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo($scope.map);

            // Gonna add our current location marker on the map
            var myIcon = L.icon({
                iconUrl: 'http://www.robotwoods.com/dev/misc/bluecircle.png',
                iconSize: [20, 20],
                shadowSize: [20, 20],
            });

            $scope.myLocationMarker = L.marker($scope.myLocation, { icon: myIcon, draggable:'true' })
                .addTo($scope.map)
                .bindPopup('You are here. <br> <small>You can drag me to change your current location</small>');

            $scope.myLocationMarker.on('dragend', function(event){
                var _marker = event.target;
                var position = _marker.getLatLng();
                _marker.setLatLng(new L.LatLng(position.lat, position.lng),{draggable:'true'});
                $scope.map.panTo(new L.LatLng(position.lat, position.lng))

                // update current location
                $scope.myLocation = position

                // Update markers
                // $scope.initMarkers(_marker.getLatLng());

                $scope.updateStatus()
            });

            // Update the map wit your new location
            $scope.map.panTo($scope.myLocationMarker.getLatLng());

            // Update Radius Circle, but first we remove the current one
            $scope.radiusLayer = L.circle($scope.eventLocation, $scope.radius).addTo($scope.map);

            $scope.updateStatus();
        }]);
    </script>
@endsection