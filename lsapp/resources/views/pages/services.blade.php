<!--Remeber the flow
    1. From URL    www.xyz.com/services
    2. routes/web.php  
    3. Http/PagesController.php
    4. views/pages/services.blade.php
-->

@extends('layouts.app')

@section('content')
       <h1>{{$title}}</h1> 
       <h1><?php echo $title ?></h1> 
       <p>This is the services page</p>
       @if(count($services) > 0 )
           <ul class="list-group">
               @foreach( $services as $service )
                   <li class="list-group-item">{{$service}}</li>    
               @endforeach
           </ul>
       @endif
@endsection