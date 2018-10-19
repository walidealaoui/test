<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Ixudra\Curl\Facades\Curl;

use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;

class BackController extends Controller
{
    // 

    //cette fonction recupere la liste de tous les fonds offerts par l eweb service de ckg,en passant par la com server to server par guzzle
    public function getFonds()
    {
         
        $client = new Client();
       
        $allfonds_response = $client->request('GET','http://localhost:3000/');
      
        dd($allfonds_response->getBody()->getContents());

     


     //  $response = $client->send($request);
       
     //  dd($response); 


      //  dd($request->getUrl());

        //decode the json response from api
       // $fonds=json_decode( $allfonds_response ->getBody()->getContents(),true);
      //  return view('dashboard.fonds')->with('fonds',$fonds);
        // return $fonds;
       //return $response->json();



       
       /*  $response = Curl::to('http://server.test/alloperations')->get();
        return $response; */

        //dd($response); 
     } 

     public function getFondData($id)
     {
      
      $client = new Client();
       
      $fond_data = $client->request('GET','http://localhost:3000/fond/'.$id);
    
      dd($fond_data->getBody()->getContents());
     }


     public function getClientsOperations($clt_ref_ckg)
     {
       

     }
}


