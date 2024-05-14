<div>
    <div id="search-bar">
        <form class="d-flex" role="search">
            <input wire:model.live="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        </form>
    </div>
    <div class="mx-auto justify-center items-center flex">
        <form id="addToCartForm" action="{{ route('admin.order.addToCart') }}" method="post"
            onsubmit="return checkSelection()">
            <input type="hidden" name="reservation_id" value="{{ session()->get('reservation_id') }}">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($menus as $menu)
                    <div class="max-w-xs mb-2 rounded-lg shadow-lg">
                        <img class="w-full h-48" src="{{ asset('menus/' . $menu->image) }}" alt="Image" />
                        <div class="px-6 py-4">
                            <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">
                                {{ $menu->name }}</h4>
                            <p class="leading-normal text-gray-700">{{ $menu->description }}.</p>
                        </div>
                        <div class="px-6 py-4">
                            <span class="text-xl text-green-600">${{ $menu->price }}</span>
                            <input type="checkbox" name="menus[]" value="{{ $menu->id }}">
                            <input type="number" name="quantities[{{ $menu->id }}]" min="1"
                                value="1">
                        </div>
                        <div class="px-6 py-4 flex justify-center space-x-4">
                            <a href="{{ route('admin.menus.edit', $menu->id) }}"
                                class="px-3 py-3 hover:bg-green-200 rounded-lg text-white">
                                <img src="{{ asset('others/edit.png') }}" class="w-8 h-8">
                            </a>
                            <button type="button"
                                class="px-2 py-3 hover:bg-red-400 rounded-lg text-white"
                                onclick="deleteItem({{ $menu->id }})"><img src="{{ asset('others/delete.png') }}" class="w-8 h-8"></button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-center">
                <button type="submit" onclick="checkSelection()" class="col-span-4">Add to Cart</button>
            </div>
        </form>
    </div>
</div>
