@extends('layout.main')

@section('content')

<div class="container mt-4">
    <!-- Account page navigation-->
    
   
    <div class="row">
    	<div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Upload image</div>
                <div class="card-body">
                    
                    <form action="{{route('uploadImage')}}" method="post" enctype="multipart/form-data" class="form-inline">
                        @csrf
                        <div class="form-group col-md-8">
                            <input type="file" name="file" class="form-control-file" id="chooseFile">
                        </div>
                        <div class="form-group col-md-4">
                            <button  type="submit" name="submit" class="btn btn-primary btn-block">
                            Upload Files
                            </button>
                            
                        </div>
                        <div class="alert-text"> All images will save in original size !!!</div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-4">   
            <div class="card mb-4">
                <div class="card-header">Information</div>
                <div class="card-body">
                     @if(session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{session()->get('success')}}
                        </div> 
                    @endif
                    @if(session()->has('error')) 
                        <div class="alert alert-danger" role="alert">
                            {{session()->get('error')}}
                        </div>
                    @endif

                    @if($errors->any())
                        <ul style="margin-bottom: 20px;color: #ff6d5f">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                        </ul>
                    @endif
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">List images</div>
                <div class="card-body">
                    <ul class="images">
                        @foreach($images as $image)
                        <li>
                            <img src="{{asset('uploads/'.$image->name)}}">
                            <div class="button-cont">
                                <div class="remove"><i class="far fa-trash-alt"></i> remove</div>
                                <div class="is_ictive">disable</div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-4">   
            
        </div>
    </div>
</div>

<style type="text/css">
    .images{
        list-style: none;
        margin: 0px;
        padding: 0px;
    }
    .images li{
        float: left;
        width: 150px;
        height: 150px;
        text-align: center;
        margin: 10px;
        position: relative;
    }
    .images li img{
        max-width:150px;
        max-height:150px;

    }
    .images li .button-cont{
        position: absolute;
        width: 100%;
        height: 30px;
        background: #000000bf;
        bottom: 0px;
        line-height: 27px;
    }
    .images li .button-cont .remove{
        width: 74px;
        height: 100%;
        float: left;
        border-right: 1px solid #777;
        cursor: pointer;
        color: #d67373;
        font-size: 13px;

    }
    .images li .button-cont .remove:hover{
        background: #000;
        color: #fff;
    }
    .images li .button-cont .is_ictive{
        width: 75px;
        float: left;
        height: 100%;
        cursor: pointer;
    }
    .images li .button-cont .is_ictive:hover{
        color: #fff;
        background: #000;
    }
    .alert-text{
        text-align: right;
        color: #ff8181;
        font-size: 14px;
        width: 100%;
        padding-top: 15px;
        padding-right: 32px
    }
</style>
@stop