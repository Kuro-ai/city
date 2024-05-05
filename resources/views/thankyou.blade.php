<x-app-layout>
    <!-- Page Content -->
    <div class="flex items-center justify-center h-screen text-center ">
        <div class="block max-w p-10 bg-white border border-gray-200 rounded-lg shadow">
            <h1 class="mb-6 text-2xl font-bold tracking-tight text-gray-900 bg-gray-200 p-4 rounded-t-lg">Thank you</h1>
            <p class="font-normal text-gray-700 mb-3">Your reservation is ready.</p>
            <a href="{{ route('customer.index') }}" class="inline-block px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-blue-600 rounded shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none">
                Go back to Home
            </a>
        </div>
    </div>
</x-app-layout>
