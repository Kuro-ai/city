<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bbyellow leading-tight">
            {{ __('Contact') }}
        </h2>
    </x-slot>
    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <form class="max-w-sm mx-auto bg-bgcyan border-2 border-pale p-6 rounded-md" action="{{ route('customer.customercontact') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-pale ">
                        Name</label>
                    <input type="text" id="name"
                        class="shadow-sm bg-bgcyan text-pale border-2 border-pale bordertext-pale text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('name') border-red-500 @enderror"
                        placeholder="Your Name" name="name" required/>
                    @error('name')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-pale ">
                        Email</label>
                    <input type="email" id="email"
                        class="shadow-sm bg-bgcyan text-pale border-2 border-pale bordertext-pale text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('email') border-red-500 @enderror"
                        placeholder="Your email" name="email" required/>
                    @error('email')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label class="text-pale" for="message">Message</label>
                    <textarea class="bg-bgcyan text-pale w-full border-pale" id="message" name="message" rows="4" cols="50"></textarea>
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