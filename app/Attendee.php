<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Attendee extends Model
{
    public function storeAttendees($object)
    {
        return DB::transaction(function() use ($object){

            $attendees = new Attendee;
            $attendees->name = $object['name'];
            $attendees->email = $object['email'];
            $attendees->meeting_id  = $object['meeting_id'];

            $attendees->save();

            return $attendees;

        });

    }
}
