<html>
<head>
    <meta name="_token" content="{{csrf_token()}}" />
    <title>Laravel Ajax Validation Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>


<div class="container">
    <h3 class="jumbotron">Here you can search for house</h3>
    <div class="alert alert-danger" style="display:none"></div>
    <form action="/form" method="post">
        <div class="form-group">
            <label for="footballername">Footballer Name</label>
            <input type="text" name="footballername" class="form-control" placeholder="Enter Footballer Name" id="footballername">
        </div>


        <div class="form-group">
            <label>Club</label>
            <input type="text" name="club" class="form-control" placeholder="Enter Club" id="club">
        </div>


        <div class="form-group">
            <strong>Country</strong>
            <input type="text" name="country" class="form-control" placeholder="Enter Country" id="country">
        </div>


        <div class="form-group">
            <button class="btn btn-success" id="submit">Submit</button>
        </div>
    </form>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        $('#submit').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/form') }}",
                method: 'post',
                data: {
                    name: $('#footballername').val(),
                    club: $('#club').val(),
                    country: $('#country').val()
                },
                success: function(data){
                    $('.alert-danger').hide();
                    $('.alert-danger').empty();
                    $.each(data.errors, function(key, value){
                        $('.alert-danger').show();
                        $('.alert-danger').append('<p>'+value+'</p>');
                    });
                    console.log(data);
                }

            });
        });
    });
</script>

</body>
</html>
