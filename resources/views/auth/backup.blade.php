@section('title', 'Dashboard')


<x-client>
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="w-64 bg-[#189AC5] text-[#FAFAFA] flex flex-col">
            <div class="flex items-center justify-center h-20 bg-[#189AC5]">
                <h1 class="text-2xl font-semibold">Dashboard</h1>
            </div>
            <div class="flex-grow">
                <nav class="flex flex-col mt-4 space-y-2">
                    <a href="/" class="px-4 py-2 hover:bg-[#2575fc]">Dashboard</a>
                    <a href="/" class="px-4 py-2 hover:bg-[#2575fc]">Admin</a>
                    <a href="/" class="px-4 py-2 hover:bg-[#2575fc]">Client</a>
                    <a href="/" class="px-4 py-2 hover:bg-[#2575fc]">Penristek</a>
                    <a href="/" class="px-4 py-2 hover:bg-[#2575fc]">Operasional</a>
                    <a href="/" class="px-4 py-2 hover:bg-[#2575fc]">Header</a>
                    <a href="/" class="px-4 py-2 hover:bg-[#2575fc]">Footer</a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow p-6">
            <div class="container mx-auto">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Welcome to the Dashboard</h2>

                <!-- Backup Button -->
                <a class="bg-[#EDBC48] text-[#414141] py-2 px-4 rounded shadow hover:bg-[#D4A93E] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#189AC5]"
                    href="">
                    Backup Data {{ date('Y-m-d H:i:s') }}
                </a>

                <!-- Cards Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                    <!-- Card 1 -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-700">Card 1</h3>
                        <p class="mt-2 text-gray-600">Some quick example text to build on the card title and make up the
                            bulk of the card's content.</p>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-700">Card 2</h3>
                        <p class="mt-2 text-gray-600">Some quick example text to build on the card title and make up the
                            bulk of the card's content.</p>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-700">Card 3</h3>
                        <p class="mt-2 text-gray-600">Some quick example text to build on the card title and make up the
                            bulk of the card's content.</p>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Data Table</h3>
                    <div class="overflow-x-auto bg-white rounded-lg shadow">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 bg-gray-100 border-b text-left text-gray-600">ID</th>
                                    <th class="py-2 px-4 bg-gray-100 border-b text-left text-gray-600">Name</th>
                                    <th class="py-2 px-4 bg-gray-100 border-b text-left text-gray-600">Email</th>
                                    <th class="py-2 px-4 bg-gray-100 border-b text-left text-gray-600">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-2 px-4 border-b">1</td>
                                    <td class="py-2 px-4 border-b">John Doe</td>
                                    <td class="py-2 px-4 border-b">john@example.com</td>
                                    <td class="py-2 px-4 border-b">
                                        <a href="/" class="text-blue-500 hover:underline">Edit</a> |
                                        <a href="/" class="text-red-500 hover:underline">Delete</a>
                                    </td>
                                </tr>
                                <!-- More rows... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-client>