<?php

namespace App;

use App\Http\Controllers\GoogleCalendarApiController;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Meeting extends Model
{
    public function getMeetingList()
    {
        return Meeting::paginate(10);
    }

    public function getMeetingById($id)
    {
        return Meeting::find($id);
    }


    
    public function storeMeeting($object)
    {
        return DB::transaction(function() use ($object){

            $meeting = new Meeting;
            $meeting->subject = $object['subject'];
            $meeting->date_time = $object['scheduled_date'];
            $meeting->created_id  = Auth::user()->id;

            $meeting->save();

            if(@count($object['attendees_email']) > 0)
            {

                foreach($object['attendees_email'] as $key=>$value)
                {
                    $attendees_info = [

                        'name'          =>     $object['attendees_name'][$key],
                        'email'         =>     $value,
                        'meeting_id'    =>   $meeting->id
                        
                    ];

                    $attendees = new Attendee;
                    $attendees = $attendees->storeAttendees($attendees_info);
    

                }
               
            }

            // $googleCalendarService = new GoogleCalendarApiController;

            // $subject = $meeting->subject;
            // $startTime = $meeting->date_time;
            // $attendees = $meeting->attendees->pluck('email')->toArray();

            // $eventId = $googleCalendarService->createMeeting($subject, $startTime, $attendees);


            return $meeting;

        });

    }

    public function updateMeeting($object)
    {
        return DB::transaction(function() use ($object){

            $meeting = Meeting::find($object['meeting_id']);

            if(isset($meeting->id))
            {
                $meeting->subject = $object['subject'];
                $meeting->date_time = $object['scheduled_date'];
                $meeting->created_id  = Auth::user()->id;

                $meeting->update();

            if(@count($object['attendees_email']) > 0)
            {
                foreach($meeting->attendees as $attendee) {
                    $attendee->delete();
                }

                foreach($object['attendees_email'] as $key=>$value)
                {
                    $attendees_info = [

                        'name'          =>     $object['attendees_name'][$key],
                        'email'         =>     $value,
                        'meeting_id'    =>     $meeting->id
                        
                    ];

                    $attendees = new Attendee;
                    $attendees = $attendees->storeAttendees($attendees_info);
    

                }
               
            }

            // $googleCalendarService = new GoogleCalendarApiController;

            // $subject = $meeting->subject;
            // $startTime = $meeting->date_time;
            // $attendees = $meeting->attendees->pluck('email')->toArray();

            // $eventId = $googleCalendarService->createMeeting($subject, $startTime, $attendees);


            return $meeting;
        }


        });

    }

    // This relationship shows One meeting has many attendees

    public function attendees()
    {
        return $this->hasMany(Attendee::class,'meeting_id');
    }

    // This relationship shows One user can create a meeting/event

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_id')->withDefault();
    }
}
