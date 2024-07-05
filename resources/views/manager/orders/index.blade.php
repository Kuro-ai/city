<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bbyellow leading-tight">
            {{ __('Order List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-3 text-center"
                    role="alert">
                    {{ session('status') }}
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3 close-alert">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <title>Close</title>
                            <path
                                d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                        </svg>
                    </span>
                </div>
            @endif
            @if (session('deletestatus'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 text-center"
                    role="alert">
                    {{ session('deletestatus') }}
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3 close-alert">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <title>Close</title>
                            <path
                                d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                        </svg>
                    </span>
                </div>
            @endif

            @livewire('manager-order-search')
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var seenIds = {};
        var forms = document.querySelectorAll('.email-form');
        forms.forEach(function(form) {
            var id = form.closest('td').dataset.id;
            if (seenIds[id]) {
                form.style.display = 'none';
            } else {
                seenIds[id] = true;
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var seenIds = {};
        var forms = document.querySelectorAll('.email-form-delete');
        forms.forEach(function(form) {
            var id = form.closest('td').dataset.id;
            if (seenIds[id]) {
                form.style.display = 'none';
            } else {
                seenIds[id] = true;
            }
        });
    });
</script>
