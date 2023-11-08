<x-app-layout>
    @auth
        <div class="flex pt-5 justify-center min-h-screen bg-gray-900 grid-cols-14">
            <div class="col-span-12">
                <div class="overflow-auto lg:overflow-visible ">


                    <h2 class="text-2xl font-bold mb-2 text-white text-stone-300"> Room Select</h2>
                    <p> Select the room you wish to  model or add a new one</p>

                   <p> Building: {{$buildingname}} </p>

                    <label> Select a pre-existing room to edit </label>
                    <form action="{{route('room.dedit') }}" method="GET">
                    <form action="{{route('room.delete') }}" method="POST">

                    <select id="roomid" name="roomid">
                    @foreach($rooms as $room)
                                <option value="{{$room->id}}"> {{$room->name}}</option>
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
                  <label>  Add a new room </label>
                  <h2>
                    Room name </h2>

                    <input name="room_name"> 
                    <x-primary-button>
                    {{__('Add Room')}}

                    </form>
                </x-primary-button>
                    <p> return to the Building Select Screen </p>
                   <a href="/building"> Finish</a>
                </div>
            </div>
        </div>
    @endauth
</x-app-layout>