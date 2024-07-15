<div>
    <div class="flex justify-between mb-8">
        <div id="search-bar">
            <form class="d-flex" role="search">
                <input wire:model.live="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            </form>
        </div>
        <x-create-button href="{{ route('staff.reservations.create') }}">
            New Reservation
        </x-create-button>
    </div>
    
    <div class="h-[55rem] overflow-x-scroll relative shadow-md sm:rounded-lg">
        <table class="w-max text-sm rtl:text-right text-pale text-center m-auto">
            <thead class="text-xs text-bbyellow uppercase bg-bgcyan border-2 border-pale">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Phone Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Reservation Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Guest Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Table Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (empty($reservations))
                    <tr>
                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center">No reservations found
                        </td>
                    </tr>
                @else
                    @foreach ($reservations as $reservation)
                        <tr class="bg-bgcyan text-pale border-2 border-pale">
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $reservation->id }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $reservation->first_name }} {{ $reservation->last_name }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $reservation->email }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $reservation->tel_number }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $reservation->res_date }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $reservation->guest_number }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                @if ($reservation->table)
                                    {{ $reservation->table->name }}
                                @else
                                    No table assigned
                                @endif
                            </td>

                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                <div class="flex space-x-2 justify-center items-center">
                                    <a href="{{ route('staff.reservations.edit', $reservation->id) }}"
                                        class="px-3 py-3 hover:bg-green-200 rounded-lg text-white">
                                        <img src="{{ asset('others/edit.png') }}" class="w-8 h-8">
                                    </a>
                                    <form class="px-2 py-3 hover:bg-red-400 rounded-lg text-white"
                                        action="{{ route('staff.reservations.destroy', $reservation->id) }}"
                                        method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"><img src="{{ asset('others/delete.png') }}"
                                                class="w-8 h-8"></button>
                                    </form>
                                    @if (!$reservation->email_sent && !$reservation->user->hasRole(['admin', 'manager', 'staff']))
                                        <form class="px-2 py-3 hover:bg-blue-400 rounded-lg text-white"
                                            action="{{ route('staff.reservations.reservationemail', $reservation->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to send an email to this customer?')">
                                            @csrf
                                            <button type="submit"><img src="{{ asset('others/gmail.png') }}"
                                                    class="w-8 h-8"></button>
                                        </form>
                                    @endif
                                    
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
        <div class="p-6">{{ $reservations->links() }}</div>
    </div>
</div>
