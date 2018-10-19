

@extends('layouts.app')

@section('content')

        
    
    
     
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
         @foreach($results as $result)
             <tr>

             <td>{{$result['date_operation']}}</td>
             <td>{{$result['date_valeur']}}</td>
             <td>{{$result['opcvm']}}</td>
             <td>{{$result['vl_mad']}}</td>
             <td>{{$result['nombre_part']}}</td>
             <td>{{$result['montant_net']}}</td>
             <td>{{$result['statut']}}</td>

             </tr>
         @endforeach

       </tbody>

</table>
{{$results->links()}}

@endsection
<script>
        $(window).on('hashchange', function() {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                }else{
                    getPosts(page);
                }
            }
        });
        $(document).ready(function() {
            $(document).on('click', '.pagination a', function(e) {
                getPosts($(this).attr('href').split('page=')[1]);
                e.preventDefault();
            });
        });
        function getPosts(page) {
            $.ajax({
                url: '?page=' + page,
                dataType: 'json',
            }).done(function(data) {
                $('.posts').html(data);
                location.hash = page;
            }).fail(function() {
                alert('Posts could not be loaded.');
            });
        }
    
</script>