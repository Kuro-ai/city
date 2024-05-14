<div>
    <div id="search-bar">
        <form class="d-flex" role="search">
            <input wire:model.live="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        </form>
    </div>
    <div class="container w-full px-5 py-6 mx-auto">
        <form action="{{ route('customer.order.addToCart') }}" method="post" onsubmit="return checkSelection()" class="grid grid-cols-4 gap-6">
            <input type="text" name="reservation_id" value="{{ session()->get('reservation_id') }}" class="hidden">
            @csrf
            @foreach ($menus as $menu)
                <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                    <img class="w-full h-48" src="{{ asset('menus/' . $menu->image) }}" alt="Image" />
                    <div class="px-6 py-4">
                        <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">
                            {{ $menu->name }}</h4>
                        <p class="leading-normal text-gray-700">{{ $menu->description }}.</p>
                    </div>
                    <div class="px-6 py-4">
                        <span class="text-xl text-green-600">${{ $menu->price }}</span>
                        <input type="checkbox" name="menus[]" value="{{ $menu->id }}">
                        <input type="number" name="quantities[{{ $menu->id }}]" min="1" value="1">
                    </div>
                </div>
            @endforeach
            <button type="submit" onclick="checkSelection()" class="col-span-4">Add to Cart</button>
        </form>
    </div>
</div>
