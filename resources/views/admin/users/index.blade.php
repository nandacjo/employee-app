<x-admin-layout>
  <h1 class="text-2xl font-semibold p-4 capitalize">User index</h1>
  <x-splade-table :for="$users">
    @cell('action', $user)
      <div class="space-x-2">
        <Link href="{{ route('admin.users.edit', $user) }}"
          class="px-3 py-1 rounded-md text-green-500 font-semibold hover:text-green-700">Edit </Link>
      </div>
    @endcell
  </x-splade-table>
</x-admin-layout>
