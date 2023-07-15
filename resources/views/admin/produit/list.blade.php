<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Les Produits') }}
            </h2>
            <a href="{{ route('product.create') }}" class="ml-auto">
                <button class="px-4 py-2 bg-blue-500 text-white rounded-md">Ajouter</button>
            </a>
        </div>
    </x-slot>

    @if (session('Succès'))
        <div class="bg-green-500 text-white px-4 py-2 rounded-md mx-auto w-2/4 mt-4 flex items-center justify-between">
            <div>{{ session('Succès') }}</div>
            <button type="button" class="text-white text-sm" onclick="this.parentElement.style.display = 'none'">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                    <path
                        d="M12.02 10l6-6L16 2l-6 6l-6-6L3.98 4l6 6l-6 6l1.02 1.02l6-6l6 6L16 16l-6-6z" />
                </svg>
            </button>
        </div>
    @endif

    <div class="py-12 max-w-7xls mx-auto sm:px-6 lg:px-8">
        <div class="overflow-x-auto bg-white dark:bg-gray-800 sm:px-12 sm:rounded-lg p-6">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2 dark:text-white w-2/4">Nom</th>
                        <th class="px-4 py-2 dark:text-white w-1/4">Logo</th>
                        <th class="px-4 py-2 dark:text-white w-1/4">Catégorie</th>
                        <th class="px-4 py-2 dark:text-white w-1/12">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produits as $produit)
                        <tr>
                            <td class="border px-4 py-2 dark:text-white  text-center">{{ $produit->nom }}</td>
                            <td class="border px-4 py-2">
                                <img src="{{ asset( $produit->photo ) }}" alt="{{ $produit->nom }}" class="h-12 mx-auto">
                            </td>
                            @foreach ($produit->categories as $categorie)
                                <td class="border px-4 py-2 dark:text-white  text-center">{{ $categorie->nom }}</td>
                            @endforeach
                            <td class="border px-4 py-2 whitespace-nowrap">
                                <a href="{{ route('product.edit', $produit->id) }}">
                                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md">Modifier</button>
                                </a>
                                <a href="{{ route('product.delete', $produit->id) }}">
                                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md">Supprimer</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>