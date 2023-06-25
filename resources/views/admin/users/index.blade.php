<x-admin-layout>
  <h1 class="text-2xl mb-2 font-medium capitalize">User index</h1>
  <x-splade-table :for="$users">
    @cell('action', $user)
      <div class="space-x-2">
        <Link href="{{ route('admin.users.edit', $user) }}"
          class="px-3 py-1 text-white rounded-md bg-green-500 hover:bg-green-700">Edit </Link>
        <Link href="{{ route('admin.users.destroy', $user) }}"
          class="px-3 py-1 text-white rounded-md bg-red-500 hover:bg-red-700">Delete </Link>
      </div>
    @endcell
  </x-splade-table>
</x-admin-layout>
