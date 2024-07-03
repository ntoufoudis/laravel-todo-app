<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        if (auth()->guest()) {
            return view('home', [
                'todos' => session()->get('todos'),
            ]);
        }

        return view('home', [
            'todos' => Todo::paginate(5),
        ]);
    }
}
