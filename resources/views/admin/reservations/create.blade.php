<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">

            <form class="max-w-sm mx-auto bg-slate-300 p-6 rounded-md" action="{{ route('admin.reservations.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex justify-end">
                    <x-create-button href="{{ route('admin.reservations.index') }}">
                        Reservation List
                    </x-create-button>
                </div>
                <div class="mb-5">
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 ">First
                        Name</label>
                    <input type="text" id="first_name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('first_name') border-red-600 @enderror"
                        placeholder="First Name" name="first_name"/>
                    @error('first_name')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 ">Last
                        Name</label>
                    <input type="text" id="last_name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('last_name') border-red-600 @enderror"
                        placeholder="Last Name" name="last_name"/>
                    @error('last_name')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                    <input type="email" id="email"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('email') border-red-600 @enderror"
                        placeholder="example@gmail.com" name="email"/>
                    @error('email')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="tel_number" class="block mb-2 text-sm font-medium text-gray-900 ">Phone
                        Number</label>
                    <input type="text" id="tel_number"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('tel_number') border-red-600 @enderror"
                        placeholder="09-xxx xxxxxx" name="tel_number"onkeypress="return isNumberKey(event)" />
                    @error('tel_number')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="res_date" class="block mb-2 text-sm font-medium text-gray-900 ">
                        Reservation Date</label>
                    <input type="datetime-local" id="res_date"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('res_date') border-red-600 @enderror"
                        placeholder="" name="res_date"/>
                    @error('res_date')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="table" class="block mb-2 text-sm font-medium text-gray-900 ">
                        Table</label>
                    <select name="table_id" id="table" class=" w-full">
                        @foreach ($tables as $table)
                            <option value="{{ $table->id }}">{{ $table->name }} ( Capacity - {{ $table->capacity }}
                                )</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5">
                    <label for="guest_number" class="block mb-2 text-sm font-medium text-gray-900 ">
                        Guest Number</label>
                    <input type="number" id="guest_number"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('guest_number') border-red-600 @enderror"
                        placeholder="guest_number" name="guest_number" min="1" max="12" step="1"
                       />
                    @error('guest_number')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
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
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>
