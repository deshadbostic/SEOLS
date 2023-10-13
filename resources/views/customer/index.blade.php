<x-app-layout>
    @auth
        <div class="flex pt-5 justify-center min-h-screen bg-gray-900 grid-cols-14">
            <div class="col-span-12">
                <div class="overflow-auto lg:overflow-visible ">
                    <!-- Table for Customers -->
                    <table class="table text-gray-400 border-separate space-y-6 text-sm">
                        <!-- Table Header -->
                        <h2 class="text-2xl font-bold mb-2 text-white text-stone-300">Customers</h2>
                        <thead class="bg-gray-800 text-gray-500">
                            <tr>
                                <!-- Column Headers -->
                                <th class="p-3 text-neutral-300">Name</th>
                                <th class="p-3 text-neutral-300">Telephone #</th>
                                <th class="p-3 text-neutral-300">Email</th>
                                <th class="p-3 text-neutral-300">Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop through Customers -->
                            @foreach($customers as $customer)
                                <tr class="bg-gray-800 hover:bg-opacity-60">
                                    <!-- Customer Details -->
                                    <td class="p-3">{{$customer->fname}} {{$customer->lname}}</td>
                                    <td class="p-3 text-center">{{$customer->phone}}</td>
                                    <td class="p-3 text-center">{{$customer->email}}</td>
                                    <td class="p-3 text-center">{{$customer->address}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endauth
</x-app-layout>