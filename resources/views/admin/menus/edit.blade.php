<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bbyellow leading-tight">
            {{ __('Menus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">

            <form class="max-w-sm mx-auto bg-bgcyan border-2 border-pale p-6 rounded-md"
                action="{{ route('admin.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="flex justify-end">
                    <x-create-button href="{{ route('admin.menus.index') }}">
                        Menu List
                    </x-create-button>
                </div>
                <div class="mb-5">
                    <label for="menu" class="block mb-2 text-sm font-medium text-pale">New
                        Menu</label>
                    <input type="text" id="menu"
                        class="shadow-sm bg-bgcyan border-2 border-pale text-pale text-sm rounded-lg block w-full p-2.5 @error('menu') border-red-600 @enderror"
                        placeholder="Menu" name="menu" value="{{ $menu->name }}" />
                    @error('menu')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="description"
                        class="block mb-2 text-sm font-medium text-pale">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="block p-2.5 w-full text-sm text-pale bg-bgcyan border-2 border-pale rounded-lg  @error('description') border-red-600 @enderror"
                        placeholder="Description...">{{ $menu->description }}</textarea>
                    @error('description')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="image" class="block mb-2 text-sm font-medium text-pale">Upload
                        file</label>
                    <img id="oldImage" class="my-2 rounded-sm" src="{{ asset('menus/' . $menu->image) }}"
                        alt="{{ $menu->name }}">
                    <div id="imagePreview" class="hidden my-2 rounded-sm"></div>
                    <input name="image" id="image"
                        class="block w-full text-sm text-pale  rounded-lg cursor-pointer bg-bgcyan border-2 border-pale dark:text-gray-400 focus:outline-none @error('image') border-red-600 @enderror"
                        type="file">
                    @error('image')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="price" class="block mb-2 text-sm font-medium text-pale">
                        Price</label>
                    <input type="number" id="price"
                        class="shadow-sm bg-bgcyan border-2 border-pale border text-pale text-sm rounded-lg block w-full p-2.5 @error('price') border-red-600 @enderror"
                        placeholder="Price" name="price" min="0" step="0.01" value="{{ $menu->price }}" />
                    @error('price')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="category" class="block mb-2 text-sm font-medium text-pale">
                        Category</label>
                    <select class="bg-bgcyan text-pale border-2 border-pale  w-full" name="category_id" id="category">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == $menu->category_id ? 'selected' : '' }}>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5 mx-auto">
                    <x-button>
                        Update
                    </x-button>
                </div>

            </form>
        </div>
    </div>


</x-app-layout>
<script>
    document.getElementById('image').addEventListener('change', function(e) {
        var oldImage = document.getElementById('oldImage');
        var image = document.getElementById('imagePreview');
        image.classList.remove('hidden'); // Show the preview element
        image.innerHTML = ''; // Clear previous image content (if any)

        // Check if a file is selected
        if (e.target.files && e.target.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var img = document.createElement('img');
                img.setAttribute('src', e.target.result);
                image.appendChild(img);
            };

            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
