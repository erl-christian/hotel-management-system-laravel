<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Matching header primary color theme */
        .page-header {
            background-color: #007bff; /* Replace with your primary color */
            color: white;
        }

        .card-header {
            background-color: #0056b3; /* Darker shade of the primary color */
            color: white;
        }

        .btn-primary {
            background-color: #007bff; /* Match the header's primary color */
            border-color: #0056b3;
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Slightly darker on hover */
            border-color: #004085;
        }
    </style>
</head>
<body>
    @include('admin.header')

    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->

    <div class="page-content">
        <div class="page-header py-3 border-bottom">
            <div class="container-fluid">
                <h1 class="display-6">Gallery</h1>
            </div>
        </div>
    
        <!-- Gallery Grid -->
        <div class="container my-4">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                @foreach ($gallery as $gallery)
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="/gallery/{{$gallery->images}}" class="card-img-top" alt="Gallery Image" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <div class="card-text text-center">
                                <a class="btn btn-danger" href="{{url('delete_image', $gallery->id)}}">Delete Image</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    
        <!-- Upload Section -->
        <div class="container mt-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Upload Image</h5>
                </div>
                <div class="card-body">
                    <form action="{{url('upload_gallery')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="image" class="form-label">Choose an Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Add Image</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('admin.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
