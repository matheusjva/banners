<?php

namespace App\Http\Controllers;

use App\Banner;
use App\BannerItens;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class BannerController extends Controller
{
    use GuardHelpers;

    public function home()
    {
        return view('welcome');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();
        $bannersItens = BannerItens::all();

        return view('banners', compact('banners', 'bannersItens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Banner $banner)
    {
        $validateData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',

        ]);


            $banner->name = $request->get('name');
            $banner->save();

            return redirect('/')->with('status', 'Painel cadastrado com sucesso!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function deleteBanner(Banner $banner)
    {
        $itens = BannerItens::where('banner_id', '=', $banner->id)->get();
        
        foreach($itens as $item)
        {
            $excluirArquivo = unlink(base_path(). '/resources/views/htmls/'. $item['filename']);
            if ($excluirArquivo) {
                
            }
            else {
                return redirect('banners')->with('error', 'Erro ao deletar arquivo de Painel.');

            }
        }
        if ($banner->delete())
            {
                return redirect('banners')->with('status', 'Painel deletado com sucesso!');

            }
            else
            {
                return redirect('banners')->with('error', 'Erro ao deletar Painel.');

            }
    }

    public function ativar(Banner $banner)
    {
        $bannersItens = BannerItens::where('banner_id', '=', $banner->id)->where('visible', '=', TRUE)->get();

        return view('includeHtmls', compact('bannersItens'));
    }
}
