<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-12">
            <div class="px-4 py-5 sm:p-6 bg-white">
                <h1 class="text-2xl font-semibold mb-4">Reservar una mentoria con {{ $booking->mentor->user->name }}</h1>

                <p><strong>Fecha:</strong> {{ $booking->day }}</p>
                <p><strong>Hora:</strong> {{ $booking->start_time }} - {{ $booking->end_time }}</p>
                <p><strong>Duración:</strong> {{ \Carbon\Carbon::parse($booking->end_time)->sub(\Carbon\Carbon::parse($booking->start_time))->format('H:i') }}</p>
                <p><strong>Precio:</strong> $ {{ $booking->amount }}</p>
                <p><strong>Comisión por servicio:</strong> $ {{ 0.20 }}</p>
                <p><strong>Total:</strong> $ {{ sprintf("%.2f", $booking->amount + 0.20) }}</p>


                <!-- Google Calendar Button -->
                <div class="mt-6">
                    <button id="pay-with-prex"
                       style="background-color: #5C19AE; border-color: #5C19AE; color: #FFFFFF; border-radius: 10rem; padding: .75rem 1.5rem"
                       class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                        Pagar con Prex</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('pay-with-prex').addEventListener('click', () => {
            const clientId = 'your-prex-client-id';
            const redirectUri = encodeURIComponent('https://localhost/callback');
            const prexAuthUrl = `https://api.prex.com/oauth/authorize?response_type=code&client_id=${clientId}&redirect_uri=${redirectUri}&scope=payment`;

            window.location.href = prexAuthUrl;
        });

        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const authorizationCode = urlParams.get('code');

            if (authorizationCode) {
                fetch('/api/exchange-code', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ code: authorizationCode })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.access_token) {
                            localStorage.setItem('prexAccessToken', data.access_token);
                            window.location.href = '/payment-success';
                        } else {
                            alert('Error al obtener el token de acceso.');
                        }
                    });
            }
        }
    </script>
</x-app-layout>
