<x-app-layout>
    @auth
        <div class="flex pt-5 justify-center min-h-screen bg-gray-900 grid-cols-14">
            <div class="col-span-12">
                <div class="overflow-auto lg:overflow-visible ">
                    <nav>
                        <a href=""> Dashboard</a>
                        <a href=""> Appointments</a>
                        <a href=""> Catalog</a>

                        <a href=""> Customer</a>
                    </nav>


                    <h2 class="text-2xl font-bold mb-2 text-white text-stone-300"> Room Select</h2>
                    <p> Select the room you wish to  model or add a new one</p>

                   <p> Building: $buildingname </p>

                    <label> Select a pre-existing room to edit </label>

                    <select>
                        <option value="volvo">Volvo</option>
                        <option value="saab">Saab</option>
                    </select>

                  <label>  Add a new room </label>
                  <h2>
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
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endauth
</x-app-layout>