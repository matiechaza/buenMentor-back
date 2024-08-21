<x-app-layout>
<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-4">My Bookings</h2>
        <div class="mb-6">
            <h3 class="text-xl font-semibold mb-2">As Learner</h3>
            @if ($menteeBookings->isEmpty())
                <p class="text-gray-600">You have no bookings as a learner.</p>
            @else
                <table class="min-w-full bg-white">
                    <thead>
                    <tr>
                        <th class="py-2">Mentor</th>
                        <th class="py-2">Date</th>
                        <th class="py-2">Time</th>
                        <th class="py-2">Amount</th>
                        <th class="py-2">Status</th>
                        <th class="py-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($menteeBookings as $booking)
                        <tr class="bg-gray-100">
                            <td class="py-2 px-4">
                                <a href="{{ route('mentors.show', $booking->mentor->id) }}" class="text-blue-500">
                                    {{ $booking->mentor->user->name }}
                                </a>
                            </td>
                            <td class="py-2 px-4">{{ $booking->day }}</td>
                            <td class="py-2 px-4">{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                            <td class="py-2 px-4">${{ $booking->amount }}</td>
                            <td class="py-2 px-4">{{ $booking->status }}</td>
                            <td class="py-2 px-4 flex space-x-2">
                                <a href="{{ route('bookings.show', $booking->id) }}" class="bg-blue-500 px-4 py-1 rounded-lg">View</a>
                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 px-4 py-1 rounded-lg">Cancel</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $menteeBookings->links() }}
            @endif
        </div>

        <div>
            <h3 class="text-xl font-semibold mb-2">As Mentor</h3>
            @if ($mentorBookings->isEmpty())
                <p class="text-gray-600">You have no bookings as a mentor.</p>
            @else
                <table class="min-w-full bg-white">
                    <thead>
                    <tr>
                        <th class="py-2">Learner</th>
                        <th class="py-2">Date</th>
                        <th class="py-2">Time</th>
                        <th class="py-2">Amount</th>
                        <th class="py-2">Status</th>
                        <th class="py-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($mentorBookings as $booking)
                        <tr class="bg-gray-100">
                            <td class="py-2 px-4">{{ $booking->mentee->name }}</td>
                            <td class="py-2 px-4">{{ $booking->day }}</td>
                            <td class="py-2 px-4">{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                            <td class="py-2 px-4">${{ number_format($booking->amount, 2) }}</td>
                            <td class="py-2 px-4">{{ $booking->status }}</td>
                            <td class="py-2 px-4">
                                <a href="{{ route('bookings.show', $booking->id) }}" class="bg-blue-500 px-4 py-1 rounded-lg">View</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $mentorBookings->links() }}
            @endif
        </div>
    </div>
</div>
</x-app-layout>
