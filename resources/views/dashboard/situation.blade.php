@extends('layouts.app')
@section('content')
<form action="/compteselection" method="POST">

        {{csrf_field()}}

        <label for="compte">Choisir un compte</label>
        <select name="compte" id="compte">
             @foreach ($comptes as $compte)
                <option value="{{$compte->id}}">{{$compte->name}}</option>
             @endforeach
        </select>
        <div class="form-group">
         <button class="btn btn-success" type="submit">
                   
                          filtrer
         </button>

        </div>
</form>

@endsection