@extends('layout.main')

@section('content')

<div class="container mt-4">
    <!-- Account page navigation-->
    
   
    <div class="row">
    	<div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    @if(isset($event) && $event)
                        @if($error)
                            <div class="alert alert-danger" role="alert">
                                Samething went wrong !!!
                            </div> 
                        @else 
                            <div class="alert alert-success" role="alert">
                                Save successful
                            </div>
                        @endif
                    @endif
                    <form method="post">
                        @csrf
                        <input type="hidden" name="event" value="add_new_user">
                        <!-- Form Row-->
                        <div class="form-row">
                            <!-- Form Group (first name)-->
                            <div class="form-group col-md-6">
                                <label class="small mb-1" for="inputFirstName">First name</label>
                                <input class="form-control" id="inputFirstName" type="text" placeholder="Enter first name" name="first_name" />
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="form-group col-md-6">
                                <label class="small mb-1" for="inputLastName">Last name</label>
                                <input class="form-control" id="inputLastName" name="last_name" type="text" placeholder="Enter last name"/>
                            </div>
                        </div>
                        <!-- Form Row        -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="small mb-1" for="inputEmail">Email</label>
                                <input class="form-control" id="inputEmail" type="text" placeholder="Enter Email" name="email" />
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label class="small mb-1" for="inputPassword">Password</label>
                                <div class="input-group">
                                    <input class="form-control" id="inputPassword" type="text" placeholder="Enter new password" name="password" />
                                    <div class="input-group-append">
                                        <button onClick='genpassword()' class="btn btn-info" type="button"><i class="fas fa-key"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            function genpassword(){
                                var countw = 10;
                                var i = 0;
                                var inp = document.getElementById("inputPassword");
                                function getmr(){
                                    i++;
                                    var i2 = 0;
                                    var s = inp.value;
                                    if(i<=countw){
                                        var t2 = window.setInterval(function(){
                                            nl = get_random_w();
                                            inp.value = s+nl;
                                            i2++;
                                            if(i2==15) 
                                            {
                                                window.clearInterval(t2);
                                                getmr();
                                            }
                                        },25);
                                    }
                                }
                                getmr();
                            }

                            function get_random_w(){
                                var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!-';
                                var charactersLength = characters.length;
                                return characters.charAt(Math.floor(Math.random() * charactersLength));
                            }

                        </script>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="small mb-1" for="text_description">Description</label>
                                <textarea class="form-control" id="text_description" name="description"></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                
                                <label class="small mb-1" for="text_shops">Shops</label>
                                <textarea class="form-control" id="text_shops" name="shops"></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group" style="padding-left: 20px;">
                                <div class="custom-control custom-checkbox" >
                                    <input class="custom-control-input" id="customCheck2" type="checkbox" name="admin">
                                    <label class="custom-control-label" for="customCheck2">Super admin permissions</label>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="margin-bottom: 20px;">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Выставить счет сразу...
                                    </a>
                            </h5>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#headingOne">
                                <div class="card-body">

                                    <script type="text/javascript">
                                        var serives = [
                                            @foreach($services as $service)
                                            {
                                                title: '{{$service->title}}',
                                                pod_service:[
                                                    @foreach($service->services as $pod_service)
                                                        {
                                                            title:'{{$pod_service->title}}',
                                                            prefix:'{{$pod_service->prefix->prefix}}',
                                                            price : {{$pod_service->price}}
                                                        },
                                                    @endforeach        
                                                ]
                                            },
                                            @endforeach   
                                        ]
                                    </script>
                                    <div class="conteiner_select" id="container_select">
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="add_line">
                                                <a href="#" onclick="addSelect();return false;">Add line</a>
                                            </div>
                                        </div>
                                        <div class="col-2"><b>Total:</b></div>
                                        <div class="col-2"><b>$0.00</b></div>
                                        <div class="col-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit" type="button">Save User</button>
                    </form>
                    <script type="text/javascript">
                        window.onload = function(e){
                            addSelect();
                        }

                        function addSelect(){
                            var div = '<div class="select-line row"><div class="col-6">';
                            var s = "<select class='form-control' onchange='count_pr(this)'><option>Select...</option>";
                            for(var i=0;i<serives.length;i++){
                                s +="<optgroup label='"+serives[i].title+"'>";
                                for(var j = 0; j<serives[i].pod_service.length;j++){
                                    s+="<option data-price='"+serives[i].pod_service[j].price+"'>"+serives[i].pod_service[j].title+"</option>";
                                }
                                s += "</optgroup>";
                            }
                            s+="</select>";

                            div +=s;
                            div += '</div><div class="col-2">per <span class="prefix">...</span></div><div class="col-2"><span class="price">$0.00</span></div><div class="col-2"><a href="#" class="remove_service" onClick="removeLine(this);return false">x</a></div>';
                            $('#container_select').append(div);
                        }

                        function removeLine(d) {
                            $(d).parent().parent().remove();
                        }

                        function count_pr(d){
                            var op = $(d).find("option:selected");
                            console.log(op.attr("data-price"));
                            $(d).parent().parent().find("span.price").html("$"+op.attr("data-price"));
                        }
                    </script>
                </div>
            </div>
        </div>
        <div class="col-xl-4">   
            <div class="card mb-4">
                <div class="card-header">Information</div>
                <div class="card-body">
                    <form method="post">
                        @csrf
                        <label class="small mb-1" for="inputPrice">Amount due</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light">$</span>
                            </div>
                            <input type="text" id="inputPrice" class="form-control" placeholder="Enter Amount" name="amount">
                            
                            

                        </div>
                       

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@stop