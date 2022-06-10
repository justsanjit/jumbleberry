<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Area') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white">
                    @if($users->isNotEmpty())
                        @foreach($users as $user)
                        <x-product-list heading="{{ $user->name}} ({{ $user->email }})">
                                @foreach($user->products as $product)
                                    <x-product :product="$product">
                                        <div class="flex space-x-4">
                                            <form action="{{ route('product-approval.status', [$product, $user])}}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="approved" />
                                                <x-button>Approve</x-button>
                                            </form>
                                            <form action="{{ route('product-approval.status', [$product, $user])}}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="rejected" />
                                                <x-button >Decline</x-button>
                                            </form>
                                        </div>
                                    </x-product>
                                @endforeach
                            </x-product-list>
                        @endforeach
                    @else
                        <div class="p-16 text-center text-2xl">Yayy, You don't have any pending approval requests.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
