<?php

namespace App\Http\Controllers;

use App\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function __construct()
    {
        $this->meeting = new Meeting;    
    }

    public function index()
    {
        $meeting_list = $this->meeting->getMeetingList();

        return view('meetings.index',['meeting_list' => $meeting_list]);
    }

    // get store view and sending request through single function

    public function storeMeeting(Request $request)
    {
        if($request->isMethod('post'))
        {
            //request validation

            $request->validate([
                'attendees_name'   =>   'required|array|max:2|min:1',
                'subject'           =>   'required',
                'scheduled_date'    =>   'required|after:now',
                'attendees_email'   =>     'required|array|max:2|min:1'

            ]);

            $form_collect = $request->input();

            $meeting = $this->meeting->storeMeeting($form_collect);

            if(isset($meeting->id))
            {
                return redirect()->route('meeting');
            }

        }
        else
        {
            return view('meetings.create_meeting');
        }

    }

    public function updateMeeting(Request $request)
    {
        if($request->isMethod('post'))
        {
            //request validation

            $request->validate([
                'attendees_name'   =>   'required|array',
                'subject'           =>   'required',
                'scheduled_date'    =>   'required|after:now',
                'attendees_email'   =>     'required|array',
                'meeting_id'        =>      'required|exists:meetings,id'

            ]);

            $form_collect = $request->input();

            $meeting = new Meeting;
            $meeting = $meeting->updateMeeting($form_collect);

            if(isset($meeting->id))
            {
                return redirect()->back()->with('success', 'Record updated successfully');   

            }

        }
        else
        {
            $meeting_id = $request->id;

            $meeting = $this->meeting->getMeetingById($meeting_id);

            if(isset($meeting->id))
            {
                return view('meetings.update_meeting',['meeting' => $meeting]);

            }
        }

    }

    public function deleteMeeting(Request $request)
    {

        $meeting_id = $request->id;


        $meeting = $this->meeting->getMeetingById($meeting_id);

        if(isset($meeting->id))
        {
            foreach($meeting->attendees as $rows)
            {
                $rows->delete();
            }
            $meeting->delete();
        }
        else
        {
        return redirect()->back()->with('error', 'Record not found');   

        }

        return redirect()->back()->with('success', 'Record deleted successfully');   


    }
}
