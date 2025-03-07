@extends('layouts.admin')

@section('title', 'Create Category')

@section('content')

<title>Create Category</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #fff3e0; /* Light orange background */
        }
        .container {
            max-width: 500px;
            margin-top: 50px;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-orange {
            background-color: #ff9800; /* Orange button */
            color: white;
        }
        .btn-orange:hover {
            background-color: #e68900;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center text-orange">Create a New Category</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.category.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Category Name:</label>
            <input type="text" name="name" class="form-control" placeholder="Enter category name" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description:</label>
            <textarea name="description" class="form-control" placeholder="Enter category description"></textarea>
        </div>

        <button type="submit" class="btn btn-orange w-100">Create Category</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
