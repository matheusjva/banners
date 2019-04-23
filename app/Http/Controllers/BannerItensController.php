<?php

namespace App\Http\Controllers;

use App\Banner;
use App\BannerItens;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class BannerItensController extends Controller
{
    use GuardHelpers;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createForm(Banner $banner)
    {
        $id_banner = $banner->id;
        return view('createItens', compact('id_banner'));
    }

    public function createItem(Request $request, Banner $banner, BannerItens $bannerItens)
    {

        $validateData = Validator::make(array_merge($request->all(), ['banner_id' => $banner->id]), [
            'name' => 'required|string|max:255',
            'banner_id' => 'required|integer|exists:banners,id',
            'seconds' => 'required|integer'
        ]);
        $bannerItens->name = $request->get('name');
        $bannerItens->banner_id = $banner->id;
        $bannerItens->seconds = $request->get('seconds') * 1000;
        $file = $request->file('filename');
        $typefile = $file->getClientMimeType();
        
        if($request->hasfile('filename')==true && $typefile=="text/html")
        {
            $htmlOnlyName = explode('.html', $file->getClientOriginalName());
            $htmlname = $htmlOnlyName[0];
            $htmlnamefinal = str_replace(' ', '', $htmlname);
            $name= time(). $htmlnamefinal . '.blade.php';
            if($file->move(base_path().'/resources/views/htmls/', $name))
            {
                $bannerItens->filename = $name;
                $bannerItens->save();

              return redirect('banners')->with('status', 'Item Painel cadastrado com sucesso!');
            }
            else {
                return redirect('banners')->with('error', 'Erro ao fazer upload do item!');
            }
        }
        else
        {
            return redirect('banners')->with('error', 'Arquivo não inserido ou inválido.');

        }


    }

    public function deleteBannerItem(BannerItens $bannerItens)
    {   
        $excluirArquivo = unlink(base_path(). '/resources/views/htmls/'. $bannerItens->filename);
        if ($excluirArquivo) {
            if ($bannerItens->delete())
            {
                return redirect('banners')->with('status', 'Item Painel deletado com sucesso!');

            }
            else
            {
                return redirect('banners')->with('error', 'Erro ao deletar Item Painel do banco de dados.');

            }
        }
        else
        {
            return redirect('banners')->with('error', 'Erro ao excluir arquivo da pasta.');

        }
    }

    public function updateForm(BannerItens $bannerItens)
    {
        $itemBanner = BannerItens::find($bannerItens->id);

        return view('editItem', compact('itemBanner'));

    }

    public function updateItem(Request $request, $bannerItens)
    {
        $validateData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'seconds' => 'required|integer'
        ]);

        $item = BannerItens::find($bannerItens); 
          
        
          
        if($request->hasfile('filename'))
        {       
                $file = $request->file('filename');
                $typefile = $file->getClientMimeType();

                if($typefile=="text/html")
                {                
                    unlink(base_path()."/resources/views/htmls/$item->filename");
                    $htmlOnlyName = explode('.html', $file->getClientOriginalName());
                    $htmlname = $htmlOnlyName[0];
                    $htmlnamefinal = str_replace(' ', '', $htmlname);
                    $name= time(). $htmlnamefinal . '.blade.php';
                    if($file->move(base_path().'/resources/views/htmls/', $name))
                    {
                        $item->filename = $name;              
                    }
                }
                else
                {
                    return redirect('banners')->with('error', 'Arquivo inválido.');
                }
        }

        $item->name = $request->get('name');
        $item->seconds = $request->get('seconds') * 1000;

        if($item->save())
        {
            return redirect('banners')->with('status', 'Item Painel atualizado com sucesso!');

        }
        else{
            return redirect('banners')->with('error', 'Erro ao atualizar Item Painel!');

        }
    }
}
