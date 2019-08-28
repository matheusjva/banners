@extends('app')

@section('conteudo')
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            
            <div class="content col-xs-12 col-sm-12 col-md-10 col-lg-8  col-xl-8 ">

                <div class="container">
                    <h1> <i class="material-icons">live_tv</i> <b>TvP</b>anel's </h1>
                </div>
                <div class=" links" style="color: black; margin-top: 4vh;">
                    <a href="{{ route('banners.create') }}">Criar Painel</a>
                    <a href="{{route('banners.index')}}">Painéis</a>
                </div>

            </div>
        </div>
@endsection
