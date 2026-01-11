<?php

namespace App\Http\Controllers;

use App\Models\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class InvitationController extends Controller
{
    public function index(Request $request)
    {
        $invite = Config::get('invite');

        $locale = session('locale', config('app.locale'));
        App::setLocale($locale);

        $guestName = $request->query('to');

        $date = Carbon::createFromFormat('Y-m-d H:i',
            $invite['event']['date'] . ' ' . $invite['event']['time'],
            $invite['event']['timezone']
        );
        $eventTimestamp = $date->copy()->timezone('UTC')->timestamp;

        try {
            $wishes = Wish::latest()->limit(20)->get();
        } catch (\Throwable $e) {
            $wishes = collect();
        }

        return view('invite', [
            'invite' => $invite,
            'guestName' => $guestName,
            'eventTimestamp' => $eventTimestamp,
            'locale' => $locale,
            'languages' => $invite['languages'],
            'wishes' => $wishes,
        ]);
    }
}
