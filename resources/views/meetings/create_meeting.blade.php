@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Meeting</div>

                <div class="card-body">

                        <form method="POST" action="{{ route('store.meeting') }}">
                            @csrf
                            <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Subject</label>
                                    <input type="text" class="form-control" id="title" name="subject" required>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="start_time">Scheduled Date</label>
                                    <input type="datetime-local" class="form-control" id="start_time" name="scheduled_date" required>
                                </div>
                            </div>
                            </div>
                            <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="attendees">Attendee Name (1)</label>
                                    <input type="text" class="form-control" name="attendees_name[]" required>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="attendees">Attendee Email (1)</label>
                                    <input type="email" class="form-control" name="attendees_email[]" required>
                                </div>
                            </div>
                            </div>
                            <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="attendees">Attendee Name (2)</label>
                                    <input type="text" class="form-control" name="attendees_name[]" required>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="attendees">Attendee Email (2)</label>
                                    <input type="email" class="form-control" name="attendees_email[]" required>
                                </div>
                            </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Meeting</button>
                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
