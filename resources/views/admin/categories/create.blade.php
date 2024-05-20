<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bbyellow leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">

            <form class="max-w-sm mx-auto bg-bgcyan border-2 border-pale p-6 rounded-md" action="{{ route('admin.categories.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex justify-end">
                    <x-create-button href="{{ route('admin.categories.index') }}">
                        Category List
                    </x-create-button>
                </div>
                <div class="mb-5">
                    <label for="category" class="block mb-2 text-sm font-medium text-pale ">New
                        category</label>
                    <input type="text" id="category"
                        class="shadow-sm bg-bgcyan text-pale border-2 border-pale bordertext-pale text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('category') border-red-500 @enderror"
                        placeholder="Category" name="category" />
                    @error('category')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="description" class="block mb-2 text-sm font-medium text-pale ">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="block p-2.5 w-full text-sm text-pale bg-bgcyan border-2 border-pale rounded-lg borderfocus:ring-blue-500 focus:border-blue-500 @error('description') border-red-600 @enderror"
                        placeholder="Description..."></textarea>
                    <div>
                        @error('description')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-5">
                    <label for="image" class="block mb-2 text-sm font-medium text-pale">Upload
                        file</label>
                    <div id="imagePreview" class="hidden my-2 rounded-sm"></div>
                    <input name="image" id="image"
                        class="block w-full text-sm text-pale border-2 border-pale borderrounded-lg cursor-pointer bg-bgcyan focus:outline-none @error('image') border-red-600 @enderror"
                        type="file">
                    <div>
                        @error('image')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
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
