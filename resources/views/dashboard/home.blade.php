@extends('layouts.app')

@section('content')


<div class="panel panel-default">
    <div class="panel-heading">Mes fonds performants</div>

    <div class="panel-body">
<table class="table table-hover">


       <thead>
       
             <th>
                 OPCVM
             </th>
       
             <th>
             Montant investi (MAD)
             </th>
             
             <th>
               nombre de parts
             </th>

             <th>
                Montant investi
             </th>
             <th>
                Montant valorise(MAD)
             </th>
             <th>
              value latente
            </th>
       </thead>
       <tbody>
           @foreach ($fonds as $fond)
           <tr>
                <td>{{$fond['opcvm']}}</td>
                <td>{{$fond['montant_investi']}}</td>
                <td>{{$fond['nombre_part']}}</td>
                <td>{{$fond['montant_investi']}}</td>
                <td>{{$fond['montant_valorise']}}</td>
                <td>{{$fond['value_latente']}}</td>
            </tr>
           @endforeach
     
       </tbody>
</table>
<a href="/allfonds"  class="btn btn-primary">Tous mes fonds</a>
</div></div>
<br/>

<div class="panel panel-default">
    <div class="panel-heading">Mes dernieres operations</div>

    <div class="panel-body">
<table class="table table-hover">


       <thead>
       
             <th>
                 date d'operation
             </th>
       
             <th>
              date de valeur
            </th>
             
             <th>
                OPCVM
            </th>

             <th>
                Montant net
             </th>
             <th>
                VL(mad)
             </th>
             <th>
                 Nombre de parts
             </th>
             
            <th>
                statut 
             </th>
       </thead>
       <tbody>
           @foreach ($operations as $operation)
            <tr>
                  <td>{{$operation['date_operation']}} </td>
                  <td>{{$operation['date_valeur']}}</td>
                  <td>{{$operation['opcvm']}}</td>
                  <td>{{$operation['montant_net']}}</td>
                  <td>{{$operation['vl_mad']}}</td>
                  <td>{{$operation['nombre_part']}}</td>
                  <td>{{$operation['statut']}}</td>

            </tr>
           @endforeach
       </tbody>
</table>
<a href="/alloperations" class="btn btn-primary">Tous mes operations</a>
</div></div>
@endsection