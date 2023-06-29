<x-admin-layout>
  <h1 class="text-2xl font-semibold p-4 capitalize">New user</h1>
  <x-splade-form :action="route('admin.users.store')" method="POST" class="p-4 mt-4 shadow-md bg-white rounded-md space-y-2">
    <x-splade-input name="username" label="Username" />
    <x-splade-input name="first_name" label="First Name" />
    <x-splade-input name="last_name" label="Last Name" />
    <x-splade-input name="email" label="Email address" />
    <x-splade-input type="password" name="password" label="Password" />
    <x-splade-input type="password" name="password_confirmation" label="Password Confirmation" />
    <x-splade-submit />
  </x-splade-form>
</x-admin-layout>
