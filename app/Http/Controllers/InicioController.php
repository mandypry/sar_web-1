<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Perfilpermissao;
use App\Models\Usuarioperfil;
use App\Models\Permissao;
use Illuminate\Database\Eloquent\CollectionCollection;
use Gate;
use Illuminate\Support\Facades\DB;


class InicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        //$permissao = Perfilpermissao::all();
    	//dd($permissao);

    	$usuario = Auth()->user()->id_usuario;

    	//dd($usuario);

        $permissoes = DB::table('users')->where('id_usuario','=',$usuario)
            ->join('usuarioperfils','usuarioperfils.usuario_id', '=','users.id_usuario')
            ->join('perfilpermissaos', 'perfilpermissaos.perfil_id', '=', 'usuarioperfils.perfil_id')
            ->join('permissoes', 'permissoes.id_permissao', '=', 'perfilpermissaos.permissao_id')
            ->select('permissoes.nome')
            ->get();


    	//Gate::allows('usuario-view',$permissao);
    	//dd($permissao);
    	//return view('inicio')->with('Permissao',$permissoes);
        $ordempendente = $this->ordemservicospendentes();
        $ordemrealizado = $this->ordemservicosrealizados();

        $quantidadeordemservico = $this->quantidadeordemservico();
        return view('inicio')
        ->with('quantidadeordemservico',$quantidadeordemservico)
        ->with('ordempendente',$ordempendente)
        ->with('ordemrealizado',$ordemrealizado);
    }

    public function quantidadeordemservico(){
        $pendente = DB::table('ordem_servicos')
        ->select(DB::raw('count(status) as pendente'))->where('status','P')->get();
    
        $finalizado = DB::table('ordem_servicos')
        ->select(DB::raw('count(status) as finalizado'))->where('status','F')->get();
    
        $cancelado = DB::table('ordem_servicos')
        ->select(DB::raw('count(status) as cancelado'))->where('status','C')->get();
        
        return [$pendente, $finalizado, $cancelado];
    }

    public function ordemservicospendentes(){
        $dados = DB::table('ordem_servicos')->where('status','P')->take(5)->get();        
        return $dados;
    }

    public function ordemservicosrealizados(){
        $dados = DB::table('ordem_servicos')->where('status','<>','P')->take(5)->get();        
        return $dados;
    }
 }
