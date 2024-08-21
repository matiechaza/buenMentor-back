<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Events\BookingCreated;
use App\Models\Booking;
use App\Models\Mentor;
use App\Services\GoogleCalendarService;
use Illuminate\Http\Request;

final class BookingController extends Controller
{
    /*protected GoogleCalendarService $googleCalendarService;

    public function __construct(GoogleCalendarService $googleCalendarService)
    {
        $this->googleCalendarService = $googleCalendarService;
    }*/

    public function index()
    {
        // Obtener las reservas donde el usuario es el aprendiz
        $mentorBookings = auth()->user()->mentorBookings()
            ->with('mentee')
            ->orderBy('start_time', 'desc')
            ->paginate(10);

        // También obtener las reservas donde el usuario es el mentor
        $menteeBookings = auth()->user()->menteeBookings()
            ->with('mentor.user')
            ->orderBy('start_time', 'desc')
            ->paginate(10);

        return view('bookings.index', compact('mentorBookings', 'menteeBookings'));
    }

    public function show($id)
    {
        $booking = Booking::with(['mentor', 'mentee'])->findOrFail($id);

        return view('bookings.show', compact('booking'));
    }

    public function payment(Request $request, Mentor $mentor)
    {
        $request->validate([
            'available_id' => 'required|exists:availabilities,id',
        ]);

        /** @var Availability $availability */
        $availability = $mentor->availabilities()->findOrFail($request->input('available_id'), [
            'id', 'day', 'start_time', 'end_time',
        ]);

        $booking =  $mentor->bookings()->firstOrCreate([
            'user_id' => auth()->id(),
            'day' => $availability->day,
            'start_time' => $availability->start_time,
            'end_time' => $availability->end_time,
            'amount' => $mentor->rate,
        ]);

        BookingCreated::dispatch($booking);

        return view('bookings.payment', compact('booking'));
    }

    public function store(Request $request, Mentor $mentor)
    {
        $request->validate([
            'available_id' => 'required|exists:availabilities,id',
        ]);

        /** @var Availability $availability */
        $availability = $mentor->availabilities()->findOrFail($request->input('available_id'), [
            'id', 'day', 'start_time', 'end_time',
        ]);

        $booking =  $mentor->bookings()->create([
            'user_id' => auth()->id(),
            'day' => $availability->day,
            'start_time' => $availability->start_time,
            'end_time' => $availability->end_time,
            'amount' => $mentor->rate,
        ]);

        BookingCreated::dispatch($booking);

        return redirect()->route('booking.confirmation', $booking);

        // Initialize MercadoPago SDK
        /*MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));
        MercadoPagoConfig::setRuntimeEnviroment(config('app.env'));

        $client = new PaymentClient();

        try {
            // Step 4: Create the request array
            $request = [
                "transaction_amount" => 100,
                "token" => "YOUR_CARD_TOKEN",
                "description" => "description",
                "installments" => 1,
                "payment_method_id" => "visa",
                "payer" => [
                    "email" => "user@test.com",
                ]
            ];

            // Step 5: Create the request options, setting X-Idempotency-Key
            $request_options = new RequestOptions();
            $request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);

            // Step 6: Make the request
            $payment = $client->create($request, $request_options);
            echo $payment->id;

            // Step 7: Handle exceptions
        } catch (MPApiException $e) {
            echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
            echo "Content: ";
            var_dump($e->getApiResponse()->getContent());
            echo "\n";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }*/
    }

    public function paymentSuccess(Booking $booking)
    {
        $booking->update(['payment_status' => 'paid']);
        return redirect()->route('bookings.index')->with('success', 'Payment successful and booking confirmed!');
    }

    public function paymentFailure(Booking $booking)
    {
        return redirect()->route('bookings.index')->with('error', 'Payment failed. Please try again.');
    }

    public function paymentPending(Booking $booking)
    {
        return redirect()->route('bookings.index')->with('info', 'Payment is pending. Please wait for confirmation.');
    }

    public function confirmation(Booking $booking)
    {
        return view('bookings.confirmation', compact('booking'));
    }

    public function addToGoogleCalendar(Booking $booking)
    {
        //$url = $this->googleCalendarService->createAuthUrl();

        //return redirect()->to($url);

        //return redirect()->route('booking.confirmation', $booking)->with('success', 'Evento agregado a Google Calendar.');

        /*$event = new Event;

        $event->name = 'A new event';
        $event->description = 'Event description';
        $event->startDateTime = $booking->start_time;
        $event->endDateTime = $booking->end_time;
        $event->addAttendee([
            'email' => $booking->mentor->user->email,
            'name' => $booking->mentor->user->name,
            'comment' => 'Lorum ipsum',
            'responseStatus' => 'needsAction',
        ]);
        $event->addAttendee([
            'email' => $booking->mentee->email,
            'name' => $booking->mentee->name,
            'comment' => 'Lorum ipsum',
            'responseStatus' => 'needsAction',
        ]);
        $event->addMeetLink();

        $event->save();*/

    }
}
