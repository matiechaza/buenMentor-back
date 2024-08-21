<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-12">
            <div class="px-4 py-5 sm:p-6 bg-white">
                <h2 class="text-2xl font-semibold mb-4">Booking Details</h2>
                <div class="mb-4">
                    <h3 class="text-xl font-semibold mb-2">Mentor</h3>
                    <div class="flex items-center space-x-4">
                        <img class="w-16 h-16 rounded-full" src="{{ $booking->mentor->user->profile_photo_url }}" alt="{{ $booking->mentor->user->name }}">
                        <div>
                            <h4 class="text-lg font-medium">{{ $booking->mentor->user->name }}</h4>
                            <p class="text-gray-600">{{ $booking->mentor->specialization }}</p>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <h3 class="text-xl font-semibold mb-2">Booking Details</h3>
                    <p><strong>Date:</strong> {{ $booking->day }}</p>
                    <p><strong>Time:</strong> {{ $booking->start_time }} - {{ $booking->end_time }}</p>
                    <p><strong>Amount:</strong> ${{ number_format($booking->amount, 2) }}</p>
                    <p><strong>Status:</strong> {{ $booking->status }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="text-xl font-semibold mb-2">Booking Notes</h3>
                    <p>{{ $booking->notes ?? 'No notes provided.' }}</p>
                </div>
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('bookings.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Back to List</a>
                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 px-4 py-2 rounded-lg">Cancel Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
