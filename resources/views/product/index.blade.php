<x-app-layout>
  @auth
  <div class="mx-auto bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <form method="GET" action="{{ route('product.create') }}">
      @csrf
      <x-input-error :messages="$errors->get('message')" class="mt-2" />
      <x-primary-button class="mt-4">{{ __('Create Product') }}</x-primary-button>
    </form>
  </div>
  <div class="grid grid-cols-autoLayout my-8 gap-4 w-full bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    @foreach ($products as $product)
    <div class=" text-gray-200  max-w-[16rem] text-center mx-auto w-full rounded-md border-[1px] px-3 py-4 border-gray-300 bg-slate-800 flex flex-col justify-between">
      <div>
        <p>Name : {{ $product->Name }}</p>
        <p>Category : {{ $product->Category }}</p>
        <p>Price : {{ $product->Price }}</p>
      </div>
      <div>
        <div class="flex gap-3 ">

          <form method="GET" action="{{ route('product.show', $product) }}" class=" inline-block w-full">
            @csrf
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="justify-center w-full">{{ __('View') }}</x-primary-button>
          </form>
          @if(Auth::user()->role != "Customer")
          <form method="GET" action="{{ route('product.edit', $product) }}" class="inline-block w-full">
            @csrf
            <x-primary-button class="justify-center w-full">
              {{ __('Edit') }}
            </x-primary-button>
          </form>
          @endif
        </div>
        @if(Auth::user()->role != "Customer")
        <form method="POST" action="{{ route('product.destroy', $product) }}" class=" inline-block w-full mt-3">
          @csrf
          @method('DELETE')
          <x-input-error :messages="$errors->get('message')" class="mt-2" />
          <x-primary-button class="justify-center w-full dark:bg-red-600 dark:text-white dark:hover:bg-red-400 dark:focus-visible:bg-red-400 bg-red-600 text-white hover:bg-red-400 focus-visible:bg-red-400">{{ __('Delete') }}</x-primary-button>
        </form>
        @endif
      </div>
    </div>
    @endforeach
  </div>
  </div>
  @endauth
</x-app-layout>