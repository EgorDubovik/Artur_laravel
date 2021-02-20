<script type="text/javascript">
    var services = [];
</script>


    @foreach($services as $service)
        <div class="line_service" data-key = {{$service->id}}>
            <h6 class="mb-1">{{$service->title}}</h6>
            <div class="row">
                <div class="conteiner_select" style="width: 100%"></div>
                <div class="col-6">
                    <div class="add_line">
                        <a href="#" onclick="addSelect(this);return false;">Add line</a>
                    </div>
                </div>
                
            </div>
        </div>
        <hr class="my-4">
        <script type="text/javascript">
            services[{{$service->id}}] = [
                @foreach($service->pod_services as $pod_service)
                    {
                        title : '{{$pod_service->title}}',
                        id : {{$pod_service->id}},
                        @if(is_null($pod_service->price))
                            price : null,
                            pod_service : [
                                @foreach($pod_service->pod_services as $dop_pod_service)
                                    {
                                        title : '{{$dop_pod_service->title}}',
                                        id : {{$dop_pod_service->id}},
                                        price : {{$dop_pod_service->price}},
                                    },
                                @endforeach
                            ],
                        @else
                        price : {{$pod_service->price}},
                        pod_service : null,
                        @endif
                    },
                @endforeach
            ]
        </script>
    @endforeach   
<div class="row">
    <div class="col-6"></div>
    <div class="col-2"><b>Total:</b></div>
    <div class="col-2"><b id="total_price">$0.00</b></div>
    <div class="col-2"></div>
</div>
<script type="text/javascript">
    window.onload = function(e){
        $(document).keypress(
          function(event){
            if (event.which == '13') {
              event.preventDefault();
            }
        });
        
    }

    function string_return (podservices){
        var div = '<div class="select-line row"><div class="col-6">';
        var s = "<select name='service[]' class='form-control select_serv' onchange='count_pr(this)'><option>Select...</option>";
        for(var i=0;i<podservices.length;i++){
            var serv = podservices[i];
            if(serv.pod_service){
                s +="<optgroup label='"+serv.title+"'>";
                for(var j = 0; j<serv.pod_service.length;j++){
                    s+="<option value="+serv.pod_service[j].id+" data-prefix='null' data-price='"+serv.pod_service[j].price+"'>"+serv.pod_service[j].title+"</option>";
                }
                s += "</optgroup>";
            } else {
                s+="<option value="+serv.id+" data-prefix='null' data-price='"+serv.price+"'>"+serv.title+"</option>";
            }
        }
        s+="</select>";

        div +=s;
        div += '</div><div class="col-2"><span class="count">count</span></div><div class="col-2"><span class="price">$0.00</span></div><div class="col-2"><a href="#" class="remove_service" onClick="removeLine(this);return false">x</a></div>';
        return div;
    }

    function fillSelect(){
        $('.line_service').each(function(){
            var id = $(this).attr("data-key");
            var div = string_return(services[id]);
            $(this).find('.conteiner_select').append(div);    
        });
    }

    function addSelect(d){
        var parent = $(d).parent().parent().parent().parent();
        var id = parent.attr("data-key");
        var div = string_return(services[id]);
        parent.find('.conteiner_select').append(div);

    }

    function removeLine(d) {
        $(d).parent().parent().remove();
        count_total();
    }

    function count_pr(d){
        var op = $(d).find("option:selected");

        $(d).parent().parent().find("span.price").html("$"+(op.attr("data-price")/100).toFixed(2));
        $(d).parent().parent().find("span.count").html('<input style="width:60px;" type="text" name="count[]" class="form-control count_local" onblur="count_local_total(this)" value="1"/>');
        count_total();
    }
    function count_local_total(d){
        let count = parseInt($(d).val());
        let parent = $(d).closest('.select-line');
        let price = parent.find("option:selected").attr("data-price");
        let local_total = ((count*price)/100).toFixed(2);
        parent.find("span.price").html("$"+local_total);
        count_total();
    }

    function count_total(){
        let total = 0;
        
        $('.conteiner_select option:selected').each(function(){
            let count = $(this).parents('.select-line').find('input.count_local').val();
            let local_total = $(this).attr("data-price")*count;
            total += local_total;
        });
        let ftotal = (total/100).toFixed(2);
        $('#total_price').html('$'+ftotal);
    }
</script>