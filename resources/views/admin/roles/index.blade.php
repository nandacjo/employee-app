<x-admin-layout>
  <div class="flex justify-between">
    <h1 class="text-2xl font-semibold p-4 capitalize">Role index</h1>
    <div class="p-4">
      <Link href="{{ route('admin.roles.create') }}"
        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-md text-white">New
      Role</Link>
    </div>
  </div>

  {{-- Splade Table --}}
  <x-splade-table :for="$roles">
    @cell('action', $role)
      <div class="space-x-2">
        <Link href="{{ route('admin.roles.edit', $role) }}"
          class="px-3 py-1 rounded-md text-green-500 font-semibold hover:text-green-700">Edit </Link>
        <Link href="{{ route('admin.roles.destroy', $role) }}" method="DELETE" confirm="Deleted the role"
          confirm-text="Are you sure?" confirm-button="Yes" cancel-button="No"
          class="px-3 py-1 rounded-md text-red-500 font-semibold hover:text-red-700">
        Delete </Link>
      </div>
    @endcell
  </x-splade-table>
  {{-- Splade Table end --}}
</x-admin-layout>
