<!DOCTYPE html>
<html>

<head>
    <title>Create Appointment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create New Appointment</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('appointments.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Start Time</label>
                                <input type="datetime-local" name="start" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>End Time</label>
                                <input type="datetime-local" name="end" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Participants</label>
                                @foreach ($users as $user)
                                    <div class="form-check">
                                        <input type="checkbox" name="participants[]" value="{{ $user->id }}"
                                            class="form-check-input">
                                        <label class="form-check-label">{{ $user->name }}
                                            ({{ $user->preferred_timezone }})</label>
                                    </div>
                                @endforeach
                            </div>

                            @error('time')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <button type="submit" class="btn btn-primary">Create Appointment</button>
                            <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
