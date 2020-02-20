@if ($errors->any())
    <div dusk="validation-errors"
         class="alert alert-danger">
        @foreach($errors->all() as $error)
            {{$error}}
        @endforeach
    </div>
@endif
