<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Booking;
use Carbon\Carbon;
use Google\Client;
use Google\Service\Calendar;
use Google_Service_Calendar_ConferenceData;
use Google_Service_Calendar_ConferenceSolutionKey;
use Google_Service_Calendar_CreateConferenceRequest;
use Google_Service_Calendar_EventAttendee;
use Str;

final class GoogleCalendarService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setApplicationName('Calendar');
        $this->client->setAuthConfig(storage_path('app/google-calendar/credentials.json'));
        $this->client->addScope(Calendar::CALENDAR);
        $this->client->setRedirectUri(route('bookings.redirectToGoogleCalendar'));
        $this->client->setPrompt('select_account consent');
    }

    public function createAuthUrl()
    {
        return $this->client->createAuthUrl();
    }

    public function createEvent(Booking $booking)
    {
        $service = new Calendar($this->client);

        $event = new Calendar\Event([
            'summary' => 'Sesión con ' . $booking->mentor->user->name,
            'start' => [
                'dateTime' => Carbon::parse($booking->day . ' ' . $booking->start_time)->toAtomString(),
            ],
            'end' => [
                'dateTime' => Carbon::parse($booking->day . ' ' . $booking->end_time)->toAtomString(),
            ],
        ]);

        $attendees[] = new Google_Service_Calendar_EventAttendee([
            'email' => $booking->mentor->user->email,
            'comment' => null,
            'displayName' => $booking->mentor->user->name,
            'responseStatus' => 'needsAction',
        ]);

        $attendees[] = new Google_Service_Calendar_EventAttendee([
            'email' => $booking->mentee->email,
            'comment' => null,
            'displayName' => $booking->mentee->name,
            'responseStatus' => 'needsAction',
        ]);

        $event->setAttendees($attendees);

        $conferenceData = new Google_Service_Calendar_ConferenceData([
            'createRequest' => new Google_Service_Calendar_CreateConferenceRequest([
                'requestId' => str::random(10),
                'conferenceSolutionKey' => new Google_Service_Calendar_ConferenceSolutionKey([
                    'type' => 'hangoutsMeet',
                ]),
            ]),
        ]);

        $event->setConferenceData($conferenceData);

        return $service->events->insert('primary', $event);
    }
}
