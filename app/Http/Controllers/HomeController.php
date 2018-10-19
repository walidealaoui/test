<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Compte;
use GuzzleHttp\Client;

use App\Operation;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $client = new \GuzzleHttp\Client();

    $response_operation = $client->request('GET','http://server.test/operations');

    $operations=json_decode($response_operation->getBody()->getContents(),true);

    $response_fonds = $client->request('GET','http://server.test/fonds');


    $fonds=json_decode($response_fonds->getBody()->getContents(),true);

        return view('dashboard.home')->with('fonds',$fonds)->with('operations',$operations);
    }

    public function situation()
    {

        $comptes=Auth::user()->conptes;
        return view('dashboard.situation')->with('comptes',$comptes);
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function compteSelectione(Request $request)
    {

        session(['id' => $request->compte]);
        $id=$request->compte;

        $comptes=Auth::user()->conptes;

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET','http://localhost:3000/operations?_limit=4&_sort=date_operation&_order=desc&cpt_id='.$request->compte);
        $operations_compte_selectione=json_decode($response->getBody()->getContents(),true);

        
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET','http://localhost:3000/fonds?_limit=4&cpt_id='.$request->compte);
        $fonds_compte_selectione=json_decode($response->getBody()->getContents(),true);

        return  view('dashboard.compte')->with('operations',$operations_compte_selectione)->with('fonds',$fonds_compte_selectione)->with('compte_id',$request->compte)->with('comptes',$comptes);   

    }

    public function allOperCompteClient($id)
    {
        $client = new \GuzzleHttp\Client();

        if(request('statut')!=null && request('nom_fond')!=null)
        {
           $response = $client->request('GET','http://localhost:3000/operations?_sort=date_operation&_order=desc&cpt_id='.$id."&statut=".request('statut')."&nom_fond=".request('nom_fond'));
           $alloper_compte_selectione=json_decode($response->getBody()->getContents(),true);
           return response()->json($alloper_compte_selectione,200);
        }
        
        $response = $client->request('GET','http://localhost:3000/operations?_sort=date_operation&_order=desc&cpt_id='.$id);
        $alloper_compte_selectione=json_decode($response->getBody()->getContents(),true);
        return response()->json($alloper_compte_selectione,200);
      
       
    }

    public function allFondsCompteClient($id)
    {
        //
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET','http://localhost:3000/fonds?cpt_id='.$id);
        $allfonds_compte_selectione=json_decode($response->getBody()->getContents(),true);
        return response()->json($allfonds_compte_selectione,200);
      
    }

    
    


    public function loadoperationscomponent($id)
    {
        return view('dashboard.client.operationsclient')->with('id',$id);

    }

    public function fonds($id)
    {
        return view('dashboard.client.fondsclient')->with('id',$id);


    }
    public function touLesFonds()
    {
       
        $client = new \GuzzleHttp\Client();
      

        $response = $client->request('GET','http://localhost:3000/fonds');
        
        $allFonds=json_decode($response->getBody()->getContents(),true);
        return response()->json($allFonds,200);


    }

    public function filtrerFonds()
    {
        $fields = [
            'forme_juridique',
            'class_fond',
            'nature_fond',
            'performance',
            'VL',
            'horizon_placement',
            'forme_juridique',
        ];
        
        $query = [];
        
        foreach($fields as $field){
            if(request("{$field}")){
                $query[] = "{$field}=" . request("{$field}");
            }
        }
        
        
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET','http://localhost:3000/fonds?'. implode('&', $query));

        $allFonds=json_decode($response->getBody()->getContents(),true);
        return response()->json($allFonds,200); 
      
    }

    public function conditionfonds($id)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET','http://localhost:3000/conditions?id_fond='.$id);

        $conditions_fond=json_decode($response->getBody()->getContents(),true);
        return response()->json($conditions_fond,200);
    }

    public function arrayOfBenchmarks()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET','http://localhost:3000/Benchs?_page=1&_limit=4');

        $benchmarks_array=json_decode($response->getBody()->getContents(),true);
        return response()->json($benchmarks_array,200);

    }

    public function simulateur()
    {

        return view('dashboard.client.simulateur');
    }

    public function info()
    {
        return view('phpinfo');
    }
}
