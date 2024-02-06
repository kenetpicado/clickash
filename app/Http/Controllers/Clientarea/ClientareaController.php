<?php

namespace App\Http\Controllers\Clientarea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientareaController extends Controller
{
    public function __invoke(Request $request)
    {
        return redirect()->route('clientarea.raffles.index');
    }
}
