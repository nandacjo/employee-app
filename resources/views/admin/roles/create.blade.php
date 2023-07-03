<x-admin-layout>
  <div class="flex justify-between">
    <h1 class="text-2xl font-semibold p-4">New Role</h1>
  </div>
  <x-splade-form :action="route('admin.roles.store')" method="POST" class="p-4 mt-4 shadow-md bg-white rounded-md space-y-2">
    <x-splade-input name="name" label="Role" />
    <x-splade-select label="Permission" name="permissions[]" :options="$permissions" multiple relation choices />
    <x-splade-submit />
  </x-splade-form>
</x-admin-layout>
