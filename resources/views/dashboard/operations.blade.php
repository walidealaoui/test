

@extends('layouts.app')

@section('content')

        <form action="/results" method="get">
    
                {{csrf_field()}}
    
                Filtres<br><br>
                  <div class="form-group">
    
                     <label for="statut">statut</label>
                     <select name="statut" id="statut">
                     <option>annule</option>   
                     <option>encours</option>   
                     <option>valide</option>   

                     </select>

                       {{-- <input type="text" name="statut" > --}}
    
                       <label for="opcvm">OPCVM</label>
                        <select name="opcvm" id="opcvm">
                         @foreach ($operations as $operation)
                      <option value="{{$operation['id']}}">{{$operation['opcvm']}}</option>
                         @endforeach
                     </select>
                       {{-- <input type="text" name="opcvm" > --}}
    
                  </div>
                <div class="form-group">
                        
                    
                          
                        <button class="btn btn-success" type="submit">
                           
                                  filtrer
                        </button>
    
                    
    
                 </div>
            </form>
    
    
     
<div class="panel panel-default">
    <div class="panel-heading">Mes operations</div>

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
                VL(mad)
             </th>
             <th>
                 Nombre de parts
             </th>
             <th>
               montant net
            </th>
            <th>
                statut 
             </th>
       </thead>
       <tbody>
         @foreach($operations as $operation)
             <tr>

             <td>{{$operation['date_operation']}}</td>
             <td>{{$operation['date_valeur']}}</td>
             <td>{{$operation['opcvm']}}</td>
             <td>{{$operation['vl_mad']}}</td>
             <td>{{$operation['nombre_part']}}</td>
             <td>{{$operation['montant_net']}}</td>
             <td>{{$operation['statut']}}</td>

             </tr>
         @endforeach

       </tbody>

</table>
{{$operations->links()}}

@endsection
