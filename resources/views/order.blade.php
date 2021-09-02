<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order</title>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
        <h1>The List</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">P_Name</th>
                    <th scope="col">P_Price</th>
                    <th scope="col">Option</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->P_Name}}</td>
                        <td>{{$product->P_Price}}</td>
                        <td><button class="btn btn-outline-secondary open-modal" value="{{$product->id}}">Add To Card</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br>
        <div class="div">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-3">Total Item</div>
                <div class="col-md-3">{{$totalItem}}</div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-3">Total Quantity</div>
                <div class="col-md-3">{{$totalQuantity}}</div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-3">Total Price</div>
                <div class="col-md-3">{{$totalPrice}}</div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-7">
                    <a class="btn btn-secondary" href="{{ url('cart') }}">Check Shopping Cart</a>
                    <a class="btn btn-outline-secondary" href="{{ url('session') }}">Check Session</a>
                    <a class="btn btn-outline-secondary" href="{{ url('model') }}">Check Model</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="CartModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ADD TO CART</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- ADD ITEM TO CART -->
                <form method="post" action="{{ url('cart/add') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="ssID" name="ssID" value="">
                        <input type="hidden" id="mID" name="mID" value="">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="form-label">Name:</label>
                                <input type="text" class="form-control" id="mName" name="mName" value="" readonly></input>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-label">Price:</label>
                                <input type="text" class="form-control" id="mPrice" name="mPrice" value="" readonly></input>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-label">Quanity: (from 1 to 100)</label>
                                <input type="text" class="form-control" id="mQtt" name="mQtt" value=""></input>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-label">Note</label>
                                <input type="text" class="form-control" id="mNote" name="mNote" value="" placeholder="Type here..."></input>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</body>
</html>

<script type="text/javascript">
    $(document).ready(function() {

        // OPEN MODAL ADD TO CART
        $("body").on("click", ".open-modal", function () {
            var id = $(this).val();
            var url = "{{ url('/openmodal/') }}"+"/";
            // console.log(id);
            $.get(url+id, function(data) {
                // console.log(data);
                let unique = new Date();
                let ssID = "id"+data.id+"session"+unique.valueOf();
                $("#mID").val(data.id);
                $("#mName").val(data.P_Name);
                $("#mPrice").val(data.P_Price);
                $("#mQtt").val(1);
                $("#mNote").val("");
                $("#ssID").val(ssID);
                $("#CartModal").modal("show");
            });
        });

    });
</script>