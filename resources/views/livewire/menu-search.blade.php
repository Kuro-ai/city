<div>
    <div id="search-bar">
        <form class="d-flex" role="search">
            <input wire:model.live="search" class="form-control me-2" type="search" placeholder="Search"
                aria-label="Search">
        </form>
    </div>
    <div class="container w-full px-5 py-6 mx-auto">
        <form action="{{ route('admin.order.addToCart') }}" method="post" onsubmit="return checkSelection()"
            class="grid grid-cols-4 gap-6">
            <input type="text" name="reservation_id" value="{{ session()->get('reservation_id') }}" class="hidden">
            @csrf
            <div class="col-span-4 mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Filter by Category:</label>
                <select id="category" name="category" onchange="filterMenus(this.value)"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
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
                        <div class="col-span-4 mb-4 category-header" data-category="{{ $category->id }}">
                            <h2 class="text-2xl font-bold">{{ $category->name }}</h2>
                        </div>
                        @foreach ($menus as $menu)
                            @if ($menu->category_id == $category->id)
                                <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg menu-item"
                                    data-category="{{ $menu->category_id }}">
                                    <img class="w-full h-48" src="{{ asset('menus/' . $menu->image) }}"
                                        alt="Image" />

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
                                    <div class="flex space-x-2 justify-center items-center">
                                        <a href="{{ route('admin.menus.edit', $menu->id) }}"
                                            class="px-3 py-3 hover:bg-green-200 rounded-lg text-white">
                                            <img src="{{ asset('others/edit.png') }}" class="w-8 h-8">
                                        </a>
                                        <div onclick="deleteItem({{ $menu->id }})"
                                            class="px-2 py-3 hover:bg-red-400 rounded-lg text-white">
                                            <img src="{{ asset('others/delete.png') }}" class="w-8 h-8">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endif
            <div id="no-menus" class="col-span-4 mb-4" style="display: none;">
                <h2 class="text-2xl text-center">No menu found for this category.</h2>
            </div>
            <button type="submit" onclick="checkSelection()" class="col-span-4">Add to Cart</button>
        </form>
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

    function checkSelection() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var isAnyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);

        if (!isAnyChecked) {
            alert('Please select an item before adding to cart');
            return false;
        }
        return true;
    }

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
