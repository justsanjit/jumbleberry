@props(['product'])
<div>
    <div class="relative">
    <div class="relative w-full h-72 rounded-lg overflow-hidden">
        <img src="{{ $product->image_url }}" alt="{{ $product->title }}" class="w-full h-full object-center object-cover">
    </div>
    <div class="relative mt-4">
        <h3 class="text-sm font-medium text-gray-900">{{ $product->title }}</h3>
        @can('manage_products')
            <form method="post" action="{{ route('products.update', $product)}}">
                @csrf
                @method('patch')
                <select name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="on-hold" @selected($product->status->value === 'on-hold')>On Hold</option>
                    <option value="active" @selected($product->status->value === 'active')>Active</option>
                    <option value="expired" @selected($product->status->value ==='expired')>Expired</option>
                </select>
                <x-button class="mt-1">Update</x-button>
            </form>
        @endCan
    </div>
    <div class="absolute top-0 inset-x-0 h-72 rounded-lg p-4 flex items-end justify-end overflow-hidden">
        <div aria-hidden="true" class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-50"></div>
        <p class="relative text-lg font-semibold text-white">{{ $product->monthly_inventory }} {{ \Illuminate\Support\Str::plural('item', $product->monthly_inventory) }} left</p>
    </div>
    </div>
    <div class="mt-6">
        {{ $slot }}
    </div>
</div>
