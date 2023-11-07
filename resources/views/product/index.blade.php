<script defer>
  @section('custom-scripts')
  document.addEventListener('DOMContentLoaded', () => {
    const alert = document.querySelector("div[role='alert']");
    if (alert) {

      alert.classList.add('dismissing');
      alert.addEventListener('animationend', () => {

        // alert.classList.add('hidden');
      })
    }
  })
  @show
</script>
<style>
  .dismissing {
    /* font-size: larger; */
    animation: 1s cubic-bezier(.70, -0.6, .20, .50) 4s forwards dismiss;
  }

  @keyframes dismiss {
    0% {
      translate: 0 0;
    }

    100% {
      translate: 200% 0;
    }
  }
</style>

<x-app-layout>
  @auth
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-white leading-tight">
      {{ __('Product Catalog') }}
    </h2>
    @if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded fixed right-14 top-[4.75rem]" role="alert">
      <strong class="font-bold">Holy smokes!</strong>
      <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif
    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded fixed right-14 top-[4.75rem]" role="alert">
      <strong class="font-bold">Hooray, you did it!</strong>
      <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif
  </x-slot>
  @if(Auth::user()->role != "Customer")
  <div class="mx-4 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <form method="GET" action="{{ route('product.create') }}">
      @csrf
      <x-input-error :messages="$errors->get('message')" class="mt-2" />
      <x-primary-button class="mt-4 dark:active:bg-white dark:focus-visible:bg-white dark:focus-within:bg-white">{{ __('Create Product') }}</x-primary-button>
    </form>
  </div>
  @endif
  <div class=" grid grid-cols-autoLayout my-6 gap-4 w-full bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 px-4">
    @if($products->isNotEmpty())
    @foreach ($products as $product)
    <div class=" text-gray-100  max-w-[16rem] text-center mx-auto w-full rounded-md border-[1px] px-3 py-4 border-gray-300 bg-slate-800 flex flex-col justify-between">
      <div>
        <p>Name : {{ $product->Name }}</p>
        <p>Category : {{ $product->Category }}</p>
        <p>Price : ${{ $product->Price }}</p>
      </div>
      <div>
        <div class="flex gap-3 mt-4">
          <form method="GET" action="{{ route('product.show', $product) }}" class=" inline-block w-full m-0">
            @csrf
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="justify-center w-full dark:active:bg-white dark:focus-visible:bg-white dark:focus-within:bg-white">{{ __('View') }}</x-primary-button>
          </form>
          @if(Auth::user()->role != "Customer")
          <form method="GET" action="{{ route('product.edit', $product) }}" class="inline-block w-full m-0">
            @csrf
            <x-primary-button class="justify-center w-full dark:active:bg-white dark:focus-visible:bg-white dark:focus-within:bg-white">
              {{ __('Edit') }}
            </x-primary-button>
          </form>
          @endif
        </div>
        @if(Auth::user()->role != "Customer")
        <form method="POST" action="{{ route('product.destroy', $product) }}" class=" inline-block w-full m-0 mt-3">
          @csrf
          @method('DELETE')
          <x-input-error :messages="$errors->get('message')" class="mt-2" />
          <x-delete-button class="justify-center w-full ">{{ __('Delete') }}</x-delete-button>
        </form>
        @endif
      </div>
    </div>
    @endforeach
    @else
    <div class="text-lg font-medium">
      @if(Auth::user()->role == "Customer")
      No products available. Please come back later!!
      @else
      No products available. Create some products for customers!!
      @endif
    </div>
    @endif
  </div>
  @endauth
</x-app-layout>
