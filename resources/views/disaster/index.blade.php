<?php 

    function returnColor($level) {
        $data = [
            "Severe"        => 'red',
            "High"          => 'orange',
            "Elevated"      => 'yellow',
            "Guarded"       => 'blue',
            "Low"           => 'green',
        ];

        return $data[$level];
    }

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    
    <link rel="stylesheet" href="css/style.css">
    <title>Ministry of Disaster Management</title>
  </head>
  <body>
  
  <div class="logo-container">
    <div class="container">
        <img class="logo-img" src="img/logo2.png" alt="logo">
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #887F34;">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <ul class="navbar-nav mr-auto">
                    @if (!Auth::guest())
                    <li class="nav-item">
                        <a href="{{ url('/dashboard') }}" class="nav-link white"><span style="font-weight: bold;">{{ Auth::user()->name }}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout">Logout<span class="sr-only">(current)</span></a>
                    </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="login">Login<span class="sr-only">(current)</span></a>
                        </li>
                    @endif
                </ul>
            </div> <!-- /form-inline my-2 my-lg-0 -->
        </div> <!-- /collapse navbar-collapse -->
    </div> <!-- /container -->
</nav>

<div class="container main">
    <div class="row">
        <div class="col col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    Current Natural Disasters and Prone Areas
                </div>
                <div class="card-body">
                    <div id="map"></div>
                </div>
            </div> <!-- /card -->
        </div>
    </div> <!-- /END row -->

    <div class="row" style="margin-top: 10px;">
    <div class="col col-md-12 col-sm-12">
            <div class="list-group threat-list">
                @foreach ($reports as $report) 
                    <div class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $report->place }}</h5>
                        <div style="display: inline-flex;">
                            <span class="circle {{ returnColor($report->level) }}"></span><small> {{ Carbon\Carbon::parse($report->created_at)->diffForHumans() }}</small>
                        </div>
                            
                        </div>
                        <p class="mb-1">{{ $report->type }}</p>
                        <hr>
                        <p class="mb-1">{{ $report->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

<footer>
  <div class="container">
    <div class="row">
      <div class="col col-md-4 col-sm-12">
        <h5>About Ministry</h5>
        <hr>
        <p>
          Facilitating the activities on disaster prevention, mitigation, preparedness measures and early response for population vulnerable to disasters and the facilitation of overall coordination of post-disaster activities such as relief, rehabilitation and reconstruction are the main activities of the Disaster Management Division of the Ministry.
        </p>
      </div>
      <div class="col col-md-4 col-sm-12">
        <h5>Useful Links</h5>
        <hr>
        <ul class="useful-links">
          <li><a href="#">Government Information Center</a></li>
          <li><a href="#">Department of Meteorology</a></li>
          <li><a href="#">Disaster Management Centre</a></li>
          <li><a href="#">National Building Research Organisation</a></li>
          <li><a href="#">National Disaster Relief Services Centre</a></li>
        </ul>
      </div>
      <div class="col col-md-4 col-sm-12">
        <h5>Emergency Contacts</h5>
        <hr>
        <ul class="useful-links">
          <li>General Hotline:  +94-112-665170</li>
          <li>National Council:  +94-112-665185</li>
          <li>Government Information Center:  1919</li>
        </ul>
      </div>
    </div>
  </div>
</footer>

    <!-- Optional JavaScript -->
    <script>
        function initMap() {
        var uluru = {lat: 7.8731, lng: 80.7718};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 7,
            center: uluru
        });

        var locations = [
            @foreach ($reports as $report)
                { lat: parseFloat("{{ $report->lat }}"), lng: parseFloat("{{ $report->long }}") }, 
            @endforeach
        ];

        for (var i = 0; i < locations.length; i++) {
            var marker = new google.maps.Marker({
                position: locations[i],
                map: map
            });
        }

        console.log(locations);
        
        }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8x7Pz0Di68hJ9Q_tP-FUrL7a4WqSDDj8&callback=initMap">
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>