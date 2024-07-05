<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bbyellow leading-tight">
            {{ __('Tables') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">

            <form class="max-w-sm mx-auto bg-bgcyan border-2 border-pale p-6 rounded-md" action="{{ route('manager.tables.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex justify-end">
                    <x-create-button href="{{ route('manager.tables.index') }}">
                        Table List
                    </x-create-button>
                </div>
                <div class="mb-5">
                    <label for="table" class="block mb-2 text-sm font-medium text-pale">New
                        Table</label>
                    <input type="text" id="table"
                        class="shadow-sm bg-bgcyan border-2 border-pale text-pale text-sm rounded-lg block w-full p-2.5 @error('table') border-red-600 @enderror"
                        placeholder="Table" name="table" />
                    @error('table')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="capacity" class="block mb-2 text-sm font-medium text-pale">
                        Capacity</label>
                    <input type="number" id="capacity"
                        class="shadow-sm bg-bgcyan border-2 border-pale text-pale text-sm rounded-lg block w-full p-2.5 @error('capacity') border-red-600 @enderror"
                        placeholder="Capacity" name="capacity" min="0" step="1" />
                    @error('capacity')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="status" class="block mb-2 text-sm font-medium text-pale">
                        Status</label>
                    <select name="status" id="status" class="bg-bgcyan text-pale border-2 border-pale w-full">
                        @foreach (App\Enums\TableStatus::cases() as $status)
                            <option value="{{ $status->value }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5">
                    <label for="location" class="block mb-2 text-sm font-medium text-pale">
                        Location</label>
                    <select name="location" id="location" class="bg-bgcyan text-pale border-2 border-pale w-full">
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
