@props(['heading' => null])
<div class="max-w-2xl mx-auto p-4 sm:p-6 lg:max-w-7xl lg:p-8">
    @if($heading)
        <h2 class="text-xl font-bold text-gray-900">{{ $heading }}</h2>
    @endif
    <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
        {{ $slot }}
    </div>
</div>
