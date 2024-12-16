<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $user = User::find(session('user_id'));
        $appointments = $user->appointments()
            ->where('start', '>=', now())
            ->orderBy('start')
            ->get()
            ->map(function ($appointment) use ($user) {
                $appointment->start = Carbon::parse($appointment->start)
                    ->setTimezone($user->preferred_timezone);
                $appointment->end = Carbon::parse($appointment->end)
                    ->setTimezone($user->preferred_timezone);
                return $appointment;
            });

        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $users = User::where('id', '!=', session('user_id'))->get();
        return view('appointments.create', compact('users'));
    }

    public function store(Request $request)
    {
        $creator = User::find(session('user_id'));

        // Convert input times to UTC
        $start = Carbon::parse($request->start, $creator->preferred_timezone)->setTimezone('UTC');
        $end = Carbon::parse($request->end, $creator->preferred_timezone)->setTimezone('UTC');

        // Validate working hours for all participants
        $participants = User::whereIn('id', $request->participants)->get();
        foreach ($participants as $participant) {
            $participantStart = Carbon::parse($start)->setTimezone($participant->preferred_timezone);
            $participantEnd = Carbon::parse($end)->setTimezone($participant->preferred_timezone);

            if ($participantStart->hour < 8 || $participantEnd->hour > 17) {
                return back()->withErrors(['time' => 'Waktu appointment diluar jam kerja untuk beberapa peserta']);
            }
        }

        $appointment = Appointment::create([
            'title' => $request->title,
            'creator_id' => $creator->id,
            'start' => $start,
            'end' => $end
        ]);

        $appointment->participants()->attach($request->participants);
        $appointment->participants()->attach($creator->id);

        return redirect()->route('appointments.index');
    }
}
