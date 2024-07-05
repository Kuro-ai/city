<x-app-layout>
    <div class="flex items-center justify-center h-screen text-center ">
        <div class="block max-w p-10 bg-bgcyan border border-pale rounded-lg shadow">
            <h1 class="mb-6 text-2xl font-bold tracking-tight text-bgcyan bg-pale p-4 rounded-t-lg">Thank you</h1>
            <p class="font-normal text-pale mb-3">Your reservation is ready.</p>

            <form id="orderForm" method="POST" action="{{ route('staff.order.startOrder') }}">
                @csrf
                <div class="mb-5 sm:col-span-6">
                    <label class="block mb-2 text-sm font-medium text-pale ">
                        Do you want to order food with your reservation?
                    </label>
                    <div class="mt-2">
                        <div>
                            <input type="hidden" name="reservation_id" value="{{ optional(session('reservation'))->id }}">
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio" name="order_food" value="yes">
                                <span class="ml-2 text-pale">Yes</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio" name="order_food" value="no">
                                <span class="ml-2 text-pale">No</span>
                            </label>
                        </div>
                    </div>
                </div>
                <x-button class="ms-4" type="submit">
                    Submit
                </x-button>
            </form>
        </div>

    </div>
</x-app-layout>


