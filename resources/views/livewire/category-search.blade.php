<div>
    <div class="flex justify-between">
        <div id="search-bar">
            <form class="d-flex" role="search">
                <input wire:model.live="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            </form>
        </div>
        <x-create-button href="{{ route('admin.categories.create') }}">
            New Category
        </x-create-button>
        
    </div>
    
    <div class="h-[55rem] overflow-x-scroll relative shadow-md sm:rounded-lg">
        <table class="w-max text-sm rtl:text-right text-pale text-center m-auto mt-6">
            <thead class="text-xs text-bbyellow uppercase bg-bgcyan border-2 border-pale">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Image
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (empty($categories))
                    <tr>
                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center">No categories found
                        </td>
                    </tr>
                @else
                    @foreach ($categories as $category)
                        <tr class="bg-bgcyan text-pale border-2 border-pales">
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $category->name }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $category->description }}
                            </td>
                            <td scope="row"
                                class="px-6 py-4 font-medium whitespace-nowrap flex justify-center items-center">
                                <img src="{{ asset('categories') }}/{{ $category->image }}" height="100" width="100"
                                    class="rounded" alt="{{ $category->name }}">
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                <div class="flex space-x-2 justify-center items-center">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                        class="px-3 py-3 hover:bg-green-200 rounded-lg text-white">
                                        <img src="{{ asset('others/edit.png') }}" class="w-8 h-8">
                                    </a>
                                    <form class="px-2 py-3  hover:bg-red-400 rounded-lg text-white"
                                        action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"><img src="{{ asset('others/delete.png') }}"
                                                class="w-8 h-8"></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
    
            </tbody>
        </table>
        <div class="p-6">{{ $categories->links() }}</div>
    </div>
    </div>
    
</div>