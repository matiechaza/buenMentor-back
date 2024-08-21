<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-12">
            <div class="px-4 py-5 sm:p-6 bg-white">
                <h1 class="text-2xl font-semibold mb-4">Reserva Confirmada</h1>

                <p>¡Gracias por reservar tu sesión con <strong>{{ $booking->mentor->user->name }}</strong>!</p>
                <p><strong>Fecha:</strong> {{ $booking->day }}</p>
                <p><strong>Hora:</strong> {{ $booking->start_time }} - {{ $booking->end_time }}</p>

                <!-- Google Calendar Button -->
                <div class="mt-6">
                    <a href="{{ route('bookings.addToGoogleCalendar', $booking) }}" class="bg-blue-500 py-2 px-4 rounded">Agregar a Google Calendar</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
