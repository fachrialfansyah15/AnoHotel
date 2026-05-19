<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * ADMIN / MANAGER / RECEPTIONIST
     */
    public function index()
{
    $payments = Payment::with([
        'reservation.user',
        'reservation.room'
    ])->latest()->get();

    $reservations = Reservation::with([
        'user',
        'room'
    ])->get();

    return view(
        'payments.index',
        compact('payments', 'reservations')
    );
}

    /**
     * GUEST
     */
    public function myPayments()
    {
        $this->authorize('view-own-payments');

        $payments = Payment::whereHas(
            'reservation',
            function ($query) {
                $query->where(
                    'user_id',
                    Auth::id()
                );
            }
        )
        ->with('reservation.room')
        ->latest()
        ->get();

        return view(
            'payments.my',
            compact('payments')
        );
    }

    /**
     * CREATE
     */
   public function create()
{
    $reservations = Reservation::with([
        'user',
        'room'
    ])->get();

    return view(
        'payments.create',
        compact('reservations')
    );
}

    /**
     * STORE
     */
    public function store(Request $request)
{
    $this->authorize('manage-payments');

    $validated = $request->validate([
        'reservation_id' => 'required|exists:reservations,id',
        'amount' => 'required|numeric|min:0',
        'method' => 'required|in:cash,transfer,card',
        'status' => 'required|in:unpaid,paid,refunded',
    ]);

    if ($validated['status'] === 'paid') {
        $validated['paid_at'] = now();
    } else {
        $validated['paid_at'] = null;
    }

    Payment::create($validated);

    return redirect()
        ->route('payments.index')
        ->with('success', 'Payment created successfully.');
}

    /**
     * SHOW
     */
    public function show(Payment $payment)
    {
        if (
            Auth::user()->role === 'guest' &&
            $payment->reservation->user_id !== Auth::id()
        ) {
            abort(403);
        }

        $payment->load([
            'reservation.user',
            'reservation.room'
        ]);

        return view(
            'payments.show',
            compact('payment')
        );
    }

    /**
     * EDIT
     */
    public function edit(Payment $payment)
    {
        $this->authorize('manage-payments');

        return view(
            'payments.edit',
            compact('payment')
        );
    }

    /**
     * UPDATE
     */
    public function update(
        Request $request,
        Payment $payment
    ) {
        $this->authorize('manage-payments');

        $request->validate([
            'amount' => 'required|numeric|min:0',
            'method' => 'required|in:cash,transfer,card',
            'status' => 'required|in:unpaid,paid,refunded',
        ]);

        $data = [
            'amount' => $request->amount,
            'method' => $request->method,
            'status' => $request->status,
        ];

        if (
            $request->status === 'paid' &&
            !$payment->paid_at
        ) {
            $data['paid_at'] = now();
        }

        $payment->update($data);

        if (Auth::user()->role === 'guest') {

    return redirect()
        ->route('payments.my')
        ->with(
            'success',
            'Payment updated successfully.'
        );
}

return redirect()
    ->route('payments.index')
    ->with(
        'success',
        'Payment updated successfully.'
    );
    }

    /**
     * DELETE
     */
    public function destroy(Payment $payment)
    {
        $this->authorize('manage-payments');

        $payment->delete();

        if (Auth::user()->role === 'guest') {

    return redirect()
        ->route('payments.my')
        ->with(
            'success',
            'Payment deleted successfully.'
        );
}

return redirect()
    ->route('payments.index')
    ->with(
        'success',
        'Payment deleted successfully.'
    );
    }
}