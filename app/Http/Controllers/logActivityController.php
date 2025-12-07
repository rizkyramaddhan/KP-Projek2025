<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogActivity;

class logActivityController extends Controller
{
    public function index(){
        $logActivities = LogActivity::orderBy('created_at', 'desc')->paginate(10);
        $totalLogActivity = LogActivity::count();

        return view('logactivity.index', compact('logActivities', 'totalLogActivity'));
    }
}
