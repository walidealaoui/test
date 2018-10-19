@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Mes fonds</div>

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
</div></div>
@endsection