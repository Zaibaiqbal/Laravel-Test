<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;


class GoogleCalendarApiController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setAuthConfig(storage_path('client_secret.json'));
        $this->client->addScope(Google_Service_Calendar::CALENDAR);
        $this->client->setAccessType('offline'); // enables refresh token
        $this->client->setPrompt('select_account consent');
        // Set up your redirect URI if using OAuth web flow
        // $this->client->setRedirectUri('YOUR_REDIRECT_URI');
    }

    public function createMeeting($subject, $dateTime, $attendees)
    {
        
        $service = new Google_Service_Calendar($this->client);

        $event = new Google_Service_Calendar_Event([
            'summary' => $subject,
            'start' => ['dateTime' => $dateTime],
            'attendees' => $attendees,
        ]);

        $calendarId = 'primary'; // Default calendar ID

        $event = $service->events->insert($calendarId, $event);

        return $event->getId(); // Return the ID of the created event
    }
}
