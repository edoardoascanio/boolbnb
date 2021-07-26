<form class="delete_form" action="{{ route('logged.destroy', $accomodation->id) }}" method="post">
        @csrf
        @method('DELETE')

        <input id="ciao" class="log" type="submit" value="Elimina" onclick="return confirm('Are you sure you want to delete this item?')">
</form>