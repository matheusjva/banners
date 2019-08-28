@extends('app')

@section('conteudo')
    <br/>
    <div>
        <a href="{{ url('/')}}" class="btn btn-light">VOLTAR</a>
    </div>
    <br/>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class=" m-b-md">
                <h1>CRIAR PAINEL</h1>
            </div>
    
            <div class="links">
                <form method="post" action="{{route('banners.store')}}">
                    <div class="form-group">
                        @csrf
                        <label>NOME:</label>
                        <input type="text" class="form-control" name="name"/>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">CRIAR</button>
                </form>
            </div>
        </div>
    </div>
@endsection