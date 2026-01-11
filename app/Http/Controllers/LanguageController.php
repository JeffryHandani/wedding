<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch(string $locale)
    {
        $supported = config('invite.languages', []);
        if (in_array($locale, $supported)) {
            session(['locale' => $locale]);
        }
        return redirect()->back();
    }
}

