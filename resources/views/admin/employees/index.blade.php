<x-admin-layout>
  <div class="flex justify-between">
    <h1 class="text-2xl font-semibold p-4 capitalize">Employee index</h1>
    <div class="p-4">
      <Link href="{{ route('admin.employees.create') }}"
        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-md text-white">New
      Employee</Link>
    </div>
  </div>

  {{-- Splade Table --}}
  <x-splade-table :for="$employees">
    @cell('action', $state)
      <div class="space-x-2">
        <Link href="{{ route('admin.employees.edit', $state) }}"
          class="px-3 py-1 rounded-md text-green-500 font-semibold hover:text-green-700">Edit </Link>
        <Link href="{{ route('admin.employees.destroy', $state) }}" method="DELETE" confirm="Deleted the state"
          confirm-text="Are you sure?" confirm-button="Yes" cancel-button="No"
          class="px-3 py-1 rounded-md text-red-500 font-semibold hover:text-red-700">
        Delete </Link>
      </div>
    @endcell
  </x-splade-table>
  {{-- Splade Table end --}}
</x-admin-layout>
