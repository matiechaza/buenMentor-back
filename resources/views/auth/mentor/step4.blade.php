<x-app-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <h3>Register as a Mentor - Step 4</h3>
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form action="{{ route('register.mentor.step4.post') }}" method="POST">
            @csrf
            <div id="availability-container">

                <div class="mt-4">
                    <x-label for="day" value="{{ __('Day') }}"></x-label>
                    <select name="day[]" id="day" class="block mt-1 w-full" required>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    </select>
                </div>

                <div class="mt-4">
                    <x-label for="start_time" value="{{ __('Start Time') }}"></x-label>
                    <x-input type="time" name="start_time[]" id="start_time" class="form-control" required />
                </div>

                <div class="mt-4">
                    <x-label for="end_time" value="{{ __('End Time') }}"></x-label>
                    <x-input type="time" name="end_time[]" id="end_time" class="form-control" required />
                </div>
            </div>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register.mentor.step3') }}">
                    {{ __('Back') }}
                </a>

                <button class="ms-4 inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" id="add-availability">
                    {{ __('Add Another Availability') }}
                </button>

                <x-button class="ms-4">
                    {{ __('Finalizar') }}
                </x-button>
            </div>
        </form>

        <script>
            document.getElementById('add-availability').addEventListener('click', function() {
                var container = document.getElementById('availability-container');
                var html = `
                <div class="mt-4">
                    <x-label for="day" value="{{ __('Day') }}"></x-label>
                    <select name="day[]" id="day" class="block mt-1 w-full" required>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    </select>
                </div>

                <div class="mt-4">
                    <x-label for="start_time" value="{{ __('Start Time') }}"></x-label>
                    <x-input type="time" name="start_time[]" id="start_time" class="form-control" required />
                </div>

                <div class="mt-4">
                    <x-label for="end_time" value="{{ __('End Time') }}"></x-label>
                    <x-input type="time" name="end_time[]" id="end_time" class="form-control" required />
                </div>
    `;
                container.insertAdjacentHTML('beforeend', html);
            });
        </script>
    </x-authentication-card>
</x-app-layout>
