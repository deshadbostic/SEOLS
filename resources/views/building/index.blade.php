<x-app-layout>
    @auth
        <div class="flex pt-5 justify-center min-h-screen bg-gray-900 grid-cols-14">
            <div class="col-span-12">
                <div class="overflow-auto lg:overflow-visible ">


                    <h2 class="text-2xl font-bold mb-2 text-white text-stone-300"> Building Select</h2>
                    <p> Select the building you wish to  model or add a new one</p>


                    <label> Select a pre-existing building to edit </label>
                    <form action="{{route('room.dedit') }}" method="GET">
                    <form action="{{route('room.delete') }}" method="POST">

                    <select id="buildingid" name="buildingid">
                    @foreach($buildings as $building)
                                <option value="{{$building->id}}">  {{$building->name}}</option>
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
                <form action="{{route('building.store')}}" method="POST">
                @csrf
                  <label>  Add a new building </label>
                  <h2>
                    Building name </h2>

                    <input name="name"> 
                    <x-primary-button>
                    {{__('Add Building')}}

                    </form>
                </x-primary-button>
                </div>
            </div>
        </div>
    @endauth
</x-app-layout>