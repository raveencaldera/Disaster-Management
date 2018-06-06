@extends('layouts.app')

@section('content')
<div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Add Report</h3>
            </div>
            <div class="panel-body">
                <div class="col col-md-6 col-lg 6">
                    <form action="{{ url('/report') }}" method="POST" class="form-horizontal">
                        <div class="form-group">
                            <label for="inputPlace" class="col-sm-2 control-label">Area</label>
                            <div class="col-sm-10">
                            <input name="place" value="{{ old('place') }}" type="text" class="form-control" id="inputPlace" placeholder="Breif detail about affected area">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputType" class="col-sm-2 control-label">Type</label>
                            <div class="col-sm-10">
                            <input name="type" value="{{ old('type') }}" type="text" class="form-control" id="inputType" placeholder="Earthquakes, Tsunamis, Flooding and etc.">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputLat" class="col-sm-2 control-label">Latitude</label>
                            <div class="col-sm-10">
                            <input name="lat" value="{{ old('lat') }}" type="text" class="form-control" id="inputLat" placeholder="Most sutiable latitude of area">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputLong" class="col-sm-2 control-label">Longitude</label>
                            <div class="col-sm-10">
                            <input name="long" value="{{ old('long') }}" type="text" class="form-control" id="inputLong" placeholder="Most sutiable longitude of area">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputDescription" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                            <textarea name="description" cols="30" rows="10" class="form-control" id="inputDescription" placeholder="Breif description about situation">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputDescription" class="col-sm-2 control-label">Threat Level</label>
                            <div class="col-sm-10">
                                <label class="radio-inline">
                                    <input type="radio" name="level" id="inlineRadio1" value="Severe"> Severe
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="level" id="inlineRadio2" value="High"> High
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="level" id="inlineRadio3" value="Elevated"> Elevated
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="level" id="inlineRadio3" value="Guarded"> Guarded
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="level" id="inlineRadio3" value="Low"> Low
                                </label>
                            </div>
                        </div>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Inform</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col col-md-6 col-lg-6">
                    <div id="map" style="height:350px;"></div>
                </div>
            </div>
        </div>
    <div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Reports</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Area</th>
                                <th>Type</th>                                
                                <th>Threat Level</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data["reports"] as $report)
                            <tr>
                                <td>{{ $report->place }}</td>
                                <td>{{ $report->type }}</td>
                                <td>{{ $report->level }}</td>
                                <td>{{ ($report->status) ? 'Verified' : 'pending verification' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
    <script>
    function initMap() {
        var uluru = {lat: 7.8731, lng: 80.7718};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 7,
            center: uluru
        });

        var marker = new google.maps.Marker({
            position: uluru,
            map: map,
            draggable: true
        });

        google.maps.event.addListener(marker, 'dragend', function(mEvent) { populateInputs(mEvent.latLng.lat().toFixed(4), mEvent.latLng.lng().toFixed(4),); } );
    }

    function populateInputs(lat, long) {
        document.getElementById("inputLat").value = lat;
        document.getElementById("inputLong").value = long;
    }
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8x7Pz0Di68hJ9Q_tP-FUrL7a4WqSDDj8&callback=initMap">
</script>
@endsection