@extends('layouts.base')

@section('content')
<div class="container">
    <div class="show-container">
        <img class="show-image" src="{{ asset($travel->image) }}" alt="Imagen del destino">
        <div class="text-container">
            <div class="titles-container">
                <h2 class="travel-name">{{ $travel->name }}</h2>
                <h3 class="travel-location">{{ $travel->location }}</h3>
            </div>
            <p class="travel-description">{{ $travel->description }}</p>
        </div>
        <div class="icon-container">
            @if(Auth::check() && $travel->user_id === Auth::user()->id)
                <a href="{{ route('travel.edit', ['id' => $travel->id]) }}">
                    <img class="icon-edit" src="{{ asset('assets/Edit-icon.svg') }}" alt="icono editar">
                </a>          
                <a id="deleteLink" href="#" data-toggle="modal" data-target="#deleteModal" data-travel-id="{{ $travel->id }}">
                    <img class="icon-delete" src="{{ asset('assets/Delete-icon.svg') }}" alt="icono borrar">
                </a>
            @endif
        </div>
    </div>
</div>

@component('components.delete-confirmation-modal', ['travel' => $travel])
@endcomponent
@endsection
