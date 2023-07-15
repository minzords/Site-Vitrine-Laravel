<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Les Categories') }}
            </h2>
            <a href="{{ route('categories.create') }}" class="ml-auto">
                <button class="px-4 py-2 bg-blue-500 text-white rounded-md">Ajouter</button>
            </a>
        </div>
    </x-slot>

    <div class="py-12 max-w-7xls mx-auto sm:px-6 lg:px-8">
        <div class="overflow-x-auto bg-white dark:bg-gray-800 sm:px-12 sm:rounded-lg p-6">
            <!-- formulaire de création d'une categorie -->
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="flex justify-center items-center flex-col">
                    <div class="relative mb-6" data-te-input-wrapper-init>
                        <label for="content" class="block dark:text-white">Titre:</label>
                        <input
                            type="text" 
                            class="rounded dark:bg-gray-700 dark:text-white h-auto px-auto w-full "
                            name="nom"
                            id="nom"
                            placeholder="Titre"
                        />
                    </div>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Créer</button>
                </div>
            </form>
        </div>  
    </div>
</x-app-layout>