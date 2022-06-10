<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catalog') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white">
                    @if ($products->isNotEmpty())
                    <x-product-list>
                        @foreach($products as $product)
                            <x-product :product="$product">
                                <form action="{{ route('products.promote', $product)}}" method="post">
                                    @csrf
                                    <x-button>Promote</x-button>
                                </form>
                            </x-product>
                        @endforeach
                    </x-product-list>
                    @else
                        <div class="p-16 text-center text-2xl">Oups, Not items found in catalog.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
