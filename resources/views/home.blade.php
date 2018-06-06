@extends('layouts.app')

@section('content')
 <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $data["counts"]["Low"] }}</div>
                            <div>Low</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $data["counts"]["High"] }}</div>
                            <div>High</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $data["counts"]["Elevated"] }}</div>
                            <div>Elevated</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-support fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $data["counts"]["Severe"] }}</div>
                            <div>Severe</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->

    @if (Auth::user()->role === "admin" || Auth::user()->role === "manager")
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Pending Reports</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                <th>Title</th>
                                <th>Area</th>
                                <th>Threat Level</th>
                                <th>Reporter</th>
                                <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($data["reports"] as $report)
                                <tr>
                                    <td>{{ $report->type }}</td>
                                    <td>{{ $report->place }}</td>
                                    <td>{{ $report->level }}</td>
                                    <td>{{ $report->reporter->name }}</td>
                                    <td class="option-link">
                                        <a class="btn btn-danger btn-sm" href="{{ route('report.delete', ['id'  => $report->id]) }}" role="button">Delete</a>
                                        <a class="btn btn-warning btn-sm" href="{{ route('report.edit', ['id'  => $report->id]) }}" role="button">Edit</a>
                                        <!-- <a class="btn btn-primary btn-sm" href="#" role="button">Review</a> -->
                                        @if ($report->status)
                                            <a class="btn btn-danger btn-sm" href="{{ route('report.toggle', ['id'  => $report->id]) }}" role="button">Disable</a>
                                        @else
                                            <a class="btn btn-success btn-sm" href="{{ route('report.toggle', ['id'  => $report->id]) }}" role="button">Approve</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- /.row -->
@endsection
