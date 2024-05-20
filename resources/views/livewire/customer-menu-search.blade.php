<div>
    <div class="flex justify-between mt-4 p-4">
        <div class="w-44 ml-6">            
            <select id="category" name="category" onchange="filterMenus(this.value)"
                class="mt-1 block w-full py-2 px-3 border border-pale bg-bgcyan text-pale rounded-md shadow-sm focus:outline-none focus:ring-pale focus:border-pale">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div id="search-bar" class="mr-6">
            <form class="d-flex" role="search">
                <input wire:model.live="search" class="form-control me-2" type="search" placeholder="Search"
                    aria-label="Search">
            </form>
        </div>
    </div>
    <div class="container w-full px-5 py-6 mx-auto">
        @if ($categories->isEmpty() && $menus->isEmpty())
            <div class="col-span-4 mb-4">
                <h2 class="text-2xl font-bold text-pale border-bbyellow text-center">No categories or menus found.</h2>
            </div>
        @else
            @foreach ($categories as $category)
                @php
                    $hasMenus = false;
                    foreach ($menus as $menu) {
                        if ($menu->category_id == $category->id) {
                            $hasMenus = true;
                            break;
                        }
                    }
                @endphp
                @if ($hasMenus)
                    <div class="col-span-4 mb-4 category-header" data-category="{{ $category->id }}">
                        <h2 class="text-2xl font-bold text-pale border-bbyellow text-center">{{ $category->name }}</h2>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        @foreach ($menus as $menu)
                            @if ($menu->category_id == $category->id)
                                <div class="w-[23rem] mx-4 mb-2 rounded-lg shadow-lg menu-item border-2 border-pale"
                                    data-category="{{ $menu->category_id }}">
                                    <img class="w-full h-48" src="{{ asset('menus/' . $menu->image) }}"
                                        alt="Image" />
    
                                    <div class="px-6 py-4">
                                        <h4 class="mb-3 text-xl font-semibold tracking-tight text-pale text-center uppercase">
                                            {{ $menu->name }}</h4>
                                        <p class="leading-normal text-pale text-center">{{ $menu->description }}.</p>
                                    </div>
                                    <div class="px-6 pt-2">
                                        <p class="text-xl text-pale text-center">${{ $menu->price }}</p>
                                    </div>
                                    <div class="px-6 py-4 flex flex-col items-center justify-center">  
                                        <form action="{{ route('customer.order.addToCart') }}" method="post" class="text-center">
                                            @csrf
                                            <input type="hidden" name="menus[]" value="{{ $menu->id }}">
                                            <input type="number" name="quantities[{{ $menu->id }}]" min="1"
                                                value="1" class="bg-bgcyan text-pale border-2 border-bbyellow mb-3">
                                            <button type="submit" class="bg-gradient-to-r from-bbyellow via-yellow-300 to-yellow-500 hover:bg-gradient-to-br  text-bgcyan px-4 py-2 rounded transition-colors duration-200">Add to Cart</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    
                @endif
            @endforeach
        @endif
        <div class="col-span-4 mb-4 category-header text-center text-pale mt-4">
            @if (empty($cartItems))
            <a href="{{ route('customer.order.shoppingcart', ['reservation_id' => session()->get('reservation_id')]) }}"
                class="bg-gradient-to-r from-bbyellow via-yellow-300 to-yellow-500 hover:bg-gradient-to-br text-bgcyan font-bold py-2 px-4 mt-4 rounded mx-2">Shopping Cart</a>
            @else
                <a href="{{ route('customer.order.shoppingcart', ['reservation_id' => $reservation_id]) }}"
                    class="bg-gradient-to-r from-bbyellow via-yellow-300 to-yellow-500 hover:bg-gradient-to-br text-bgcyan font-bold py-2 px-4 mt-4 rounded mx-2">Shopping Cart</a>
            @endif
        </div>
        <div id="no-menus" class="col-span-4 mb-4" style="display: none;">
            <h2 class="text-2xl text-center text-pale border-bbyellow">No menu found for this category.</h2>
        </div>
    </div>

</div>
<script>
    function filterMenus(categoryId) {
        const menuItems = document.querySelectorAll('.menu-item');
        const categoryHeaders = document.querySelectorAll('.category-header');
        let hasVisibleMenus = false;

        menuItems.forEach(item => {
            if (categoryId === '' || item.dataset.category === categoryId) {
                item.style.display = 'block';
                hasVisibleMenus = true;
            } else {
                item.style.display = 'none';
            }
        });

        categoryHeaders.forEach(header => {
            if (categoryId === '' || header.dataset.category === categoryId) {
                header.style.display = 'block';
            } else {
                header.style.display = 'none';
            }
        });

        if (!hasVisibleMenus) {
            const noMenusDiv = document.querySelector('#no-menus');
            noMenusDiv.style.display = 'block';
        } else {
            const noMenusDiv = document.querySelector('#no-menus');
            noMenusDiv.style.display = 'none';
        }
    }
</script>
