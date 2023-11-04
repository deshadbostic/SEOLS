<x-app-layout>
  @auth
  <div class="container mx-auto flex flex-col items-center text-white">
    <div class="flex gap-10">
      <h1 class="text-2xl font-semibold mt-4">View Existing Product</h1>
      <div class="relative">
        <a href="{{ route('product.index') }}" class="absolute left-100 top-100 text-blue-500 hover:text-blue-600 font-semibold text-lg">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline align-text-top" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          Back
        </a>
      </div>
    </div>
    <div class="my-8">
      <div class="flex flex-col gap-4 w-[280px]">
        <div class="text-lg text-white">Name: {{$product->Name}}</div>
        <div class="text-lg text-white">Category: {{$product->Category}}</div>
        <div class="text-lg text-white">Price: {{$product->Price}}</div>
        <div class="attributes">
          <!-- Initial input fields for attribute and value -->
          @foreach ($attributes as $attribute)
          <div class="text-lg text-white">{{ $attribute->Attribute_type}}: {{ $attribute->Attribute_value }}</div>
          @endforeach
        </div>
      </div>
      @if(Auth::user()->role != "Customer")
      <div class="flex gap-2 items-baseline">
        <div class="mt-6">
          @csrf
          <a href="{{ route('product.edit', $product) }}">
            <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded">Edit Product</button>
          </a>
        </div>
        <form method="POST" action="{{ route('product.destroy', $product) }}" class=" block">
          @csrf
          @method('DELETE')
          <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded">Delete Product</button>
        </form>
      </div>
      @endif
    </div>
  </div>
  @endauth
</x-app-layout>