<div class="min-h-screen bg-gray-100">
  @include('layouts.admin-navigation')

  <div class="flex space-x-4">
    <!-- Sidebar vue -->
    <sidebar />

    <!-- Page Content -->
    <main class="flex-1 mt-3">
      <div class="max-w-6xl mx-auto">
        {{ $slot }}
      </div>
    </main>
  </div>
</div>
