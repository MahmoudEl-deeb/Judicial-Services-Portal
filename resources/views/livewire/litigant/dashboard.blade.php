<div class="p-6 bg-gray-100 min-h-screen" x-data="{ sidebarOpen: false }">
    <!-- Sidebar -->
    <div 
        class="fixed inset-y-0 left-0 w-64 bg-white shadow-md transform transition-transform duration-200"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    >
        <div class="flex items-center justify-between p-4 border-b">
            <h2 class="text-xl font-bold text-gray-700">Litigant</h2>
            <button @click="sidebarOpen = false" class="text-gray-600 hover:text-black">
                ✖
            </button>
        </div>
        <nav class="p-4 space-y-2">
            <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200">📂 My Cases</a>
            <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200">📄 Documents</a>
            <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200">💬 Messages</a>
            <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200">⚖ Court Dates</a>
            <a href="#" class="block px-3 py-2 rounded hover:bg-gray-200">⚙ Settings</a>
        </nav>
    </div>

    <!-- Top Bar -->
    <div class="flex items-center justify-between bg-white shadow px-6 py-4">
        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-700 hover:text-black">
            ☰
        </button>
        <h1 class="text-lg font-semibold">Litigant Dashboard</h1>
        <div class="flex items-center space-x-3">
            <span class="text-gray-600">Welcome, {{ auth()->user()->name }}</span>
            <button class="bg-red-500 text-white px-3 py-1 rounded">Logout</button>
        </div>
    </div>

    <!-- Content -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Cases Card -->
        <div class="bg-white p-4 shadow rounded">
            <h2 class="text-lg font-bold mb-2">📂 My Cases</h2>
            <p class="text-gray-600">Track all your ongoing and past cases.</p>
            <button class="mt-3 bg-blue-500 text-white px-3 py-1 rounded">View</button>
        </div>

        <!-- Messages Card -->
        <div class="bg-white p-4 shadow rounded">
            <h2 class="text-lg font-bold mb-2">💬 Messages</h2>
            <p class="text-gray-600">Communicate with your lawyer or court officials.</p>
            <button class="mt-3 bg-green-500 text-white px-3 py-1 rounded">Open</button>
        </div>

        <!-- Hearings Card -->
        <div class="bg-white p-4 shadow rounded">
            <h2 class="text-lg font-bold mb-2">⚖ Court Dates</h2>
            <p class="text-gray-600">Stay updated on your upcoming hearings.</p>
            <button class="mt-3 bg-yellow-500 text-white px-3 py-1 rounded">Check</button>
        </div>
    </div>
</div>
