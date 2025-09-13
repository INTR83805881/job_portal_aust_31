<!DOCTYPE html>
<html>
<head>
    <title>Create Mind</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <h1>Add a Mind</h1>

    <form action="{{ route('minds.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">About:</label>
            <textarea name="about" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Photo:</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <button class="btn btn-success">Save</button>
    </form>

</body>
</html>
