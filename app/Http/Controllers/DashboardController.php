<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function allOper(Request $request)
    {
        $data = $request->has('page') ? $request->get('page') : 1;
        $client = new Client();
       //get operations from the api

        $alloperations_response = $client->request('GET','http://server.test/alloperations');
        
        //decode the json response from api
        $operations=json_decode($alloperations_response->getBody()->getContents(),true);
        //dd($operations);
       //pagination
       $currentPage = LengthAwarePaginator::resolveCurrentPage();

       $itemCollection = collect($operations);
      dd($itemCollection);

      $perPage = 5;

    //    // Slice the collection to get the items to display in current page
      //  $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

        $currentPageItems = $itemCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();

    //    // Create our paginator and pass it to the view
       $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

      
    //     // set url path for generted links
        $paginatedItems->setPath($request->url());

        // $paginatedItems->appends($request->except(['page']));




        
       // return view('dashboard.operations')->with('operations',$paginatedItems);
      // var_dump($operations);
       return view('dashboard.operations')->with('operations',$paginatedItems );

       

    }
    
    public function filteroperations(Request $request)
    {
        $statut = request('statut');
        $opcvm=request('opcvm');

        $client = new \GuzzleHttp\Client();

        $response=$client->request('GET','http://server.test/allOperWithFilters',[
            'query' => [
                'statut' => $statut,
                'opcvm' =>$opcvm
               
            ]
        ]);
        $operationsWithFilters=json_decode($response->getBody()->getContents(),true);
        
           if(count($operationsWithFilters) <= 0)
           {
               return view('dashboard.introuvable');
           }

        

        //pagination

       $currentPage = LengthAwarePaginator::resolveCurrentPage();

       $itemCollection = collect($operationsWithFilters);


       
       $perPage = 5;

       // Slice the collection to get the items to display in current page
       $currentPageItems = $itemCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();

       // Create our paginator and pass it to the view
       $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

      
        // set url path for generted links
        $paginatedItems->setPath($request->url());

        return view('dashboard.operationfilterresults')->with('results',$paginatedItems);

        //var_dump($statut);

    }

    public function allFonds()
    {
        $client = new Client();
       //get operations from the api

        $allfonds_response = $client->request('GET','http://server.test/allfonds');

        //decode the json response from api
        $fonds=json_decode($allfonds_response ->getBody()->getContents(),true);
        return view('dashboard.fonds')->with('fonds',$fonds);

    }
    public function simulation()
    {
        return view('dashboard.simulateur');

    }
    public function documentation()
    {
        return view('dashboard.documentation');

    }
}
