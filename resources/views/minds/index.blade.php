<!DOCTYPE html>
<html>
<head>
    <title>Minds</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <h1>Organization Minds</h1>
    <a href="{{ route('minds.create') }}" class="btn btn-primary mb-3">+ Add Mind</a>

    <div class="row">
        @foreach ($minds as $mind)
            <div class="col-md-4">
                <div class="card mb-3">
                    @if($mind->photo)
                        <img src="{{ asset('storage/'.$mind->photo) }}" class="card-img-top" alt="{{ $mind->name }}">
                    @else
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="No photo">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $mind->name }}</h5>
                        <p class="card-text">{{ $mind->about }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</body>
</html>
