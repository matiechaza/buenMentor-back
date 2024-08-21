<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-12">
            <div class="px-4 py-5 sm:p-6 bg-white">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{ $mentor->user->name }}
                        </h3>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                        <img src="{{ $mentor->user->profile_photo_url }}" alt="{{ $mentor->user->name }}" class="w-32 h-32 rounded my-4" width="32" height="32">

                        <p><strong>Title:</strong> {{ $mentor->user->title }}</p>
                        <p><strong>Company:</strong> {{ $mentor->user->company }}</p>
                        <p><strong>Email:</strong> {{ $mentor->user->email }}</p>
                        <p><strong>Rate per Hour:</strong> ${{ $mentor->rate }}</p>
                        <p><strong>Languages:</strong> {{ implode(', ', $mentor->user->languages) }}</p>
                        @if($mentor->user->bio)
                            <p><strong>Bio:</strong> {{ $mentor->user->bio }}</p>
                        @endif

                        @auth
                            <!-- Formulario de Reserva -->
                            <form action="{{ route('bookings.payment', $mentor->id) }}" method="POST" class="mt-4">
                                @csrf
                                <div class="mb-4">
                                    <label for="day" class="block text-sm font-medium text-gray-700">Select Day</label>
                                    <select name="day" id="day" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="">Select a day</option>
                                        @foreach($availabilities as $availability)
                                            <option value="{{ $availability->day }}">{{ $availability->day }}</option>
                                        @endforeach
                                    </select>
                                    @error('day') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="time" class="block text-sm font-medium text-gray-700">Select Time</label>
                                    <select name="available_id" id="time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="">Select a time</option>
                                        <!-- Options are filled via JavaScript based on the selected day -->
                                    </select>
                                    @error('time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <button type="submit" class="bg-blue-500 px-4 py-2 rounded-md">Book Session</button>
                            </form>
                        @else
                            <div class="mt-4">
                                <a href="{{ route('login') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md inline-block mb-2">Login to Book a Session</a>
                                <p class="text-gray-700">Don’t have an account? <a href="{{ route('register') }}" class="text-blue-500 underline">Sign up</a> to start booking sessions.</p>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg mt-6 p-4">
            <div class="max-w-7xl mx-auto sm:px-12">
                <div class="px-4 py-5 sm:p-6 bg-white">
                    <h4 class="text-lg font-semibold mb-4">Reviews</h4>

                    @if(session('success'))
                        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @auth
                        <form action="{{ route('mentors.review.store', $mentor) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="mb-2">
                                <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                                <select name="rating" id="rating" class="mt-1 block w-full">
                                    <option value="">Select Rating</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                @error('rating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-2">
                                <label for="review" class="block text-sm font-medium text-gray-700">Review</label>
                                <textarea name="review" id="review" rows="3" class="mt-1 block w-full"></textarea>
                                @error('review') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" class="bg-blue-500 px-4 py-2 rounded-md">Submit Review</button>
                        </form>
                    @else
                        <p>Please <a href="{{ route('login') }}" class="text-blue-500">login</a> to leave a review.</p>
                    @endauth

                    <hr class="my-4">

                    @forelse($reviews as $review)
                        <div class="border-b py-4">
                            <div class="flex items-center">
                                <div class="text-gray-800 font-semibold">{{ $review->author->name }}</div>
                                <div class="ml-2 text-yellow-500">
                                    @for ($i = 0; $i < $review->rating; $i++)
                                        ★
                                    @endfor
                                </div>
                            </div>
                            <p class="text-gray-600">{{ $review->review }}</p>
                            <small class="text-gray-500">{{ $review->created_at->format('M d, Y') }}</small>
                        </div>
                    @empty
                        <p>No reviews yet. Be the first to leave a review!</p>
                    @endforelse
                </div>
            </div>
        </div>

    <script>
        // Listen for changes on the "day" select element
        document.getElementById('day').addEventListener('change', function() {
            const day = this.value;
            const timeSelect = document.getElementById('time');
            timeSelect.innerHTML = '<option value="">Select a time</option>';

            @foreach($availabilities as $availability)
                if (day === "{{ $availability->day }}") {
                    const timeOption = document.createElement('option');
                    timeOption.value = `{{ $availability->id }}`;
                    timeOption.textContent = `{{ $availability->start_time . '-' . $availability->end_time  }}`;
                    timeSelect.appendChild(timeOption);
                }
            @endforeach
        });
    </script>
</x-app-layout>
