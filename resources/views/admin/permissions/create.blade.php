<x-admin-layout>
  <div class="flex justify-between">
    <h1 class="text-2xl font-semibold p-4">New Permission</h1>
  </div>
  <x-splade-form :action="route('admin.permissions.store')" method="POST" class="p-4 mt-4 shadow-md bg-white rounded-md space-y-2">
    <x-splade-input name="name" label="Name" />
    <x-splade-select label="Roles" name="roles[]" :options="$roles" multiple relation choices />
    <x-splade-submit />
  </x-splade-form>
</x-admin-layout>
