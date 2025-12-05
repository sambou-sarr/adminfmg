<form action="{{ route('commandes.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" accept=".xlsx,.xls,.csv" required>
    <button type="submit">Importer</button>
</form>
