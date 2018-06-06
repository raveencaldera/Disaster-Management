<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;

class ReportController extends Controller
{
    public function index(Request $request)
    {   
        $levels = ['Severe', 'High', 'Elevated', 'Guarded', 'Low'];
        $levelCounts = [
            "Severe"        => 0,
            "High"          => 0,
            "Elevated"      => 0,
            "Guarded"       => 0,
            "Low"           => 0,
        ];

        $reports = Report::where('reporter_id', $request->user()->id)->get();

        foreach ($levels as $level) {
            $levelCounts[$level]    = Report::where('level', $level)->count();
        }

        $data = [
            "reports"   => $reports,
            "counts"    => $levelCounts
        ];

        return view('report.home', ['data' => $data]);
    }


    public function store(Request $request) {
        $validatedData = $request->validate([
            'place'     => 'required|min:4|max:255',
            'type'      => 'required|min:4|max:255',
            'lat'       => ['required', 'regex:/^(\+|-)?(?:90(?:(?:\.0{1,6})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,6})?))$/'],
            'long'      => ['required', 'regex:/^(\+|-)?(?:180(?:(?:\.0{1,6})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,6})?))$/'],
            'level'     => 'required',
            'description' => 'required|min:20|max:800'
        ]);

        Report::create([
            "place"             => $request->input('place'),
            "type"              => $request->input('type'),
            "lat"               => $request->input('lat'),
            "long"              => $request->input('long'),
            "level"             => $request->input('level'),
            "description"       => $request->input('description'),
            "reporter_id"       => $request->user()->id,
        ]);

        $request->session()->flash('alert-success', 'Report successfully added to review');
        return redirect()->route('report.index');
        
    }
    
    public function toggleStatus(Request $request) {
        if ($request->user()->role == 'admin' || $request->user()->role == 'manager') {
            $report = Report::find($request->input('id'));
            $report->status = !$report->status;
            $report->save();
            return redirect()->back();
        }

        return redirect()->back();
    }

    public function editView(Request $request) {
        $report = Report::find($request->input('id'));
        return view('report.edit', ['report'    => $report]);
    }

    public function updateReport(Request $request) {
        if ($request->user()->role == 'admin') {
            $report = Report::find($request->input('id'));
            $report->place = ($request->input('place')) ? $request->input('place') : $report->place;
            $report->type = ($request->input('type')) ? $request->input('type') : $report->type;
            $report->lat = ($request->input('lat')) ? $request->input('lat') : $report->lat;
            $report->long = ($request->input('long')) ? $request->input('long') : $report->long;
            $report->level = ($request->input('level')) ? $request->input('level') : $report->level;
            $report->description = ($request->input('description')) ? $request->input('description') : $report->description;
            $report->save();
            $request->session()->flash('alert-success', 'Report updated successfully');
            return redirect()->back();
        }

        return redirect()->back();
    }

    public function deleteReport(Request $request) {
        if ($request->user()->role == 'admin') {
            Report::destroy($request->input('id'));
            $request->session()->flash('alert-success', 'Report removed successfully');            
            return redirect()->back();                    
        }

        return redirect()->back();
    }

}
