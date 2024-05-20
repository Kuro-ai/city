<div>
    <div class="flex justify-between">
        <div id="search-bar">
            <form class="d-flex" role="search">
                <input wire:model.live="search" class="form-control me-2" type="search" placeholder="Search"
                    aria-label="Search">
            </form>
        </div>
        <div class="col-span-4">
            <select id="category" name="category" onchange="filterMenus(this.value)"
                class="mt-1 block w-full border border-pale bg-bgcyan text-pale rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <x-create-button href="{{ route('admin.menus.create') }}">
            New Menu
        </x-create-button>
    </div>
   
    <div class="container w-full px-5 py-6 mx-auto">

        <input type="text" name="reservation_id" value="{{ session()->get('reservation_id') }}" class="hidden">

       
        @if ($categories->isEmpty() && $menus->isEmpty())
            <div class="col-span-4 mb-4">
                <h2 class="text-2xl font-bold">No categories or menus found.</h2>
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
                    <div class="col-span-4 mb-4 category-header text-center text-pale mt-4" data-category="{{ $category->id }}">
                        <h2 class="text-2xl font-bold">{{ $category->name }}</h2>
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
                                        <form action="{{ route('admin.order.addToCart') }}" method="post" class="text-center">
                                            @csrf
                                            <input type="hidden" name="menus[]" value="{{ $menu->id }}">
                                            <input type="number" name="quantities[{{ $menu->id }}]" min="1"
                                                value="1" class="bg-bgcyan text-pale border-2 border-bbyellow mb-3">
                                            <button type="submit" class="bg-gradient-to-r from-bbyellow via-yellow-300 to-yellow-500 hover:bg-gradient-to-br  text-bgcyan px-4 py-2 rounded transition-colors duration-200">Add to Cart</button>
                                        </form>
                                    </div>
                                <div class="flex space-x-2 justify-center items-center">
                                    <a href="{{ route('admin.menus.edit', $menu->id) }}"
                                        class="px-3 py-3 hover:bg-green-200 rounded-lg text-pale">
                                        <img src="{{ asset('others/edit.png') }}" class="w-8 h-8">
                                    </a>
                                    <div onclick="deleteItem({{ $menu->id }})"
                                        class="px-2 py-3 hover:bg-red-400 rounded-lg text-pale">
                                        <img src="{{ asset('others/delete.png') }}" class="w-8 h-8">
                                    </div>
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
            <a href="{{ route('admin.order.shoppingcart', ['reservation_id' => session()->get('reservation_id')]) }}"
                class="bg-gradient-to-r from-bbyellow via-yellow-300 to-yellow-500 hover:bg-gradient-to-br text-bgcyan font-bold py-2 px-4 mt-4 rounded mx-2">Shopping Cart</a>
            @else
                <a href="{{ route('admin.order.shoppingcart', ['reservation_id' => $reservation_id]) }}"
                    class="bg-gradient-to-r from-bbyellow via-yellow-300 to-yellow-500 hover:bg-gradient-to-br text-bgcyan font-bold py-2 px-4 mt-4 rounded mx-2">Shopping Cart</a>
            @endif
        </div>
        <div id="no-menus" class="col-span-4 mb-4" style="display: none;">
            <h2 class="text-2xl text-center">No menu found for this category.</h2>
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

    // function checkSelection() {
    //     var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    //     var isAnyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);

    //     if (!isAnyChecked) {
    //         alert('Please select an item before adding to cart');
    //         return false;
    //     }
    //     return true;
    // }

    function deleteItem(menuId) {
        if (confirm('Are you sure you want to delete?')) {
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('admin.menus.destroy', 'placeholder') }}'.replace('placeholder', menuId);
            form.style.display = 'none';

            let csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);

            let method = document.createElement('input');
            method.type = 'hidden';
            method.name = '_method';
            method.value = 'DELETE';
            form.appendChild(method);

            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
