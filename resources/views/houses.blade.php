@extends('layout')
@section('houses_content')
    <script type="text/javascript">

        $(document).ready(function(){
            $('#search').click(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/houses') }}",
                    method: 'post',
                    data: {
                        name: $('#name').val(),
                        bedrooms: $("#bedrooms").val(),
                        bathrooms: $("#bathrooms").val(),
                        storeys: $("#storeys").val(),
                        garages: $("#garages").val(),
                        minPrice: $("#minPrice").val(),
                        maxPrice: $("#maxPrice").val()
                    },
                    success: function(data){
                        $('.alert-danger').hide();
                        $('.alert-danger').empty();
                        $.each(data.errors, function(key, value){
                            $('.alert-danger').show();
                            $('.alert-danger').append('<p>'+value+'</p>');
                        });
                        console.log(data);
                        if (data.length < 1) {
                            $("#resultField").text("Sorry, we have not houses with parameters, that you have set ...");
                        } else {
                            // let viewData = JSON.parse(data);
                            let table = "<table class=\"table\">\n" +
                                "                     <thead>\n" +
                                "                     <tr>\n" +
                                "                         <th scope=\"col\">Name</th>\n" +
                                "                         <th scope=\"col\">Price</th>\n" +
                                "                         <th scope=\"col\">Bedrooms</th>\n" +
                                "                         <th scope=\"col\">Bathrooms</th>\n" +
                                "                         <th scope=\"col\">Storeys</th>\n" +
                                "                         <th scope=\"col\">Garages</th>\n" +
                                "                     </tr>\n" +
                                "                     </thead>\n" +
                                "                     <tbody>\n";
                            for (let i = 0; i < data.length; i++) {
                                table += "<tr>\n" +
                                    "            <td>" + data[i].name + "</td>\n" +
                                    "            <td>" + data[i].price + "</td>\n" +
                                    "            <td>" + data[i].bedrooms + "</td>\n" +
                                    "            <td>" + data[i].bathrooms + "</td>\n" +
                                    "            <td>" + data[i].storeys + "</td>\n" +
                                    "            <td>" + data[i].garages + "</td>\n" +
                                    "        </tr>";

                            }
                            table += "                     </tbody>\n" +
                                "                 </table>";
                            $("#resultField").html(table);
                        }
                    }

                });
            });
        });
    </script>
<div class="container">
    <h3 class="jumbotron">Here you can search for house</h3>
    <div class="alert alert-danger" style="display:none"></div>

    <form action="/houses" method="post">
        <div class="form-group">
            <label for="name">Name of house:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter a name of house">
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="bedrooms">Choose a number of bedrooms:</label>
                <input type="number" min="0" class="form-control" id="bedrooms" >
            </div>
            <div class="form-group col-md-3">
                <label for="bathrooms">Choose a number of bathrooms</label>
                <input type="number" min="0" class="form-control" id="bathrooms" >
            </div>
            <div class="form-group col-md-3">
                <label for="storeys">Choose a number of storeys:</label>
                <input type="number" min="0" class="form-control" id="storeys" >
            </div>
            <div class="form-group col-md-3">
                <label for="garages">Choose a number of garages:</label>
                <input type="number" min="0"  class="form-control" id="garages" >
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="minPrice">Choose minimal price:</label>
                <input type="number" min="0" step="1000" class="form-control" id="minPrice" >
            </div>
            <div class="form-group col-md-6">
                <label for="maxPrice">Choose maximal price:</label>
                <input type="number" min="0" step="1000" class="form-control" id="maxPrice" >
            </div>
        </div>

        <button type="button" id="search" class="btn btn-primary">Search</button>
    </form>

    <div id="resultField"></div>

</div>


@endsection
