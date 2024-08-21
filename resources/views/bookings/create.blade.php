<x-guest-layout>
    <div class="pt-4 bg-gray-100">
        <h2 class="text-2xl font-semibold mb-4">Book a Session with {{ $mentor->user->name }}</h2>

        <form action="{{ route('bookings.store', $mentor) }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                <input type="datetime-local" name="start_time" id="start_time" class="mt-1 block w-full" required>
                @error('start_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                <input type="datetime-local" name="end_time" id="end_time" class="mt-1 block w-full" required>
                @error('end_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="px-4 py-2 rounded-md">Book and Pay</button>
        </form>
    </div>
</x-guest-layout>
