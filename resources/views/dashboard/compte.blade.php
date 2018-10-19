@extends('layouts.app')

@section('content')
<form action="/compteselection" method="POST">

    {{csrf_field()}}

    <label for="compte">Choisir un compte</label>
    <select name="compte" id="compte">
         @foreach ($comptes as $compte)
            <option value="{{$compte->id}}" {{ ( $compte->id ==$compte_id) ? 'selected' : '' }}>{{$compte->name}}</option>
         @endforeach
    </select>
    <div class="form-group">
     <button class="btn btn-success" type="submit">
               
                      filtrer
     </button>

    </div>
  </form>

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
              <td>{{$fond['nom_fond']}} </td>
              <td>{{$fond['mnt_investi']}}</td>
              <td>{{$fond['parts']}}</td>
              <td>{{$fond['mnt_investi']}}</td>
              <td>{{$fond['mnt_valorise']}}</td>
              <td>{{$fond['pvll']}}</td>
            

        </tr>
       @endforeach
     
       </tbody>
</table>
<a href="/fonds/{{$compte_id}}"  class="btn btn-primary">Tous mes fonds</a>
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
                  <td>{{$operation['nom_fond']}}</td>
                  <td>{{$operation['montant_net']}}</td>
                  <td>{{$operation['vl_mad']}}</td>
                  <td>{{$operation['nombre_part']}}</td>
                  <td>{{$operation['statut']}}</td>

            </tr>
           @endforeach
       </tbody>
</table>
<a href="/loadoperationscomponent/{{$compte_id}}" class="btn btn-primary">Tous mes operations</a>
</div></div>
@endsection