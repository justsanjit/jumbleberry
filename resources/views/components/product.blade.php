@props(['product'])
<div>
    <div class="relative">
    <div class="relative w-full h-72 rounded-lg overflow-hidden">
        <img src="https://tailwindui.com/img/ecommerce-images/product-page-03-related-product-01.jpg" alt="Front of zip tote bag with white canvas, black canvas straps and handle, and black zipper pulls." class="w-full h-full object-center object-cover">
    </div>
    <div class="relative mt-4">
        <h3 class="text-sm font-medium text-gray-900">{{ $product->title }}</h3>
    </div>
    <div class="absolute top-0 inset-x-0 h-72 rounded-lg p-4 flex items-end justify-end overflow-hidden">
        <div aria-hidden="true" class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-50"></div>
        <p class="relative text-lg font-semibold text-white">$140</p>
    </div>
    </div>
    <div class="mt-6">
        {{ $slot }}
    <!-- <a href="#" class="relative flex bg-gray-100 border border-transparent rounded-md py-2 px-8 items-center justify-center text-sm font-medium text-gray-900 hover:bg-gray-200">Add to bag<span class="sr-only">, Zip Tote Basket</span></a> -->
    </div>
</div>
