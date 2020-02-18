@extends('layout')
@section('houses_content')
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
                    url: "{{ url('/houses') }}",
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
<div class="container">
    <h3 class="jumbotron">Here you can search for house</h3>
    <div class="alert alert-danger" style="display:none"></div>
    <form action="/houses" method="post">
        <div class="form-group">
            <label for="footballername">Footballer Name</label>
            <input type="text" name="footballername" class="form-control" placeholder="Enter Footballer Name" id="footballername">
        </div>


        <div class="form-group">
            <label for="club">Club</label>
            <input type="text" name="club" class="form-control" placeholder="Enter Club" id="club">
        </div>


        <div class="form-group">
            <label for="country">Country</label>
            <input type="text" name="country" class="form-control" placeholder="Enter Country" id="country">
        </div>


        <div class="form-group">
            <button class="btn btn-success" id="submit">Submit</button>
        </div>
    </form>
</div>


@endsection
