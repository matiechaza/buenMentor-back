<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-12">
            <div class="px-4 py-5 sm:p-6 bg-white">
                <h1>Search for Mentors</h1>
                <form action="{{ route('mentors.index') }}" method="GET" class="mb-4">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <x-label for="specialization" value="{{ __('Specialization') }}" />
                            <x-input id="specialization" class="block mt-1 w-full" type="text" name="specialization" :value="old('specialization')" />
                        </div>
                        <div class="form-group col-md-2">
                            <x-label for="rate_min" value="{{ __('Min Rate ($)') }}" />
                            <x-input id="rate_min" class="block mt-1 w-full" type="number" name="rate_min" :value="old('rate_min')" />
                        </div>
                        <div class="form-group col-md-2">
                            <x-label for="rate_max" value="{{ __('Max Rate ($)') }}" />
                            <x-input id="rate_max" class="block mt-1 w-full" type="number" name="rate_max" :value="old('rate_max')" />
                        </div>
                        <div class="form-group col-md-4">
                            <x-label for="availability" value="{{ __('Availability') }}" />
                            <x-input id="availability" class="block mt-1 w-full" type="text" name="availability" :value="old('availability')" />
                        </div>
                    </div>
                    <x-button class="mt-4">
                        {{ __('Search') }}
                    </x-button>
                </form>

                @forelse ($mentors as $mentor)
                    <div class="card mb-3">
                        <div class="card-body">
                            <img src="{{ $mentor->user->profile_photo_url }}" alt="{{ $mentor->user->name }}" class="w-32 h-32 rounded my-4" width="32" height="32">
                            <h5 class="card-title">{{ $mentor->user->name }}</h5>
                            <p class="card-text"><strong>Rate per Hour:</strong> ${{ $mentor->rate }}</p>
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('mentors.show', $mentor) }}">
                                {{ __('View Profile') }}
                            </a>
                        </div>
                    </div>
                @empty
                    <p>No mentors found matching your criteria.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
