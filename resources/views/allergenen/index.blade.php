<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allergenen Pagina</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">{{ $title }}</h1>
            <a href="{{ route('allergeen.create') }}" class="btn btn-primary">+ Nieuwe Allergeen</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Sluiten"></button>
            </div>
            <meta http-equiv="refresh" content="3;url={{ route('allergeen.index') }}">
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Sluiten"></button>
            </div>
            <meta http-equiv="refresh" content="3;url={{ route('allergeen.index') }}">
        @endif

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Naam</th>
                            <th>Omschrijving</th>
                            <th class="text-center">Wijzig</th>
                            <th class="text-center">Verwijder</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($allergenen as $allergeen)
                            <tr>
                                <td>{{ $allergeen->Id }}</td>
                                <td>{{ $allergeen->Naam }}</td>
                                <td>{{ $allergeen->Omschrijving }}</td>
                                <td class="text-center">
                                    <a href="{{ route('allergeen.edit', $allergeen->Id) }}" class="btn btn-success btn-sm">Wijzig</a>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('allergeen.destroy', $allergeen->Id) }}" method="POST"
                                        onsubmit="return confirm('Weet je zeker dat je dit allergeen wilt verwijderen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Verwijderen</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Geen allergenen beschikbaar</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
