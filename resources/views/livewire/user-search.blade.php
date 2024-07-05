<div>
    <div class="mx-8 my-4 flex justify-between">
        <div id="search-bar">
            <form class="d-flex" role="search">
                <input wire:model.live="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <select wire:model.lazy="selectedRole" class="form-control me-2 mt-1 border border-pale bg-bgcyan text-pale rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                    <option value="">All Roles</option>
                    <option value="manager">Manager</option>
                    <option value="cashier">Cashier</option>
                    <option value="staff">Staff</option>
                    <option value="customer">Customer</option>
                </select>
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
                                <select class="bg-bgcyan text-pale border-2 border-pale w-full" wire:change="updateUserRole({{ $user->id }}, $event.target.value)" class="form-select">
                                    <option value="admin" {{ $user->userRole == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="manager" {{ $user->userRole == 'manager' ? 'selected' : '' }}>Manager</option>
                                    <option value="cashier" {{ $user->userRole == 'cashier' ? 'selected' : '' }}>Cashier</option>
                                    <option value="staff" {{ $user->userRole == 'staff' ? 'selected' : '' }}>Staff</option>
                                    <option value="customer" {{ $user->userRole == 'customer' ? 'selected' : '' }}>Customer</option>
                                </select>
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
