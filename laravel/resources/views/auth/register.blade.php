@extends('layouts.base')
@section('content')

<main class="signup-form">
    <link href="{{ asset('css/auth.blade.css') }}" rel="stylesheet">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card-register">
                    <h3 class="card-header text-center">Registro de usuario</h3>
                    <div class="card-body">
                        <form action="{{ route('register.custom') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="validationTextarea" class="form-label">Nombre</label>
                                <input type="text" placeholder="Nombre" id="name" class="form-auth" name="name"
                                    required autofocus>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="validationTextarea" class="form-label">Email</label>
                                <input type="email" placeholder="Email" id="email" class="form-auth"
                                    name="email" required autofocus>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="validationTextarea" class="form-label">Contraseña</label>
                                <input type="password" placeholder="Contraseña" id="password" class="form-auth"
                                    name="password" required>
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="container-btn">
                                <button type="submit" class="btn btn-primary">Aceptar</button>
                                <a href="{{ route('happy_travel.index') }}" class="btn btn-secondary">Cancelar</a>
                            </div>

                            <div class="mb-3 inline-p">
                                <p>¿Ya tienes cuenta?</p>
                                <a class="link-offset-2" href="{{ route('login') }}">Accede aquí</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection