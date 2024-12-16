<!DOCTYPE html>
<html>

<head>
    <title>Appointments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-4">
            <h2>Your Appointments</h2>
            <div>
                <a href="{{ route('appointments.create') }}" class="btn btn-primary">Create Appointment</a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>

        <div class="row">
            @foreach ($appointments as $appointment)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $appointment->title }}</h5>
                            <p class="card-text">
                                Start: {{ $appointment->start->format('Y-m-d H:i') }}<br>
                                End: {{ $appointment->end->format('Y-m-d H:i') }}
                            </p>
                            <p class="card-text">
                                <small class="text-muted">
                                    Created by: {{ $appointment->creator->name }}
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
