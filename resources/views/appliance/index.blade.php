<x-app-layout>
    @auth
        <div class="flex pt-5 justify-center min-h-screen bg-gray-900 grid-cols-14">
            <div class="col-span-12">
                <div class="overflow-auto lg:overflow-visible ">


                    <h2 class="text-2xl font-bold mb-2 text-white text-stone-300"> Room Select</h2>
                    <p> Select the room you wish to  model or add a new one</p>
                    @foreach($rooms as $room)
                   <p> Room: {{$room->name}} </p>
                   @endforeach
                    <label> Select an appliance to edit or remove </label>
                    <form action="{{route('room.dedit') }}" method="GET">
                    <form action="{{route('room.delete') }}" method="POST">

                    <select id="roomid" name="roomid">
                    @foreach($appliances as $appliance)
                                <option value="{{$appliance->id}}"> {{$appliance->name}}</option>
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
                <form action="{{route('appliance.store')}}" method="POST">
                    @csrf
                    <select id="room_id" name="room_id">
                    @foreach($rooms as $room)
                                <option value="{{$room->id}}"> {{$room->name}}</option>
                            @endforeach
                    </select>

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
                   
                </div>
            </div>
        </div>
    @endauth
</x-app-layout>