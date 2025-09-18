<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ConfirmParticipantController extends Controller
{
    public function show($token)
    {
        $participant = Participant::where('token', $token)->firstOrFail();

        if ($participant->confirmed_at) {
            return view('participant.already_confirmed', compact('participant'));
        }

        // tampilan form untuk melengkapi data diri
        return view('participant.confirm', compact('participant'));
    }

    public function store(Request $request, $token)
    {
        $participant = Participant::where('token', $token)->firstOrFail();

        if ($participant->confirmed_at) {
            return redirect()->route('participant.confirm.show', $token)
                             ->with('status', 'Sudah dikonfirmasi sebelumnya.');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            // tambahkan field lain yg ingin dikumpulkan
            'phone' => 'nullable|string|max:50',
            'meta' => 'nullable|array',
        ]);

        // Opsional: pastikan email input sama dengan email yang diundang
        if ($data['email'] !== $participant->email) {
            return back()->withErrors(['email' => 'Email harus sama dengan email undangan.']);
        }

        $participant->confirm([
            'name' => $data['name'],
            'meta' => $data['meta'] ?? null,
        ]);

        return view('participant.thanks', ['participant' => $participant]);
    }
}
