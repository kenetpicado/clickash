<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        if (auth()->user()->role == 'root') {
            return redirect()->route('dashboard.index');
        } else {
            return redirect()->route('clientarea.index');
        }
    }
}
