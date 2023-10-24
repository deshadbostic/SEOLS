<x-app-layout>
      @auth   
      <h3>piDSS Item</h3>   
      <div>
        {{ $item->name }}, {{ $item->description }},  {{ $item->price }}   
    </div>  
    @endauth 
</x-app-layout> 