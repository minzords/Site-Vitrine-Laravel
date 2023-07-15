@extends ('pages.base')

@section ('content')

<div class="py-12 sm:px-6 lg:px-8 flex flex-wrap">
    @foreach ($produits as $produit)
    <div class="pb-7 pl-7 pr-2 mx-auto sm:mx-0">
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="p-5">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $produit->nom }}</h5>
            </div>
            <img class="rounded-t-lg" src="{{ asset( $produit->photo ) }}" alt="" />
        </div>
    </div>
    @endforeach
</div>
@endsection