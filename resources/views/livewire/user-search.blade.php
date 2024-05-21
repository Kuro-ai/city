<div>
    <div class="ml-8 p-6">
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
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Account Creation
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (empty($users))
                    <tr>
                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center">No users found
                        </td>
                    </tr>
                @else
                    @foreach ($users as $user)
                        <tr class="bg-bgcyan text-pale border-2 border-pale">
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $user->name }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $user->email }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $user->created_at }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                <div class="flex space-x-2 justify-center items-center">
                                    <form class="px-2 py-3 hover:bg-red-400 rounded-lg text-white"
                                        action="{{ route('admin.user.destroy', $user->id) }}"
                                        method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"><img src="{{ asset('others/delete.png') }}" class="w-8 h-8"></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
        <div class="p-6">
            {{ $users->links() }}
        </div>
    </div>
</div>
