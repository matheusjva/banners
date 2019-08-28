
@extends('app')

@section('conteudo')
    <br/>
    <div>
        <a href="{{ url('banners')}}" class="btn btn-light">VOLTAR</a>
    </div>
    <br/>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class=" m-b-md">
                <h1>CRIAR ITEM PAINEL</h1>
            </div>
    
            <div class="links flex-center border rounded">
                <form method="post" action="{{ url('banners/itens', $id_banner)}}" enctype="multipart/form-data">
                    <div class="form-group">
                        @csrf
                        <label>NOME:</label>
                        <div class="form-group col-md-12">
                            <input type="text"  name="name" required>
                        </div>
                        <label>TEMPO(S):</label>
                        <div class="form-group col-md-12">
                            <input type="number" min="1"  name="seconds" required>
                        </div>
                        <label>VISÍVEL:</label>
                        <div class="form-group col-md-12">
                            <select name="visible" required>
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                        </div>
                        <label>HTML:</label>
                        <div class="form-group col-md-8">
                            <input type="file" name="filename" accept="text/html" required>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">CRIAR</button>
                </form>
            </div>
        </div>
    </div>
@endsection

