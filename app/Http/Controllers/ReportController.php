<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index'); // Mengarahkan ke view 'reports/index.blade.php'
    }
}
