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
  @section('custom-scripts')
  document.addEventListener('DOMContentLoaded', () => {
    const delBtns = document.querySelectorAll('button[data-type="delete-btn"]');
    delBtns.forEach(delBtn => {
      delBtn.addEventListener('click', () => {
        const modal = delBtn.nextElementSibling;
        modal.showModal();
        const cancel = modal.querySelector('.button[data-type="cancel"');
        cancel.addEventListener("click", () => {
          modal.close();
          // console.log('cancel');
        });
      })
    });
  });
  @show
</script>
<style>
  .dismissing {
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
    <div class="flex justify-between">
      <h2 class="font-semibold text-xl text-white leading-tight">
        {{ __('Product Catalog') }}
      </h2>
      @if(Auth::user()->role != "Customer")
      <form method="GET" action="{{ route('product.create') }}" class="m-0 ">
        @csrf
        <x-input-error :messages="$errors->get('message')" class="mt-2" />
        <x-primary-button class=" dark:active:bg-white dark:focus-visible:bg-white dark:focus-within:bg-white">{{ __('Create Product') }}</x-primary-button>
      </form>
      @endif
    </div>
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
  <div class="mx-4 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 my-4 md:flex">
    <form method="get" action="/search" class="w-full" id="searchForm">
      @csrf
      <div class="relative w-96">
        <x-text-input id="search" class="block w-full" type="text" name="search" placeholder="Search.." maxlength="26" autofocus autocomplete="search" />
        <button class="m-0 px-2 inline-block absolute inset-y-0 right-0 bg-gray-800 dark:bg-gray-200 border border-indigo-600 rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-1 focus:ring-indigo-600 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path fill="currentColor" d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5q0-2.725 1.888-4.612T9.5 3q2.725 0 4.612 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3l-1.4 1.4ZM9.5 14q1.875 0 3.188-1.313T14 9.5q0-1.875-1.313-3.188T9.5 5Q7.625 5 6.312 6.313T5 9.5q0 1.875 1.313 3.188T9.5 14Z" />
          </svg></button>
      </div>
    </form>
    <form method="get" action="/search" class="flex flex-col gap-2 max-w-fit">
      <div class="flex w-max gap-3">
        <div class="flex gap-2 items-baseline flex-col ">
          <label for="items" class=" block w-max">Number of Items</label>
          <select id="items" name="items" class="w-[3.75rem] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
            <option value="5" {{ session('num_items') == "5" ? "selected" :""}}>5</option>
            <option value="10" {{ session('num_items') == "10" ? "selected" :""}}>10</option>
            <option value="25" {{ session('num_items') == "25" ? "selected" :""}}>25</option>
            <option value="50" {{ session('num_items') == "50" ? "selected" :""}}>50</option>
            <option value="100" {{ session('num_items') == "100" ? "selected" :""}}>100</option>
          </select>
        </div>
        <div class="w-full h-fit flex flex-col gap-2">
          <label for="category" class=" block w-max">Filter by Category</label>
          <select id="category" name="category[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" multiple>
            @foreach($categories as $category)
            <option value="{{$category}}" {{ (session('category') && in_array($category, session('category'))) ? 'selected' : '' }}>{{$category}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="self-end">
        <a href="/reset" class=" dark:focus-visible:bg-white dark:focus-within:bg-white w-fit bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 shadow-sm shadow-slate-950 px-3 py-2 mr-2">
          {{ __('Reset') }}
        </a>
        <x-primary-button class=" dark:active:bg-white dark:focus-visible:bg-white dark:focus-within:bg-white  w-fit">{{ __('Apply') }}</x-primary-button>
      </div>
    </form>
  </div>
  <div class=" grid grid-cols-autoLayout my-6 gap-4 w-full bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 px-4">
    @if($products->isNotEmpty())
    <div class=" col-span-full">
      {{ $products->links()}}
    </div>
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
          <x-delete-button class="justify-center w-full " type="button" data-type="delete-btn">{{ __('Delete') }}</x-delete-button>
          <dialog class="modal flow bg-slate-900 text-white backdrop:bg-black/70 rounded-md border">
            <div class="">
              <p class="bg-red-600 font-black text-xl">Danger Zone!!</p>
              <h2 class="text-4xl font-black py-3 ">Delete Item
              </h2>
              <p class="max-w-sm px-5 text-xl">Are you sure you want to delete this item? This will remove the item and can't be undone.</p>

              <div class="flex py-8 gap-3 justify-center">
                <x-primary-button class="button text-xl" data-type="cancel" type="button">
                  No, Cancel
                </x-primary-button>
                <x-delete-button class="button text-xl" data-type="delete-item" type="submit">
                  Yes, Delete
                </x-delete-button>
              </div>
            </div>
          </dialog>
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