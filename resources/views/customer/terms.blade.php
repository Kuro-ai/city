<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Terms and Service') }}
        </h2>
    </x-slot>
    <div class="bg-gray-100 p-6">
        <div class="max-w-lg mx-auto bg-white rounded shadow p-6">
            <h1 class="text-3xl mb-4 text-center">City Restaurant Terms of Service</h1>
            <ol class="list-decimal pl-6">
                <li class="mb-4">
                    <strong>Take-Away Orders:</strong>
                    <ul class="list-disc pl-4">
                        <li>All take-away orders are final and non-cancellable once confirmed.</li>
                        <li>Take-away orders are limited to South Okkalapa Township only.</li>
                    </ul>
                </li>
                <li class="mb-4">
                    <strong>Reservations:</strong>
                    <ul class="list-disc pl-4">
                        <li>Reservations are subject to availability and must be made in advance.</li>
                        <li>Your reservation will be automatically cancelled if you are more than 1 hour late.</li>
                        <li>If food is pre-ordered for the reservation and you arrive more than 1 hour late, the pre-order will be cancelled.</li>
                    </ul>
                </li>
                <li class="mb-4">
                    <strong>General Terms:</strong>
                    <ul class="list-disc pl-4">
                        <li>Prices are subject to change without prior notice.</li>
                        <li>We reserve the right to refuse service to anyone for any reason.</li>
                        <li>All guests must adhere to our restaurant policies and guidelines.</li>
                    </ul>
                </li>
                <li class="mb-4">
                    <strong>Contact Information:</strong>
                    <ul class="list-disc pl-4">
                        <li>For any inquiries, changes, or cancellations, please contact us at [insert contact information].</li>
                    </ul>
                </li>
            </ol>
            <p class="mt-6 block">By making a reservation or placing a take-away order with City Restaurant, you agree to abide by these terms of service.</p>
            <p class="mt-6 block">Thank you for choosing City Restaurant. We look forward to serving you!</p>
        </div>
    </div>
</x-app-layout>
