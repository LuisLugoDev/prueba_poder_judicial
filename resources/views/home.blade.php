@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <h1 class="text-5xl text-center pt-24">Bienvenido a nuestro E-commerce</h1>
                    <form method="POST" id="form_productos" action="{{ route('registrarCompra.store') }}">
                    @csrf
                    <div class="col-md-6 offset-md-3">
                        <div class="form-group ">
                        <label for="productsList">Seleccione un producto</label>
                        <select class="form-control" name="product" id="productsList">
                        @if(isset($productos))
                            @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}" @selected(old('producto') == $producto)>
                                {{ $producto->nombre }}
                                </option>
                            @endforeach
                        @endif
                        </select>
                        </div>
                        <button type="submit" class="btn btn-primary col-md-6 offset-md-3">Comprar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
