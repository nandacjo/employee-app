<x-admin-layout>
  <h1 class="text-2xl font-semibold p-4 capitalize">Edit user</h1>
  <x-splade-form :action="route('admin.users.update', $user)" method="PUT" :default="$user"
    class="p-4 mt-4 shadow-md bg-white rounded-md space-y-2">
    <x-splade-input name="username" label="Username" />
    <x-splade-input name="first_name" label="First Name" />
    <x-splade-input name="last_name" label="Last Name" />
    <x-splade-input name="email" label="Email address" />
    <x-splade-submit />
  </x-splade-form>
</x-admin-layout>
