<div>
    <div class="flex justify-between mb-6">
        <div id="search-bar">
            <form class="d-flex" role="search">
                <input wire:model.live="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            </form>
        </div>
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

                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
        <div class="p-6">{{ $reservations->links() }}</div>
    </div>
</div>
