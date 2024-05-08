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
                Adjust and make the images center for customers view. Change image in step one and two. Also change images and bg black to white in Home page.
                Seed category, menu and table. Chart in admin dashboard. Expense table for name, purchase date and price. If im in the mood i can calculate profit and income.
            </div>
        </div>
    </div>
</x-app-layout>