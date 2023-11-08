<script defer>
  @section('custom-scripts')

  function addAttribute() {
    const attributesContainer = document.querySelector(".attributes");
    const attributeSets = attributesContainer.querySelectorAll(".attribute-set");

    let allInputsValid = true; // Assume all inputs are valid initially

    // Check all existing attribute sets for empty fields
    attributeSets.forEach(attributePair => {
      const attributeInput = attributePair.querySelector(".attribute");
      const valueInput = attributePair.querySelector(".value");

      if (attributeInput.value.trim() === "" || valueInput.value.trim() === "") {
        allInputsValid = false; // At least one pair is invalid
        const errorMessage = attributePair.querySelector(".error-message");
        errorMessage.classList.remove("hidden");

        // Set a timer to hide the error message after 4000 milliseconds (4 seconds)
        setTimeout(function() {
          errorMessage.classList.add("hidden");
        }, 4000);
      }
    });

    // If all existing inputs are valid, you can add a new attribute set
    if (allInputsValid) {
      console.log(allInputsValid);
      const attributeSet = document.querySelector(".attribute-set").cloneNode(true);
      const attributeInput = attributeSet.querySelector(".attribute");
      const valueInput = attributeSet.querySelector(".value");
      attributeInput.value = "";
      valueInput.value = "";

      attributeInput.name = "attributes[Attribute_type][]";
      valueInput.name = "attributes[Attribute_value][]";
      if (attributeInput.hasAttribute("id")) {
        // Remove the "id" attribute
        attributeInput.removeAttribute("id");
      }
      if (valueInput.hasAttribute("id")) {
        // Remove the "id" attribute
        valueInput.removeAttribute("id");
      }
      attributesContainer.appendChild(attributeSet);
    }
  }

  @show
</script>

<style>
  .attributes .attribute-set:only-child .remove {
    /* pointer-events: none; */
    cursor: not-allowed;
  }

  .attributes .attribute-set:only-child .remove:hover,
  .attributes .attribute-set:only-child .remove:focus-visible {
    /* pointer-events: none; */
    background-color: rgb(239 146 146);
  }
</style>
<x-app-layout>
  @auth
  <div class="mx-auto max-w-xl bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <div class="relative">
      <a href="{{ route('product.index') }}" class="absolute left-100 top-100 text-blue-500 hover:text-blue-600 font-semibold text-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline align-text-top" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Back
      </a>
    </div>
    <h1 class=" text-2xl font-bold text-center my-3">Edit Existing Product</h1>
    <form method="POST" action="{{ route('product.update', $product) }}">
      @csrf
      @method('patch')
      <!-- Name -->
      <div>
        <x-input-label for="Name" :value="__('Name')" />
        <x-text-input id="Name" class="block mt-1 w-full" type="text" maxlength="20" name="Name" value="{{ old('Name', $product->Name) }}" required autofocus autocomplete="Name" />
        <x-input-error :messages="$errors->get('Name')" class="mt-2" />
      </div>
      <!-- Name -->
      <div>
        <x-input-label for="Category" :value="__('Category')" />
        <x-text-input id="Category" class="block mt-1 w-full" type="text" maxlength="20" name="Category" value="{{ old('Category', $product->Category) }}" required autofocus autocomplete="Category" />
        <x-input-error :messages="$errors->get('Category')" class="mt-2" />
      </div>
      <!-- Description -->
      <div>
        <x-input-label for="Quantity" :value="__('Quantity')" />
        <x-text-input name="Quantity" class="block mt-1 w-full" type="text" maxlength="5" name="Quantity" value="{{ old('Quantity', $product->Quantity) }}" required autofocus autocomplete="Quantity" />
        <x-input-error :messages=" $errors->get('Quantity')" class="mt-2" />
      </div>
      <!-- Price -->
      <div>
        <x-input-label for="Price" :value="__('Price')" />
        <x-text-input id="Price" class="block mt-1 w-full" type="text" maxlength="5" name="Price" value="{{ old('Price', $product->Price) }}" required autofocus autocomplete="Price" />
        <x-input-error :messages="$errors->get('Price')" class="mt-2" />
      </div>
      <div class="attributes">
        <!-- Initial input fields for attribute and value -->
        @foreach ($attributes as $attribute)
        <div class="attribute-set">
          <div class="flex justify-between">
            <div>
              <x-input-label for="attribute" :value="__('Attribute Name')" />
              <x-text-input id="attribute-{{ $attribute->id }}" class="block mt-1 w-full attribute" type="text" maxlength="10" name="attributes[Attribute_type][{{ $attribute->id }}]" value="{{ $attribute->Attribute_type}}" required autofocus autocomplete="attribute" />
            </div>
            <div>
              <x-input-label for="value" :value="__('Attribute Value')" />
              <x-text-input id="value-{{ $attribute->id }}" class="block mt-1 w-full value" type="text" maxlength="5" name="attributes[Attribute_value][{{ $attribute->id }}]" value="{{ $attribute->Attribute_value }}" required autofocus autocomplete="value" />
            </div>
          </div>
          <div class="flex flex-row-reverse justify-between items-center mt-2 tags">
            <button type="button" class="bg-red-500 px-4 py-1 rounded-md uppercase remove" onclick="if (this.parentNode.parentNode.parentNode && this.parentNode.parentNode.parentNode.childElementCount > 1) { this.parentNode.parentNode.remove(); }">Remove</button>
            <span class="text-red-500 text-sm hidden error-message">Both attribute name and value are required.</span>
          </div>
        </div>
        @endforeach
      </div>
      <button class="" type="button" onclick="addAttribute()">
        {{ __('+ Add Attribute') }}
      </button>
      <div>
        <x-primary-button class="ml-4">
          {{ __('Update') }}
        </x-primary-button>
        <form method="POST" action="{{ route('product.destroy', $product) }}">
          @csrf
          @method('delete')
          <x-primary-button class="ml-4">
            {{ __('Delete') }}
          </x-primary-button>
        </form>
      </div>
    </form>
  </div>
  @endauth
</x-app-layout>