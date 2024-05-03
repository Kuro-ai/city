<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tables') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">

            <form class="max-w-sm mx-auto bg-slate-300 p-6 rounded-md"
                action="{{ route('admin.tables.update', $table->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="flex justify-end">
                    <x-create-button href="{{ route('admin.tables.index') }}">
                        Table List
                    </x-create-button>
                </div>
                <div class="mb-5">
                    <label for="table" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New
                        Table</label>
                    <input type="text" id="table"
                        class="shadow-sm bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('table') border-red-600 @enderror"
                        placeholder="Table" name="table" value="{{ $table->name }}"  />
                        @error('table')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="capacity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Capacity</label>
                    <input type="text" id="capacity"
                        class="shadow-sm bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('capacity') border-red-600 @enderror"
                        placeholder="capacity" name="capacity" value="{{ $table->capacity }}"  />
                        @error('capacity') border-red-600 @enderror
                </div>
                <div class="mb-5">
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Status</label>
                    <select name="status" id="status" class=" w-full">
                        @foreach (App\Enums\TableStatus::cases() as $status)
                            <option value="{{ $status->value }}" @selected($table->status->value == $status->value)>
                                {{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5">
                    <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Location</label>
                    <select name="location" id="location" class=" w-full">
                        @foreach (App\Enums\TableLocation::cases() as $location)
                            <option value="{{ $location->value }}" @selected($table->location->value == $location->value)>
                                {{ $location->name }}</option>
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
