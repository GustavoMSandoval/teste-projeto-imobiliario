    @extends('layouts.layout')
    
    @section('content')
        
    <div class="container">
        <form x-target="house-list" action="{{ route('house.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label class="form-label">De um título a sua casa:</label>
            <input class="form-control" type="text" name="name" required>
            <label class="form-label">CEP:</label>
            <input class="form-control" type="text" id="cep" name="cep" maxlength="9">
            
            <label class="form-label">Rua:</label>
            <input class="form-control" type="text" id="rua" name="rua">
            
            <label class="form-label">Bairro:</label>
            <input class="form-control" type="text" id="bairro" name="bairro">
            
                <label class="form-label">Cidade:</label>
                <input class="form-control" type="text" id="cidade" name="cidade">
                
                <label class="form-label">Estado:</label>
                <input class="form-control" type="text" id="estado" name="estado">
                
                <label class="form-label">Descrição:</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="10" required></textarea>
                
                <label class="form-label">Imagens Casa:</label>
                    <div x-data class="d-flex gap-1 mt-2">
                        <input 
                        x-ref="imageInput"
                        id="image-input" 
                        class="form-control" 
                        type="file" 
                        name="images[]" 
                        multiple required accept="'image/*">
                        <button 
                        class="btn btn-dark" 
                        type="button" 
                        @click="$refs.imageInput.click()">+</button>
                    </div>
                <br><br>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
            <div id="house-list" class="my-5 d-flex flex-wrap gap-4">
                @foreach($houses as $house)
                <div class="card" style="width: 18rem;">
                    @if($house->images->count())
                    <div id="carousel-{{ $house->id }}" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" style="height: 200px; overflow: hidden;">
                            @foreach($house->images as $index => $image)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                                         class="d-block w-100 h-100" 
                                         style="object-fit: cover;" 
                                         alt="House image">
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
                        <p class="card-text">{{ Str::limit($house->description, 70) }}</p>
                        <a href="{{ route('house.show', $house->id) }}" class="stretched-link"></a>
                    </div>
                </div>                
                @endforeach
            </div>            
        </div>
    @endsection