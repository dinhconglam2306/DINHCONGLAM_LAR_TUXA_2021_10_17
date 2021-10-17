@if ($errors->any())
    <div class="col-md-12 col-sm-12 col-xs-12 text-center mb-5">
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
            @endforeach
        </div> 
     </div>
@endif