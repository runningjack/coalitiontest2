<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="{{url()}}/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <meta name="csrf_token" content="{{ csrf_token() }}" />

    </head>
    <body>
        <div class="container-fluid">
            <div class="content">
                <div class="row">

                        <form>
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <div class="col-md-6">


                                <div class="form-group">
                                    <label for="firstname">Product Name</label>
                                    <input type="text" id="productname" name="productname" class="form-control" required placeholder="first name" value="{{Input::old('productname')}}">
                                </div>

                                <div class="form-group">
                                    <label for="firstname">Qty In Stock</label>
                                    <input type="text" id="quantity" name="quantity" class="form-control" required placeholder="Quantity In stock" value="{{Input::old('quantity')}}">
                                </div>

                                <div class="form-group">
                                    <label for="firstname">Price</label>
                                    <input type="text" id="price" class="form-control" name="price" required placeholder="Price" value="{{Input::old('price')}}">
                                </div>

                                <div class="form-group">

                                    <a id="save" class="btn btn-primary">Submit</a>
                                </div>

                                <div id="productTable">

                                </div>

                            </div>


                            <di

                        </form>

                    </div>
            </div>
        </div>
    </body>
    <script src="{{url()}}/js/jquery-2.0.2.min.js"></script>
    <script src="{{url()}}/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(e){
            $("#save").on("click",function(){
                var token = $('meta[name="csrf_token"]').attr('content')
                var request = $.ajax({
                    url:"",
                    type:"post",
                    data:{pname:$("#productname").val(),quantity:$("#quantity").val(),price:$("#price").val(),_token:token},
                    dataType:"html"
                })

                request.done(function(data){
                    $("#productTable").html(data);
                })
            })
        })
    </script>
</html>
