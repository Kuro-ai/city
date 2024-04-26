<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            
            <form class="max-w-sm mx-auto bg-slate-300 p-6 rounded-md" action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
               @csrf
               @method('PUT')
                <div class="flex justify-end">
                    <x-create-button href="{{ route('admin.categories.index') }}">
                        Category List
                    </x-create-button>
                </div>
                <div class="mb-5">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New
                        category</label>
                    <input type="text" id="category"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Category" name="category" value="{{$category->name}}" required />
                </div>
                <div class="mb-5">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                    <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Description...">{{$category->description}}</textarea>
                </div>
                <div class="mb-5">
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Upload
                        file</label>
                        <img id="oldImage" class="my-2 rounded-sm" src="{{ asset('categories/'.$category->image) }}" alt="{{$category->name}}">
                        <div id="imagePreview" class="hidden my-2 rounded-sm"></div>  
                    <input name="image" id="image"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none"
                        type="file">
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
      image.innerHTML = '';  // Clear previous image content (if any)
    
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
