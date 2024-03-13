<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class ReportController extends Controller
{
    public function pullReport(Request $request)
    {
        $report = Report::all();

        return view('report.pullreport',compact('report'));
    }
}
