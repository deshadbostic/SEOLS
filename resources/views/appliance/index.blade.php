<x-app-layout>
    @auth
        <div class="flex pt-5 justify-center min-h-screen bg-gray-900 grid-cols-14">
            <div class="col-span-12">
                <div class="overflow-auto lg:overflow-visible ">


                    <h2 class="text-2xl font-bold mb-2 text-white text-stone-300"> Room Select</h2>
                    <p> Select the room you wish to  model or add a new one</p>

                   <p> Room: $roomname </p>

                    <label> Select an appliance to edit or remove </label>
                    <form action="{{route('room.dedit') }}" method="GET">
                    <form action="{{route('room.delete') }}" method="POST">

                    <select id="roomid" name="roomid">
                    @foreach($appliances as $appliance)
                                <option value="{{$appliance->id}}"> </option>
                            @endforeach
                    </select>

                    <x-primary-button>
                    {{__('Edit')}}
                </x-primary-button>
                    </form>
                <x-primary-button>
                    {{__('Remove')}}
                </x-primary-button>
                    </form>
                <form action="{{route('room.store')}}" method="POST">
                  <label>  Add a new appliance </label>
                  <h2>
                    Room name </h2>

                    <input name="name"> 
                    <h2>Room name </h2>
                    <input name="wattage"> 
                    <x-primary-button>
                    {{__('Add Appliance')}}

                    </form>
                </x-primary-button>
                    <p> return to the Room Select Screen </p>
                   <a href="/room"> Finish</a>
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