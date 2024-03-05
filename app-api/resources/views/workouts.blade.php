@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Dashboard</div>

                    <div class="card-body">
                        <h2>Welcome, {{ Auth::user()->name }}!</h2>
                        <h3>User ID: {{ Auth::user()->id }}</h3>
                        <p>This is your dashboard. You can customize it as needed.</p>

                        <!-- Форма для создания тренировки -->
                        <form method="post" action="{{ route('training.create') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>

                            <div class="mb-3">
                                <label for="description">Description:</label>
                                <textarea class="form-control" id="description" name="description" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="date">Date:</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Create Training</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
