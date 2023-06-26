<x-admin-layout>
  <div class="flex justify-between">
    <h1 class="text-2xl font-semibold p-4 capitalize">Department index</h1>
    <div class="p-4">
      <Link href="{{ route('admin.departments.create') }}"
        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-md text-white">New
      Department</Link>
    </div>
  </div>

  {{-- Splade Table --}}
  <x-splade-table :for="$departments">
    @cell('action', $department)
      <div class="space-x-2">
        <Link href="{{ route('admin.departments.edit', $department) }}"
          class="px-3 py-1 rounded-md text-green-500 font-semibold hover:text-green-700">Edit </Link>
        <Link href="{{ route('admin.departments.destroy', $department) }}" method="DELETE" confirm="Deleted the department"
          confirm-text="Are you sure?" confirm-button="Yes" cancel-button="No"
          class="px-3 py-1 rounded-md text-red-500 font-semibold hover:text-red-700">
        Delete </Link>
      </div>
    @endcell
  </x-splade-table>
  {{-- Splade Table end --}}
</x-admin-layout>
