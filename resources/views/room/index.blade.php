<x-app-layout>
    @auth
        <div class="flex pt-5 justify-center min-h-screen bg-gray-900 grid-cols-14">
            <div class="col-span-12">
                <div class="overflow-auto lg:overflow-visible ">


                    <h2 class="text-2xl font-bold mb-2 text-white text-stone-300"> Room Select</h2>
                    <p> Select the room you wish to  model or add a new one</p>
                    @foreach($buildings as $buildingname)
                   <p> Building: {{$buildingname->name}} </p>
                   @endforeach
                    <label> Select a pre-existing room to edit </label>
                    <form action="{{route('room.edit',$rooms[0])}}" method="GET">
                        @csrf
                    <form action="{{route('room.delete') }}" method="POST">
                    @csrf
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
                    @csrf
                  <label>  Add a new room </label>
                  <h2>
                    Room name </h2>

                    <input name="name"> 
                    <input type="hidden" name="building_id" value="{{$buildings[0]->id}}">
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