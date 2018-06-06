<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = ['Severe', 'High', 'Elevated', 'Guarded', 'Low'];
        $levelCounts = [
            "Severe"        => 0,
            "High"          => 0,
            "Elevated"      => 0,
            "Guarded"       => 0,
            "Low"           => 0,
        ];

        $reports = Report::all();

        foreach ($levels as $level) {
            $levelCounts[$level]    = Report::where('level', $level)->count();
        }

        

        $data = [
            "reports"   => $reports,
            "counts"    => $levelCounts
        ];

        return view('home', ['data' => $data]);
    }

    public function home() {
        $reports = Report::where('status', true)->get();

        return view('disaster.index', ['reports'    => $reports]);
    }
}
