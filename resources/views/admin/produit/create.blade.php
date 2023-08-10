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
                    
                    <div class="mb-7">
                        <label for="dropzone-file" class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500 dark:text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                            </svg>
                            <h2 class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">Click to upload or drag and drop</h2>
                            <p class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 512x512px)</p>
                            <input id="dropzone-file" type="file" class="hidden"
                                name="image"
                                id="image"
                                accept="image/svg+xml, image/jpeg, image/png, image/gif"
                            />
                        </label>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Créer</button>
                </div>
            </form>
        </div>  
    </div>

</x-app-layout>