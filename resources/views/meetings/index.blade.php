@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" >
                    <div class="card-title"> <a href="{{route('store.meeting')}}" class="btn btn-primary" target="_blank" style="float: right !important;display:inline;">Create</a> Meeting List</div>

                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                              
                                <th>Attendees</th>
                                <th>Created By</th>
                                <th>Scheduled Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($meeting_list as $meeting)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $meeting->subject }}</td>
                               
                                <td>{{ implode(', ',$meeting->attendees->pluck('name')->toArray() ) }}</td>
                                <td>{{ $meeting->createdBy->name }}</td>
                                <td>{{ $meeting->date_time}}</td>
                                <td style="display:inline-flex;">
                                    <a href="{{ route('update.meeting', ['id' => $meeting->id] ) }}" class="btn btn-sm btn-primary" >Edit</a>

                                    <form action="{{ route('delete.meeting', ['id' => $meeting->id ] ) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="return confirm('Are you sure you want to delete this meeting?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection