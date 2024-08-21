<x-app-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <h3>Register as a Mentor - Step 2</h3>
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register.mentor.step2.post') }}">
            @csrf

            <div>
                <x-label for="title" value="{{ __('Your title') }}" />
                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
            </div>

            <div class="mt-4">
                <x-label for="company" value="{{ __('Company') }}" />
                <x-input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company')" required />
            </div>

            <div class="mt-4">
                <x-label for="country" value="{{ __('Country') }}" />
                <select name="country_id" id="country" class="block mt-1 w-full" required>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <x-label for="languages" value="{{ __('Languages') }}" />
                <select name="languages[]" id="languages" class="block mt-1 w-full" required multiple>
                    @foreach ($languages as $lang)
                        <option value="{{ $lang->id }}">{{ $lang->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ms-4">
                    {{ __('Continue') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-app-layout>
