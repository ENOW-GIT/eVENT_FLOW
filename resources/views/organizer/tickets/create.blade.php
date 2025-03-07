@extends('layouts.organizer')

@section('title', 'Create Tickets')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0 text-center">Create Tickets</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('organizer.tickets.store') }}" method="POST">
                @csrf

                <!-- Event Selection -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Select Event</label>
                    <select class="form-select @error('event_id') is-invalid @enderror" name="event_id" required>
                        <option value="" disabled selected>-- Choose Event --</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>
                                {{ $event->name }} - {{ date('d M Y - H:i', strtotime($event->date)) }}
                            </option>
                        @endforeach
                    </select>
                    @error('event_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Ticket Types Container -->
                <div id="ticket-types">
                    <div class="ticket-type-group mb-3 border p-3 rounded shadow-sm">
                        <label class="form-label fw-bold">VIP Ticket</label>
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" class="form-control @error('type.0') is-invalid @enderror" 
                                       name="type[0]" value="{{ old('type.0') }}" placeholder="VIP" required>
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control @error('price.0') is-invalid @enderror" 
                                       name="price[0]" value="{{ old('price.0') }}" required placeholder="Price">
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control @error('quantity.0') is-invalid @enderror" 
                                       name="quantity[0]" value="{{ old('quantity.0') }}" required placeholder="Quantity">
                            </div>
                        </div>
                    </div>

                    <div class="ticket-type-group mb-3 border p-3 rounded shadow-sm">
                        <label class="form-label fw-bold">Classic Ticket</label>
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" class="form-control @error('type.1') is-invalid @enderror" 
                                       name="type[1]" value="{{ old('type.1') }}" placeholder="Classic" required>
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control @error('price.1') is-invalid @enderror" 
                                       name="price[1]" value="{{ old('price.1') }}" required placeholder="Price">
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control @error('quantity.1') is-invalid @enderror" 
                                       name="quantity[1]" value="{{ old('quantity.1') }}" required placeholder="Quantity">
                            </div>
                        </div>
                    </div>

                    <div class="ticket-type-group mb-3 border p-3 rounded shadow-sm">
                        <label class="form-label fw-bold">Standard Ticket</label>
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" class="form-control @error('type.2') is-invalid @enderror" 
                                       name="type[2]" value="{{ old('type.2') }}" placeholder="Standard" required>
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control @error('price.2') is-invalid @enderror" 
                                       name="price[2]" value="{{ old('price.2') }}" required placeholder="Price">
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control @error('quantity.2') is-invalid @enderror" 
                                       name="quantity[2]" value="{{ old('quantity.2') }}" required placeholder="Quantity">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Ticket Type Button -->
                <button type="button" class="btn btn-secondary w-100 my-3" onclick="addTicketType()">
                    + Add Another Ticket Type
                </button>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Create Tickets</button>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript to Add Dynamic Ticket Fields -->
<script>
    let ticketIndex = 3;

    function addTicketType() {
        let ticketTypesContainer = document.getElementById('ticket-types');
        let newTicketType = document.createElement('div');
        newTicketType.classList.add('ticket-type-group', 'mb-3', 'border', 'p-3', 'rounded', 'shadow-sm');
        newTicketType.innerHTML = `
            <label class="form-label fw-bold">Custom Ticket ${ticketIndex + 1}</label>
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="type[${ticketIndex}]" required placeholder="Ticket Type">
                </div>
                <div class="col-md-4">
                    <input type="number" class="form-control" name="price[${ticketIndex}]" required placeholder="Price">
                </div>
                <div class="col-md-4">
                    <input type="number" class="form-control" name="quantity[${ticketIndex}]" required placeholder="Quantity">
                </div>
            </div>
        `;
        ticketTypesContainer.appendChild(newTicketType);
        ticketIndex++;
    }
</script>
@endsection
