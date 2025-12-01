<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogActivity;

class logActivityController extends Controller
{
    public function index(){
        $logs = LogActivity::latest()->paginate(20);
        return view('logactivity.index', compact('logs'));
    }
}
