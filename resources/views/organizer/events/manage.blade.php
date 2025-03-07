@extends('layouts.organizer')

@section('title', 'Manage Events')

@section('content')
<div class="container mt-5">
    <h1 class="text-center text-orange">Manage Events</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Create Event Button (Now a Link) -->
    <div class="text-end mb-3">
        <a href="{{ route('organizer.events.create') }}" class="btn btn-warning">
            + Create Event
        </a>
    </div>

    <!-- Event Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Date & Time</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $event->name }}</td>
                    <td>{{ date('d M Y - H:i', strtotime($event->date)) }}</td>
                    <td>{{ $event->location }}</td>
                    <td>
                        <!-- Edit Button -->
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editEventModal{{ $event->id }}">
                            Edit
                        </button>

                        <!-- View Button -->
                        <a href="{{ route('organizer.events.view', $event->id) }}" class="btn btn-info btn-sm">View</a>

                        <!-- Delete Button -->
                        <form action="{{ route('organizer.events.destroy', $event->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this event?');">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Event Modal (Unchanged) -->
                <div class="modal fade" id="editEventModal{{ $event->id }}" tabindex="-1"
                    aria-labelledby="editEventModalLabel{{ $event->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title">Edit Event</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('organizer.events.update', $event->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label class="form-label">Event Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $event->name }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Event Date and Time</label>
                                        <input type="datetime-local" class="form-control" name="date"
                                            value="{{ date('Y-m-d\TH:i', strtotime($event->date)) }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Location</label>
                                        <input type="text" class="form-control" name="location"
                                            value="{{ $event->location }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="description" rows="4"
                                            required>{{ $event->description }}</textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100">Update Event</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
