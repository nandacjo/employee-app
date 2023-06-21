<div class="min-h-screen bg-gray-100">
    @include('layouts.navigation')

    <div class="flex space-x-4">
        <!-- Sidebar vue -->
        <sidebar />

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</div>
