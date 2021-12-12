<head>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    
    <style>
        .border.border-3{
            border-width: 3px !important;
        }
        
        button{
            background:#1AAB8A;
            color:#fff;
            border:none;
            position:relative;
            height:60px;
            font-size:1.6em;
            padding:0 2em;
            cursor:pointer;
            transition:800ms ease all;
            outline:none;
        }
        input:hover{
            background:#fff;
            color:#1AAB8A;
        }
        input:before,button:after{
            content:'';
            position:absolute;
            top:0;
            right:0;
            height:2px;
            width:0;
            background: #1AAB8A;
            transition:400ms ease all;
        }
        input:after{
            right:inherit;
            top:inherit;
            left:0;
            bottom:0;
        }
        input:hover:before,button:hover:after{
            width:100%;
            transition:800ms ease all;
        }
        
        
        
        
       
    </style>
</head>

@extends('layouts.app')
@section('content')
    
    
    <!--<button class="flatbutton"><span id="buttonImage"></span></button>-->
    <!--<button class="flatbutton"><img src="{{-- asset('images/edit_button.jpg') --}}"></button>-->
    
    
    <i class="fab fa-500px "></i>
    <i class="fas fa-edit fa-9x" ></i>
    
    
    <i class="fas fa-trash-alt fa-lg " style="color: blue;"></i>
    <i class="fab fa-twitter fa-2x"></i>
    
    <input type="submit" class="tweet_button fab fa-3x" value="&#xf099; tweet" >
    
    <input type="submit" value="&#xf00c; save" class="fas fa-2x bg-secondary">
    
    <div class="float-left ml-3 mt-5" style="width: 50px">
        <input type="submit" value="&#xf00c; save" class="fas fa-2x bg-secondary">
    </div>
    
@endsection