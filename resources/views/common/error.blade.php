@if($errors->any())
    <div>
        @foreach($errors->all() as $error)
        {{$error}}<br>
        @endforeach
    </div>
@endif
