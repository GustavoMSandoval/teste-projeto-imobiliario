<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
        <div class="container">
            <form  action="{{ route('house.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label class="form-label">House Name:</label>
                <input class="form-control" type="text" name="name" required><br><br>
                <label class="form-label">Description:</label>
                <input class="form-control" type="text" name="description" required><br><br>
                <label class="form-label">House Images:</label>
                <div id="file-inputs" class="mt-2">
                    <div class="d-flex gap-1">
                        <input class="form-control" type="file" name="images[]" multiple required accept="'image/*">
                        <button class="btn btn-dark" type="button" onclick="addFileInput()">+</button>
                    </div>
                </div><br><br>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
            <div class="mt-5 d-flex flex-wrap gap-4">
                @foreach($houses as $house)
                    <div class="card" style="width: 18rem;">
                        @if($house->images->count())
                            <div id="carousel-{{ $house->id }}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($house->images as $index => $image)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $image->image_path) }}" class="d-block w-100" alt="House image">
                                        </div>
                                    @endforeach
                                </div>
                                @if($house->images->count() > 1)
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $house->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $house->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                @endif
                            </div>
                        @endif
            
                        <div class="card-body">
                            <h5 class="card-title">{{ $house->name }}</h5>
                            <p class="card-text">{{ $house->description }}</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                @endforeach
            </div>            
        </div>
    @verbatim
        <script>
            function addFileInput() {

                const inputsContainer = document.getElementById('file-inputs');

                let createFileInput = document.createElement('input');

                createFileInput.className = 'form-control my-2';
                createFileInput.type = 'file';
                createFileInput.name ='images[]';
                createFileInput.accept = 'image/*';
                createFileInput.multiple = true;

                inputsContainer.append(createFileInput);

            }
        </script>
    @endverbatim
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>