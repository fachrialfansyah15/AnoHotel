<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // Admin, Manajer, Resepsionis — lihat semua
    public function index()
    {
        $payments = Payment::with('reservation.user')->latest()->get();
        return view('payments.index', compact('payments'));
    }

    // Tamu — lihat pembayaran milik sendiri
    public function myPayments()
    {
        $payments = Payment::whereHas('reservation', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->with('reservation.room')
            ->latest()
            ->get();
        return view('payments.my', compact('payments'));
    }

    public function create()
    {
        // Hanya tampilkan reservasi yang belum dibayar
        $reservations = Reservation::whereDoesntHave('payment')
            ->orWhereHas('payment', fn($q) => $q->where('status', 'unpaid'))
            ->with('user')
            ->get();
        return view('payments.create', compact('reservations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'amount'         => 'required|numeric|min:0',
            'method'         => 'required|in:cash,transfer,card',
            'status'         => 'required|in:unpaid,paid,refunded',
        ]);

        $data = $request->all();
        if ($data['status'] === 'paid') {
            $data['paid_at'] = now();
        }

        Payment::create($data);
        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dicatat.');
    }

    public function show(Payment $payment)
    {
        return view('payments.show', $payment->load('reservation.room'));
    }

    public function edit(Payment $payment)
    {
        return view('payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'method' => 'required|in:cash,transfer,card',
            'status' => 'required|in:unpaid,paid,refunded',
        ]);

        $data = $request->all();
        if ($data['status'] === 'paid' && !$payment->paid_at) {
            $data['paid_at'] = now();
        }

        $payment->update($data);
        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil diupdate.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}