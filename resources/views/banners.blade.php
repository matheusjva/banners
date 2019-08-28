@extends('app');
@section('conteudo')
    <br/>
    <div>
      <a href="{{ url('/')}}" class="btn btn-light">Voltar</a>
  </div>
  <br/>

  @foreach($banners as $banner)
      <div class="card text-center" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
         <div class="card-header font-weight-bold" style="color: black; ">
            {{$banner['name']}}
         </div>
         <div class="card-body">
            <h5 class="card-title font-weight-bold" style="color: black;">Banners Apresentados</h5>
             <table class="table table-striped flex-center">

                        @foreach($bannersItens as $item)
                            @if($item['banner_id'] == $banner['id'])
                                @php
                                    $second = $item['seconds'] / 1000;
                                @endphp

                                <tr>
                                    <td class="font-weight-bold" >{{ $item['name'] }}</td>
                                    <td class="font-weight-bold">{{ $second }} segundos</td>
                                    <td><a href="{{ url('banners/editform', $item['id'])}}"><img src="img/icons8-editar-64.png" width="26px" height="26px"></a></td>
                                    <td>
                                        <form action="{{url('delete/bannerItem', $item['id'])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button style="text-decoration: none; border:none; background-color: transparent;" type="submit"><img src="img/icons8-cancelar-65.png" width="25px" height="25px"></button>
                                        </form>
                                    </td>
                                    <td>
                                        @php
                                            if($item['visible'])
                                            {
                                                echo "<a href='banners/itens/invisible/". $item['id'] . "'> <img src='img/visivel.png' width='26px' height='26px'></a>";

                                            }
                                            else
                                            {
                                                echo "<a href='banners/itens/visible/" . $item['id'] . "'> <img src='img/invisivel.png' width='26px' height='26px'></a>";
                                            }
                                        @endphp
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                 
             </table>
            <br/>
            <a href="{{ url('banners/itens', $banner['id'])}}" class="btn"><img src="img/adicionar.png" width="25px" height="25px"></a>  <a href="{{ url('ativar', $banner['id'])}}" class="btn"><img src="img/play.png"></a>  <a href="{{ url('banners/delete', $banner['id'])}}" class="btn"><img src="img/icons8-excluir-48.png" width="25px" height="25px"></a>

         </div>
         <div class="card-footer text-muted" style="color: black;">
            Criado em {{$banner['created_at']}}.
         </div>
      </div>
      <br/>
      <br/>
  @endforeach     
@endsection


