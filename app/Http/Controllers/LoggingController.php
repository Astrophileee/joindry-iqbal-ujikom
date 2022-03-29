<?php

namespace App\Http\Controllers;

use App\Models\Logging;
use Illuminate\Http\Request;

class LoggingController extends Controller
{
    public function index()
    {
        return view('admin.logging.index',[
            'logging' => Logging::all()
        ]);
    }
}
