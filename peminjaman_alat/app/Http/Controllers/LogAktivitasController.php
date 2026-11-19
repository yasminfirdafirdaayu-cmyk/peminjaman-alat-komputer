<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index(Request $request)
    {
        // Hanya Admin yang boleh melihat log aktivitas.
        abort_unless(
            auth()->check() && auth()->user()->role === 'admin',
            403
        );

        $aktivitas = LogAktivitas::with('user')
            ->latest()
            ->paginate(20);

        return view('log-aktivitas.index', compact('aktivitas'));
    }
}