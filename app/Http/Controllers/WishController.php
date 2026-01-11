<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wish;

class WishController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $wish = Wish::create($data);

        return response()->json(['ok' => true, 'wish' => $wish]);
    }
}

