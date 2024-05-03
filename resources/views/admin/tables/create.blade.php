<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tables') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- @foreach ($errors->all() as $error)
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative my-3 text-center" role="alert">
                    {{$error}}
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3 close-alert">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
            @endforeach --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">

            <form class="max-w-sm mx-auto bg-slate-300 p-6 rounded-md" action="{{ route('admin.tables.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
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
                        placeholder="Table" name="table" />
                    @error('table')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="capacity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Capacity</label>
                    <input type="number" id="capacity"
                        class="shadow-sm bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('capacity') border-red-600 @enderror"
                        placeholder="Capacity" name="capacity" min="0" step="1" />
                    @error('capacity')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Status</label>
                    <select name="status" id="status" class=" w-full">
                        @foreach (App\Enums\TableStatus::cases() as $status)
                            <option value="{{ $status->value }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5">
                    <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Location</label>
                    <select name="location" id="location" class=" w-full">
                        @foreach (App\Enums\TableLocation::cases() as $location)
                            <option value="{{ $location->value }}">{{ $location->name }}</option>
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
