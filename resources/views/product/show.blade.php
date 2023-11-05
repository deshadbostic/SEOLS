<x-app-layout>
  @auth
  <div class="container mx-auto flex flex-col items-center text-white max-w-[22rem]">
    <div class="flex gap-4   w-full items-baseline">

      <a href="{{ route('product.index') }}" class="  text-blue-500 hover:text-blue-600 font-semibold text-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline align-text-top" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Back
      </a>
      <h1 class="text-2xl font-semibold mt-4">View Existing Product</h1>

    </div>
    <div class="my-8 w-full">
      <div class="flex flex-col gap-4 w-[280px]">
        <div class="text-lg text-white">Name: {{$product->Name}}</div>
        <div class="text-lg text-white">Category: {{$product->Category}}</div>
        <div class="text-lg text-white">Price: {{$product->Price}}</div>

        <!-- Initial input fields for attribute and value -->
        @foreach ($attributes as $attribute)
        <div class="text-lg text-white">{{ $attribute->Attribute_type}}: {{ $attribute->Attribute_value }}</div>
        @endforeach
      </div>
      @if(Auth::user()->role != "Customer")
      <div class="flex gap-2 items-baseline justify-evenly">
        <div class="mt-6">
          @csrf
          <form method="GET" action="{{ route('product.edit', $product) }}">
            @csrf
            <x-primary-button type="submit" class="dark:text-white dark:bg-blue-500 bg-blue-500 hover:bg-blue-400 focus-visible:bg-blue-400 active:bg-blue-400 focus:bg-blue-400 focus-within:bg-blue-400 dark:hover:bg-blue-400 dark:focus:bg-blue-400 dark:focus-within:bg-blue-400 dark:focus-visible:bg-blue-400 dark:active:bg-blue-400 focus-within:active:bg-blue-400">Edit Product</x-primary-button>
          </form>
        </div>
        <form method="POST" action="{{ route('product.destroy', $product) }}" class=" block">
          @csrf
          @method('DELETE')
          <x-primary-button type="submit" class="dark:text-white dark:bg-blue-500 bg-blue-500 hover:bg-blue-400 focus-visible:bg-blue-400 active:bg-blue-400 focus:bg-blue-400 focus-within:bg-blue-400 dark:hover:bg-blue-400 dark:focus:bg-blue-400 dark:focus-within:bg-blue-400 dark:focus-visible:bg-blue-400 dark:active:bg-blue-400">Delete Product</x-primary-button>
        </form>
      </div>
      @endif
    </div>
  </div>
  @endauth
</x-app-layout>