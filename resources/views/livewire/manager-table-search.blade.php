<div>
    <div class="flex justify-between">
        <div id="search-bar">
            <form class="d-flex" role="search">
                <input wire:model.live="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            </form>
        </div>
        <x-create-button href="{{ route('manager.tables.create') }}">
            New Table
        </x-create-button>
    </div>
    
    <div class="h-[55rem] overflow-x-scroll relative shadow-md sm:rounded-lg">
        <table class="w-max text-sm rtl:text-right text-pale text-center m-auto">
            <thead class="text-xs text-bbyellow uppercase bg-bgcyan border-2 border-pale">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Capacity
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Location
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (empty($tables))
                    <tr>
                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center">No tables found
                        </td>
                    </tr>
                @else
                    @foreach ($tables as $table)
                        <tr class="bg-bgcyan text-pale border-2 border-pale">
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $table->name }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $table->capacity }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $table->status }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $table->location }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                <div class="flex space-x-2 justify-center items-center">
                                    <a href="{{ route('manager.tables.edit', $table->id) }}"
                                        class="px-3 py-3 hover:bg-green-200 rounded-lg text-white">
                                        <img src="{{ asset('others/edit.png') }}" class="w-8 h-8">
                                    </a>
                                    <form class="px-2 py-3 hover:bg-red-400 rounded-lg text-white"
                                        action="{{ route('manager.tables.destroy', $table->id) }}"
                                        method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"><img src="{{ asset('others/delete.png') }}" class="w-8 h-8"></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
        <div class="p-6">
            {{ $tables->links() }}
        </div>
    </div>
</div>
