<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rsvp;
use App\Models\Wish;

class AdminController extends Controller
{
    public function index()
    {
        if (!session('admin')) {
            return view('admin');
        }
        try {
            $rsvps = Rsvp::latest()->get();
            $wishes = Wish::latest()->get();
        } catch (\Throwable $e) {
            $rsvps = collect();
            $wishes = collect();
        }
        return view('admin', ['rsvps' => $rsvps, 'wishes' => $wishes]);
    }

    public function loginSubmit(Request $request)
    {
        $password = $request->input('password');
        $configured = env('ADMIN_PASSWORD');
        if (!$configured) {
            return redirect()->route('admin.index')->with('admin_error', 'Admin password not configured. Set ADMIN_PASSWORD in .env');
        }
        if ($password && $password === $configured) {
            session(['admin' => true]);
            return redirect()->route('admin.index');
        }
        return redirect()->route('admin.index')->with('admin_error', 'Invalid password');
    }

    public function logout()
    {
        session()->forget('admin');
        return redirect()->route('admin.index');
    }

    public function data()
    {
        if (!session('admin')) {
            return response()->json(['ok' => false], 403);
        }
        try {
            $rsvps = Rsvp::latest()->get();
            $wishes = Wish::latest()->get();
        } catch (\Throwable $e) {
            $rsvps = collect();
            $wishes = collect();
        }
        return response()->json([
            'ok' => true,
            'rsvps' => $rsvps,
            'wishes' => $wishes,
        ]);
    }
}
