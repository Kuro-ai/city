<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                This is the admin page.
                $table->softDeletes(); Consider softDelete in migration file.
                Also search funciton for all tables. Mobile mav-links. Email notification for new reservation and order. Also limit the image upload to landscape.
                Adjust and make the images center for customers view
            </div>
        </div>
    </div>
</x-app-layout>