<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function ics()
    {
        $invite = Config::get('invite');
        $date = Carbon::createFromFormat('Y-m-d H:i',
            $invite['event']['date'] . ' ' . $invite['event']['time'],
            $invite['event']['timezone']
        );
        $end = $date->copy()->addMinutes($invite['calendar']['duration_minutes'] ?? 120);

        $uid = uniqid('wedding-', true);
        $ics = "BEGIN:VCALENDAR\nVERSION:2.0\nPRODID:-//Wedding Invitation//EN\n".
            "BEGIN:VEVENT\n".
            "UID:$uid\n".
            "DTSTAMP:".$date->copy()->timezone('UTC')->format('Ymd\THis\Z')."\n".
            "DTSTART:".$date->copy()->timezone('UTC')->format('Ymd\THis\Z')."\n".
            "DTEND:".$end->copy()->timezone('UTC')->format('Ymd\THis\Z')."\n".
            "SUMMARY:".$invite['event']['title']."\n".
            "LOCATION:".$invite['event']['venue_name'].' - '.$invite['event']['venue_address']."\n".
            "DESCRIPTION:".$invite['event']['general_info']."\n".
            "END:VEVENT\nEND:VCALENDAR\n";

        return response($ics, 200, [
            'Content-Type' => 'text/calendar; charset=utf-8',
        ]);
    }
}

