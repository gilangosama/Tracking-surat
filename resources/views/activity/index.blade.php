<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-4">Log Aktivitas User</h2>

                    <!-- Form Filter -->
                    <form action="{{ route('activity.download') }}" method="GET" class="mb-4 flex gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Akhir</label>
                            <input type="date" name="tanggal_akhir" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="self-end">
                            <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded-md hover:bg-pink-600">
                                Download PDF
                            </button>
                        </div>
                    </form>

                    <!-- Tabel Aktivitas -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        User
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Deskripsi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($activities as $activity)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $activity->created_at->format('d M Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $activity->user->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $activity->aksi }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $activity->deskripsi }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 