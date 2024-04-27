<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Menu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @foreach($errors->all() as $error)
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative my-3 text-center" role="alert">
                    {{$error}}
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3 close-alert">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
            @endforeach
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">

            <form class="max-w-sm mx-auto bg-slate-300 p-6 rounded-md" action="{{ route('admin.menus.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex justify-end">
                    <x-create-button href="{{ route('admin.menus.index') }}">
                        Menu List
                    </x-create-button>
                </div>
                <div class="mb-5">
                    <label for="menu" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New
                        Menu</label>
                    <input type="text" id="menu"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Menu" name="menu" required />
                </div>
                <div class="mb-5">
                    <label for="description"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Description..."></textarea>
                </div>
                <div class="mb-5">
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Upload
                        file</label>
                    <div id="imagePreview" class="hidden my-2 rounded-sm"></div>
                    <input name="image" id="image"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none"
                        type="file">
                </div>
                <div class="mb-5">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New
                        Price</label>
                    <input type="number" id="price"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Price" name="price" min="0" step="0.01" required />
                </div>
                <div class="mb-5">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Category</label>
                        <select name="category_id" id="category" class=" w-full">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="mb-5 mx-auto">
                    <x-button>
                        Save
                    </x-button>
                </div>

            </form>
        </div>
    </div>


</x-app-layout>
<script>
    document.getElementById('image').addEventListener('change', function(e) {
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
