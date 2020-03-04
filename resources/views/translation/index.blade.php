@extends('layouts.app')

@section('content')
<div class="container">
    <input id="language" type="hidden" value="{{$lang}}"> 
    <div>
        <form class="row">
            <div class="col">
                <input name="original" id="original" placeholder="Original"> 
                <p id="original_required"  class="text-danger" style="display:none"> Required </p>
            </div>
            <div class="col">   
                <input name="ro" id="ro" placeholder="{{strtoupper($lang)}}"> 
                <p id="ro_required" class="text-danger" style="display:none">Required</p> 
            </div>
            <div class="col">
                <button type="button" class="btn btn-success add-ro">Add</button>
            </div>
        </form>
    </div>
    <table class="table data-table">
        <thead>
            <tr>
                <th>Original</th>
                <th>{{strtoupper($lang)}}</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($translations as $index=>$translation) 
        <tr>
            <td> {{$index}} </td>
            <td> {{$translation}} </td>
            <td> 
                <button type="button" class="btn btn-default btn-sm delete" value="{{$index}}">
                    <span class="glyphicon glyphicon-trash">Trash</span>
                </button>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
