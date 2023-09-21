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
                        Bienvenido - {{ auth()->user()->name }} ({{auth()->user()->role}})
                        <br>
                        <br>
                        <a href="{{ route('users') }}" type="button" class="btn btn-primary">Gestionar usuarios</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
