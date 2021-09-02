<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</head>
<body>

    <div class="container">
        <h1>Shopping Cart</h1>
        <a href="{{ url('/') }}" class="btn btn-success">Continue Shopping</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Note</th>
                    
                    <!-- CLEAR CART -->
                    <th scope="col"><a href="{{ url('/cart/clear/') }}" class="btn btn-outline-danger btn-sm">CLEAR</a></th>
                </tr>
            </thead>
            <tbody>
                @if (isset($items))
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item['mID'] }}</td>
                            <td>{{ $item['mName'] }}</td>
                            <td>{{ (float)$item['mPrice'] }}</td>
                            <td>
                                <select class="custom-select custom-select-sm" data-ssID="{{$item['ssID']}}" id="QttSelOpt">
                                    @for ($i=1; $i<=100; $i++)
                                    <option value="{{$i}}" {{$i==$item['mQtt'] ? "selected" : ""}}>{{$i}}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                {{ (float)$item['mPrice'] * (int)$item['mQtt'] }}
                            </td>
                            <td>{{ $item['mNote'] }}</td>
                            <td><button class="btn btn-outline-warning RemoveItem" data-ssID="{{$item['ssID']}}">x</button></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>    
</body>
</html>


<script>
    $(document).ready(function () {

        // UPDATE ITEM QUANTITY
        $("body").on("change", "#QttSelOpt", function(e) {
            var ssID = $(this).attr("data-ssID");
            var newQtt = $(this).val();
            var token = "{{ csrf_token() }}";
            var type = "PUT";
            var formData = {
                ssID: ssID,
                newQtt: newQtt,
                _token: token,
            }
            var ajaxurl = "{{ url('/cart/update/') }}"+"/"+ssID;
            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    location.reload();
                }
            });
        });
        
        // REMOVE ITEM
        $("body").on("click", ".RemoveItem", function(e) {
            var ssID = $(this).attr("data-ssID");
            var token = "{{ csrf_token() }}";
            var type = "PUT";
            var formData = {
                ssID: ssID,
                _token: token,
            }
            var ajaxurl = "{{ url('/cart/remove/') }}"+"/"+ssID;
            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    location.reload();
                }
            });
        });

    });
</script>
