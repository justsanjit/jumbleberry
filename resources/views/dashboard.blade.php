<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Products') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-white">
                        @if($approvedProducts->isNotEmpty())
                        <x-product-list heading="Approved Products">
                            @foreach($approvedProducts as $product)
                            <x-product :product="$product"/>
                            @endforeach
                        </x-product-list>
                        @endif

                        @if($pendingProducts->isNotEmpty())
                            <x-product-list heading="Pending Approval">
                                @foreach($pendingProducts as $product)
                                <x-product :product="$product"/>
                                @endforeach
                            </x-product-list>
                        @endif

                        @if($rejectedProducts->isNotEmpty())
                            <x-product-list heading="Rejected Product Approvals">
                                @foreach($rejectedProducts as $product)
                                <x-product :product="$product"/>
                                @endforeach
                            </x-product-list>
                        @endif

                        @if($pendingProducts->isEmpty() && $approvedProducts->isEmpty() && $rejectedProducts->isEmpty())
                            <div class="p-16 text-center text-2xl">Oups, You have not products to to promote yet.</div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
