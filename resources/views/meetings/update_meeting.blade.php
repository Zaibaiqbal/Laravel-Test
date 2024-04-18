@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Meeting</div>

                <div class="card-body">

                        <form method="POST" action="{{ route('update.meeting') }}">
                            @csrf
                            <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Subject</label>
                                    <input type="text" value="{{$meeting->subject}}" class="form-control" id="title" name="subject" required>
                                </div>
                            </div>
                            </div>
                            <div class="row">

                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="start_time">Scheduled Date</label>
                                    <input type="datetime-local" value="{{$meeting->date_time}}" class="form-control" id="start_time" name="scheduled_date" required>
                                </div>
                            </div>
                            </div>
                            <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="attendees">Attendee Name (1)</label>
                                    <input type="text" class="form-control" value="{{$meeting->attendees[0]->name}}" name="attendees_name[]" required>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="attendees">Attendee Email (1)</label>
                                    <input type="email" class="form-control" value="{{$meeting->attendees[0]->email}}" name="attendees_email[]" required>
                                </div>
                            </div>
                            </div>
                            
                            <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="attendees">Attendee Name (2)</label>
                                    <input type="text" @if(isset($meeting->attendees[1]->id)) value="{{$meeting->attendees[1]->name}}" @endif class="form-control" name="attendees_name[]" required>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="attendees">Attendee Email (2)</label>
                                    <input type="email" @if(isset($meeting->attendees[1]->id)) value="{{$meeting->attendees[1]->email}}" @endif class="form-control" name="attendees_email[]" required>
                                </div>
                            </div>
                            </div>

                            <input type="hidden" name="meeting_id" value="{{$meeting->id}}">
                            <button type="submit" class="btn btn-primary">Update Meeting</button>
                        </form>

                </div>
            </div>
        </div>
    </div>
@endsection
