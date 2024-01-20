<?php

namespace App\Http\Controllers;

use App\Models\OldacName;
use Illuminate\Http\Request;

class DataTestController extends Controller
{
    public function index()
    {
        $oldacnames = OldacName::latest()->paginate();
        // $oldacnames = OldacName::with('oldacType')->latest()->paginate();

        return view('dataTests.index', compact('oldacnames'));
    }
}
