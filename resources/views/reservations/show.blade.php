<h1>{{ $reservation->room->name }}</h1>

<p>
    Guest:
    {{ $reservation->user->name }}
</p>

<p>
    Check In:
    {{ $reservation->check_in }}
</p>

<p>
    Check Out:
    {{ $reservation->check_out }}
</p>

<p>
    Status:
    {{ $reservation->status }}
</p>