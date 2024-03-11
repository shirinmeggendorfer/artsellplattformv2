<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Admin-Dashboard
        </h2>
    </x-slot>

    <div class="py-4 bg-gray-200 min-h-screen">
        <div class="max-w-md mx-auto px-4">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Benutzerverwaltung
                    </h3>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        @foreach($users as $user)
                        <div class="bg-gray-200 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Name
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $user->name }}
                            </dd>
                        </div>
                        <div class="bg-gray-200 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Email
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $user->email }}
                            </dd>
                        </div>
                        <div class="bg-gray-200 px-4 py-5 sm:flex sm:flex-row-reverse sm:px-6">
                            <a href="{{ route('users.edit', $user) }}" class="w-full sm:w-auto inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-gray-800 text-base font-medium text-white hover:bg-gray-800 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                                Bearbeiten
                            </a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="mt-3 sm:mt-0 sm:ml-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full sm:w-auto inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none sm:w-auto sm:text-sm">
                                    Löschen
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
