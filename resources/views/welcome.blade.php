<form action="{{route('statuses.store')}}" method="post">
    @csrf
    <textarea name="body" cols="30" rows="10"></textarea>

    <button id="create-status">Publica Estado</button>
</form>
