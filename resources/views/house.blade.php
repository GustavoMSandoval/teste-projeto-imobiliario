@extends('layouts.layout')
    
@section('content')
    
<div class="container">
    <div class="card">
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
                <h1 class="card-title">{{ $house->name }}</h1>
                <p class="card-text">{{ $house->description }}</p>
                <h5>Localidade:</h5>
                <p>Endereço: {{ $house->address->rua }}</p>
                <p>Bairro: {{ $house->address->bairro }}</p>
                <p>Cidade: {{ $house->address->cidade }}</p>
                <p>Estado: {{ $house->address->estado }}</p>
            </div>
    </div>
</div>

@endsection