<x-layouts.app>
    <x-slot:heading>
        Password Reset Requests
    </x-slot>

    @foreach ($requests as $request)
        <div
            class="bg-white shadow-xl shadow-gray-100 w-full mx-auto flex flex-col sm:flex-row gap-3 sm:items-center justify-between px-5 py-4 rounded-md mb-2.5">
            <div class="flex items.center gap-4">
                <div>
                    <h3 class="font-bold mt-px text-gray-900">
                        {{ $request->user->employee->person->FirstName . ' ' . $request->user->employee->person->LastName }}</h3>
                    <div class="flex items-center gap-3 mt-2">
                        <span class="bg-purple-100 text-purple-700 rounded-full px-3 py-1 text-sm">
                            {{ $request->user->employee->emp_role->RoleName }}
                        </span>
                        <span class="text-slate-600 text-sm flex gap-1 items-center">
                            Requested at: {{ $request->created_at->format('M d, Y H:i') }}
                        </span>

                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <form action="/password-reset-requests/{{ $request->id }}/approve" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Approve
                    </button>
                </form>
                <form action="/password-reset-requests/{{ $request->id }}/reject" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Reject
                    </button>
                </form>
            </div>
        </div>
    @endforeach
    <div>
        {{-- {{ $Requests->links() }} --}}
</x-layouts.app>
