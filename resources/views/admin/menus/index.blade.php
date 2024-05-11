<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-between">
            {{ __('Menu') }}
            <a href="{{ route('admin.order.shoppingcart', ['reservation_id' => request('reservation_id')]) }}">
                <span class="text-red-700 bg-red-300 rounded-full h-4 w-4 flex items-center justify-center text-sm">
                    {{ count(session()->get('cartItems', [])) }}
                </span>
                <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="30px" viewBox="0 0 902.86 902.86"
                    xml:space="preserve">
                    <g>
                        <g>                      
                            <path d="M671.504,577.829l110.485-432.609H902.86v-68H729.174L703.128,179.2L0,178.697l74.753,399.129h596.751V577.829z
    M685.766,247.188l-67.077,262.64H131.199L81.928,246.756L685.766,247.188z" />
                            <path d="M578.418,825.641c59.961,0,108.743-48.783,108.743-108.744s-48.782-108.742-108.743-108.742H168.717
    c-59.961,0-108.744,48.781-108.744,108.742s48.782,108.744,108.744,108.744c59.962,0,108.743-48.783,108.743-108.744
    c0-14.4-2.821-28.152-7.927-40.742h208.069c-5.107,12.59-7.928,26.342-7.928,40.742
    C469.675,776.858,518.457,825.641,578.418,825.641z M209.46,716.897c0,22.467-18.277,40.744-40.743,40.744
    c-22.466,0-40.744-18.277-40.744-40.744c0-22.465,18.277-40.742,40.744-40.742C191.183,676.155,209.46,694.432,209.46,716.897z
    M619.162,716.897c0,22.467-18.277,40.744-40.743,40.744s-40.743-18.277-40.743-40.744c0-22.465,18.277-40.742,40.743-40.742
    S619.162,694.432,619.162,716.897z" />
                        </g>
                    </g>
                </svg>
                
            </a>
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end">
                <x-create-button href="{{ route('admin.menus.create') }}">
                    New Menu
                </x-create-button>
            </div>
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-3 text-center"
                    role="alert">
                    {{ session('status') }}
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3 close-alert">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <title>Close</title>
                            <path
                                d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                        </svg>
                    </span>
                </div>
            @endif
            @if (session('deletestatus'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 text-center"
                    role="alert">
                    {{ session('deletestatus') }}
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3 close-alert">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <title>Close</title>
                            <path
                                d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                        </svg>
                    </span>
                </div>
            @endif
            <div>
                <form id="addToCartForm" action="{{ route('admin.order.addToCart') }}" method="post" onsubmit="return checkSelection()">
                    <input type="hidden" name="reservation_id" value="{{ session()->get('reservation_id') }}">
                    @csrf
                    <div class="grid grid-cols-4 gap-4">
                        @foreach ($menus as $menu)
                            <div class="max-w-xs mb-2 rounded-lg shadow-lg">
                                <img class="w-full h-48" src="{{ asset('menus/' . $menu->image) }}" alt="Image" />
                                <div class="px-6 py-4">
                                    <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">{{ $menu->name }}</h4>
                                    <p class="leading-normal text-gray-700">{{ $menu->description }}.</p>
                                </div>
                                <div class="px-6 py-4">
                                    <span class="text-xl text-green-600">${{ $menu->price }}</span>
                                    <input type="checkbox" name="menus[]" value="{{ $menu->id }}">
                                    <input type="number" name="quantities[{{ $menu->id }}]" min="1" value="1">
                                </div>
                                <div class="px-6 py-4 flex justify-center space-x-4">
                                    <a href="{{ route('admin.menus.edit', $menu->id) }}" class="px-3 py-3 bg-green-500 hover:bg-green-700 rounded-lg text-white">Edit</a>
                                    <button type="button" class="px-2 py-3 bg-red-500 hover:bg-red-700 rounded-lg text-white" onclick="deleteItem({{ $menu->id }})">Delete</button>
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
    </div>


</x-app-layout>
<script>
    function checkSelection(event) {
        // Get all checkboxes
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');

        // Check if at least one checkbox is checked
        var isAnyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);

        if (!isAnyChecked) {
            alert('Please select an item before adding to cart');
            return false;
        }
    }

    function deleteItem(menuId) {
        if (confirm('Are you sure you want to delete?')) {
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ url('admin/menus/destroy') }}/' + menuId;
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
