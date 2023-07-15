<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Ajouter un Produit') }}
            </h2>
            <a href="{{ route('categories.create') }}" class="ml-auto">
                <button class="px-4 py-2 bg-blue-500 text-white rounded-md">Ajouter</button>
            </a>
        </div>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-x-auto bg-white dark:bg-gray-800 sm:px-12 sm:rounded-lg p-6">
            <!-- formulaire de création d'un produit -->
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex justify-center items-center flex-col">
                    <div class="relative mb-6" data-te-input-wrapper-init>
                        <label for="nom" class="block dark:text-white">Titre:</label>
                        <input
                            type="text" 
                            class="rounded dark:bg-gray-700 dark:text-white h-auto px-auto w-full "
                            name="nom"
                            id="nom"
                            placeholder="Titre"
                        />
                    </div>
                    <div class="relative mb-6">
                        <label for="category" class="block dark:text-white">Catégorie:</label>
                        <select
                            class="form-select rounded dark:bg-gray-700 dark:text-white"
                            name="category"
                            id="category"
                        >
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id     }}">{{ $categorie->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="relative mb-6">
                        <label for="image" class="block dark:text-white">Image:</label>
                        <input  
                            type="file"
                            class="rounded dark:bg-gray-700 dark:text-white h-auto px-auto w-full"
                            name="image"
                            id="image"
                            accept="image/svg+xml, image/jpeg, image/png, image/gif"
                        />
                    </div>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Créer</button>
                </div>
            </form>
        </div>  
    </div>

</x-app-layout>