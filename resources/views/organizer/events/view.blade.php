@extends('layouts.organiser')

@section('title', 'Event Details')

@section('content')
<div class="container mt-5">
    <h1 class="text-center text-orange">{{ $event->name }}</h1>

    <div class="card">
        <div class="card-header bg-primary text-white">
            Event Details
        </div>
        <div class="card-body">
            <p><strong>Date & Time:</strong> {{ date('d M Y - H:i', strtotime($event->date)) }}</p>
            <p><strong>Location:</strong> {{ $event->location }}</p>
            <p><strong>Description:</strong> {{ $event->description }}</p>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('organizer.events.manage') }}" class="btn btn-secondary">Back to Events</a>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editEventModal{{ $event->id }}">
            Edit Event
        </button>
    </div>
</div>
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
                                <form action="{{ route('admin.events.view', $event->id) }}" method="POST">
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
@endsection