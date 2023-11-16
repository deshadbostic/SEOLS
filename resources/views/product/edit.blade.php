<script defer>
  @section('custom-scripts')
  function addAttribute() {
    const attributesContainer = document.querySelector(".attributes");
    const attributeSets = attributesContainer.querySelectorAll(".attribute-set");
    let allInputsValid = true; // Assume all inputs are valid initially
    if (attributeSets.length > 0) {
      // Check all existing attribute sets for empty fields
      attributeSets.forEach(attributePair => {
        const attributeInput = attributePair.querySelector("#attribute");
        const valueInput = attributePair.querySelector("#value");
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
    }

    // If all existing inputs are valid, you can add a new attribute set
    if (allInputsValid) {
      const attributeSet = document.createElement('div')
      attributeSet.classList.add('attribute-set');
      attributeSet.innerHTML = `
          <div class="flex justify-between">
            <div>
              <x-input-label for="attribute" :value="__('Attribute Name')" />
              <x-text-input id="attribute" class="block mt-1 w-full" type="text" maxlength="26" name="attributes[Attribute_type][]" :value="old('attributes.Attribute_type.0')" required autofocus autocomplete="attribute" />
            </div>
            <div>
              <x-input-label for="value" :value="__('Attribute Value')" />
              <x-text-input id="value" class="block mt-1 w-full" type="text" maxlength="30" name="attributes[Attribute_value][]" :value="old('attributes.Attribute_value.0')" required autofocus autocomplete="value" />
            </div>
          </div>
          <div class="flex flex-row-reverse justify-between items-center mt-2 tags">

            <x-delete-button type="button" class=" px-4 py-1 rounded-md uppercase remove" onclick="this.parentNode.parentNode.remove();">Remove</x-delete-button>

            <span class="text-red-600 text-sm hidden error-message">Both attribute name and value are required.</span>
        </div>`;
      attributesContainer.appendChild(attributeSet);
      const newAttributeContainer = document.querySelector(".attributes");
      newAttributeSets = newAttributeContainer.querySelectorAll(".attribute-set");
      console.log(newAttributeSets);
      newAttributeSets.forEach((attributeSet, index) => {
        const attributeLabel = attributeSet.querySelector('label[for="attribute"]');
        const attributeValue = attributeSet.querySelector('label[for="value"]');
        attributeLabel.textContent = 'Attribute Name #' + (index + 1);
        attributeValue.textContent = 'Attribute Value #' + (index + 1);
      });
    }
  }
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
  .attributes .attribute-set:only-child .remove:hover,
  .attributes .attribute-set:only-child .remove:focus-visible {
    /* pointer-events: none; */
    background-color: rgb(239 146 146);
  }
</style>
<x-app-layout>
  @auth
  <div class="mx-auto max-w-xl bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    <div class=" flex justify-between my-3">
      <div class="">
        <a href="javascript:history.back()" class="text-blue-500 hover:text-blue-600 font-semibold text-lg">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline align-text-top" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          Back
        </a>
      </div>
      <h1 class=" text-2xl font-bold text-center leading-none">Edit Existing Product</h1>
      <form method="POST" class="m-0" action="{{ route('product.destroy', $product) }}">
        @csrf
        @method('delete')
        <x-delete-button class="justify-center inline-flex" type='button' data-type="delete-btn">
          {{ __('Delete') }}
        </x-delete-button>
        <dialog class="modal flow bg-slate-900 text-white backdrop:bg-black/70 rounded-md border text-center">
            <div class="" >
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
    </div>
    <form method="POST" action="{{ route('product.update', $product) }}">
      @csrf
      @method('patch')
      <!-- Name -->
      <div>
        <x-input-label for="Name" :value="__('Name')" />
        <x-text-input id="Name" class="block mt-1 w-full" type="text" maxlength="20" name="Name" value="{{ old('Name', $product->Name) }}" required autofocus autocomplete="Name" />
        <x-input-error :messages="$errors->get('Name')" class="mt-2" />
      </div>
      <!-- Category -->
      <div>
        <x-input-label for="Category" :value="__('Category')" />
        <select name="Category" id="Category" class="w-full bg-gray-900 rounded-md">
          <option value="Battery" {{$product->Category == "Battery" ? "selected" :""}}>Battery</option>
          <option value="Inverter" {{$product->Category == "Inverter" ? "selected" :""}}>Inverter</option>
          <option value="Solar Panel" {{$product->Category == "Solar Panel" ? "selected" :""}}>Solar Panel</option>
          <option value="Adapter" {{$product->Category == "Adapter" ? "selected" :""}}>Adapter</option>
          <option value="Cable" {{$product->Category == "Cable" ? "selected" :""}}>Cable</option>
          <option value="Wire" {{$product->Category == "Wire" ? "selected" :""}}>Wire</option>
        </select>
        <x-input-error :messages="$errors->get('Category')" class="mt-2" />
      </div>
      <!-- Description -->
      <div>
        <x-input-label for="Quantity" :value="__('Quantity')" />
        <x-text-input name="Quantity" class="block mt-1 w-full" type="text" maxlength="30" name="Quantity" value="{{ old('Quantity', $product->Quantity) }}" required autofocus autocomplete="Quantity" />
        <x-input-error :messages=" $errors->get('Quantity')" class="mt-2" />
      </div>
      <!-- Price -->
      <div>
        <x-input-label for="Price" :value="__('Price')" />
        <x-text-input id="Price" class="block mt-1 w-full" type="text" maxlength="30" name="Price" value="{{ old('Price', $product->Price) }}" required autofocus autocomplete="Price" />
        <x-input-error :messages="$errors->get('Price')" class="mt-2" />
      </div>
      <div class="attributes">
        <!-- Initial input fields for attribute and value -->
        @foreach ($attributes as $attribute)
        <div class="attribute-set">
          <div class="flex justify-between">
            <div>
              <x-input-label for="attribute" :value="__('Attribute Name')" />
              <x-text-input id="attribute-{{ $attribute->id }}" class="block mt-1 w-full attribute" type="text" maxlength="26" name="attributes[Attribute_type][{{ $attribute->id }}]" value="{{ $attribute->Attribute_type}}" required autofocus autocomplete="attribute" />
            </div>
            <div>
              <x-input-label for="value" :value="__('Attribute Value')" />
              <x-text-input id="value-{{ $attribute->id }}" class="block mt-1 w-full value" type="text" maxlength="30" name="attributes[Attribute_value][{{ $attribute->id }}]" value="{{ $attribute->Attribute_value }}" required autofocus autocomplete="value" />
            </div>
          </div>
          <div class="flex flex-row-reverse justify-between items-center mt-2 tags">
            <x-delete-button type="button" class="px-4 py-1 rounded-md uppercase remove" onclick="this.parentNode.parentNode.remove();">Remove</x-delete-button>
            <span class="text-red-500 text-sm hidden error-message">Both attribute name and value are required.</span>
          </div>
        </div>
        @endforeach
      </div>
      <x-primary-button class="my-3 dark:active:bg-white dark:focus-visible:bg-white dark:focus-within:bg-white" type="button" onclick="addAttribute()">
        {{ __('+ Add Attribute') }}
      </x-primary-button>
      <div>
        <x-edit-button class="">
          {{ __('Update') }}
        </x-edit-button>
      </div>
    </form>

  </div>
  @endauth
</x-app-layout>