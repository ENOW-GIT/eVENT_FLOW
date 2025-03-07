<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EventFlow</title>
  <link rel="stylesheet" href="backend/second.css">
  <script defer src="backend/script.js"></script>
</head>
<body> 
  <header>
  <h1>EVENTS!!!</h1>
</header>
  <div class="wrapper">
    <div id="search-container">
      <input type="search" id="search-input" placeholder="Search for events..." />
      <button id="search">Search</button>
    </div>
<!-- < class="container" data-category="sport">  -->
  <ul id="event" class="event-list">

  @foreach($events as $event)
    <li class="event-item">
     <img src="backend/./img/football.jpeg" alt="Event 1">
     <!--<img src="backend/img/OIP.jpeg" alt="super star">-->
      <h2> {{$event->name}}</h2> 
      <p>
        <strong>Description:</strong>
        {{$event->description}} 

      </p>
      <p>
        <strong>Date:</strong>
        {{$event->event_date}}

      </p>
      <p>
        <strong>Location:</strong>
        {{$event->location}}

      </p>
      <p>
        <strong>Ticket type:</strong>
        VIPcode
      </p>
      <a href="{{ route('tickets.purchase')}}">Acheter </a>
      <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">Edit</a>
      <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-danger">Delete</button>
    </form>
    </li>
  @endforeach
  <div class="create">
    <a href="{{ route('events.create')}}" class="create_event">
    Create Event</a>
   </div>
  </ul>
</div>

</body>
</html>

 


