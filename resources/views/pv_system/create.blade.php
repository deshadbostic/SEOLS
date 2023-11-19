<x-app-layout>
    @auth    
    <div class="mx-auto max-w-xl bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
        <div class="relative">
        <a href="{{ route('pv_system.index') }}" class="absolute left-100 top-100 text-blue-600 hover:text-blue-400 focus-within:text-blue-400 active:text-blue-400 font-semibold text-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline align-text-top" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back
        </a>
        </div>
        <h1 class=" text-2xl font-bold text-center my-3">Create New PV System Model</h1>
        <!-- Form -->
    <form method="POST" action="{{ route('pv_system.store') }}">
        @csrf
            <x-primary-button class="dark:active:bg-white dark:focus-visible:bg-white dark:focus-within:bg-white" type="button" onclick="addAttribute()">
                {{ __('+ Add Attribute') }}
            </x-primary-button>
        <div class="attributes">
            <div class="attribute-set">
                <div class="flex justify-between">
                    <div>
                    <!--Try adding the attributes and attributes-set dive here -->
                    <x-input-label class="mt-3" for="category" :value="__('Category')" />
                        <select  class="w-full text-center py-2 form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm category_select" name="categories[]" id="category">
                                                
                            @foreach ($categories as $category)
                                <option value="{{$category->Category}}">{{$category->Category}}</option>
                            @endforeach
                        </select>
</div>
<div>
                    <x-input-label class="mt-3" for="product" :value="__('Product')" />
                        <select class="w-full text-center py-2 form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm products" name="products[]" id="product">
                        <option value="" selected disabled hidden>Choose Product</option>
                        </select>
</div>
<div>
                    <x-input-label class="mt-3" for="product_count" :value="__('Quantity')" />
                        <x-text-input id="product_count" class="block mt-1 w-full" type="text" maxlength="5" name="product_counts[]" value="1" required autofocus autocomplete="price" />
</div>
                    </div>
                        <div class="flex flex-row-reverse justify-between items-center mt-2 tags">
                            <x-delete-button type="button" class=" px-4 py-1 rounded-md uppercase remove" onclick="if (this.parentNode.parentNode.parentNode && this.parentNode.parentNode.parentNode.childElementCount > 1) { this.parentNode.parentNode.remove(); }">Remove</x-delete-button>

                            <span class="text-red-600 text-sm hidden error-message">Category and Product selection is required and quantity must be above 0.</span> 
                        </div>
            
            </div>
        </div>
        <!--Close the attributes and attributes-set dive here-->
        <div>
            <x-input-label class="mt-3" for="energy_generated" :value="__('Energy Generated:')" />
            <x-text-input readonly id="energy_generated"  name="energy_generated" :value="old('energy_generated')"/>
            <x-input-error :messages="$errors->get('energy_generated')" class="mt-2" />
        </div>
        <div>
            <x-input-label class="mt-3" for="price" :value="__('Estimated price:')" /> 
            <x-text-input id="price" class="block mt-1 w-full" type="text" maxlength="5" name="price" value="{{ old('template_price', $template_price) }}" required autofocus autocomplete="price" />
            <x-input-error :messages="$errors->get('template_price')" class="mt-2" />
        </div>
        <div>
            <x-input-label class="mt-3" for="energy_requirement" :value="__('Energy Requirement:')" />
            <x-text-input readonly id="energy_requirement"  name="energy_requirement" :value="2500"/>
            <x-input-error :messages="$errors->get('energy_requirement')" class="mt-2" />
        </div>
        <div>
            <x-input-label class="mt-3" for="budget" :value="__('My Budget:')" /> 
            <x-text-input id="budget" class="block mt-1 w-full" type="text" maxlength="5" name="budget" value="{{ old('user->budget', $user->budget) }}" required autofocus autocomplete="budget" />
            <x-input-error :messages="$errors->get('budget')" class="mt-2" />
        </div>
    </form>
   
    </div>
    @endauth
    <input class="hidden" id="hidden_products" value="{{json_encode($products)}}">
</x-app-layout>

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
<script>
    let amount=0
function addAttribute() {
    const attributesContainer = document.querySelector(".attributes");
    const attributeSets = attributesContainer.querySelectorAll(".attribute-set");

    let allInputsValid = true; // Assume all inputs are valid initially
    attributeSets.forEach(attributePair => {
      const categorySelect = attributePair.querySelector("#category");
      const productSelect = attributePair.querySelector("#product");
      const product_countInput = attributePair.querySelector("#product_count");
      console.log(categorySelect)
     if (categorySelect.value.trim() === "" || productSelect.value.trim() === "" || product_countInput.value.trim()==="") {
        allInputsValid = false; // At least one pair is invalid
        const errorMessage = attributePair.querySelector(".error-message");
        errorMessage.classList.remove("hidden");

        // Set a timer to hide the error message after 4000 milliseconds (4 seconds)
        setTimeout(function() {
          errorMessage.classList.add("hidden");
        }, 4000);
      }
    });
    if (allInputsValid) {
        const attributeSet = document.querySelector(".attribute-set").cloneNode(true);
        const categorySelect = attributeSet.querySelector("#category"); // Change to select
        const productSelect = attributeSet.querySelector("#product");
        const product_countInput=attributeSet.querySelector("#product_count")
        categorySelect.value = ""; // Reset value for select
        attributesContainer.appendChild(attributeSet);
    }
    addProductCategoryEvents()
    updateEnergyGenerated()
}
function updateEnergyGenerated(){

        const categorySelect = attributePair.querySelector("#category");
        const productSelect = attributePair.querySelector("#product");
      const product_countInput = attributePair.querySelector("#product_count");
      const energyGenerated = document.getElementById('energy_generated');

        if(categorySelect.value==="Solar Panel"){
            let productInfo = productSelect.value.split("---");
            let solarPanelCount = parseInt(productCountInput.value);
            //it should work, it just needs the name of the product information table and index number holding wattage 
            let solarPanelEnergy = parseInt(/*productinfo[cell_number that holds wattage]*/ )
            if (!isNaN(solarPanelEnergy) && !isNaN(solarPanelCount)) {
                 amount = solarPanelEnergy * solarPanelCount * 5;
                energyGenerated.value = amount + ' W';
            }
        }
    }
    //having amount increment as panels are added through add attribute  cause maybe more difficult to get all for all attributes at once cause of sharing id names
    //are try something like while in <div class="attributes">, while div class name attribute-set, start accumulating cause id names wouldn't be an issue
    //i'll try to be back before the meeting

    const hidden_products = document.getElementById('hidden_products')
    
    //Get all the selects with class category_select and then give them an event listener
    function addProductCategoryEvents() {
        let all_products = JSON.parse(hidden_products.value)
        const category_selects = document.querySelectorAll('.category_select')
        const products = document.querySelectorAll('.products')
        console.log(products)
        category_selects.forEach((select,index) => {
            select.addEventListener('change', function(e) {
                individual_products = all_products[this.value]
                removeAllChildNodes(products[index])
                for(i = 0; i < individual_products.length; i++) {
                    var opt = document.createElement('option')
                    opt.value = individual_products[i]['product_id']
                    opt.innerHTML = individual_products[i]['Name'];
                    products[index].appendChild(opt)
                }
            })
        })
    }

    function addProductEvents() {
        let all_products = JSON.parse(hidden_products.value)
        const category_selects = document.querySelectorAll('.category_select')
        const products = document.querySelectorAll('.products')
        const product_counts = document.querySelectorAll('.product_count')
        const price = document.getElementById('price')
        console.log(products[0])
        products.forEach((product,index) =>{
            product.addEventListener('change', function(e) {
                
                let category = category_selects[index].value
                console.log(all_products[category])
                //console.log(all_products[category_selects][index])
                //price = ['Price']
                //console.log(price)
            })
        })
    }
    
    function removeAllChildNodes(parent) {
        while (parent.firstChild) {
            parent.removeChild(parent.firstChild);
        }
    }
    addProductCategoryEvents()
    addProductEvents()
</script>

<!--need to readject energy and price 
function updateConfigPrice() {
        let amount = 0
        product_prices.forEach((price,i) => {
            if(price.value !== '' && product_counts[i].value !== '') {
                amount += (parseFloat(price.value.split('---')[1])*parseInt(product_counts[i].value))
            }
        })
        console.log(amount)
        cost_field.value = '$'+(parseInt(amount))
}

    function updateConfigEnergy() {
        let solar_panel_energy = document.getElementById('solar_panel_id').value.split("---")[2]
        let solar_panel_count = document.getElementById('solar_panel_count').value
        let amount = ((parseInt(solar_panel_energy) * solar_panel_count)*5)
        energy_generated.value = parseInt(amount) + ' W' 
    } 
*/
-->
 <!--
        <x-primary-button class="dark:active:bg-white dark:focus-visible:bg-white dark:focus-within:bg-white" type="button" onclick="addAttribute()">
        {{ __('+ Add Attribute') }}
      </x-primary-button>
        <div class="attributes">
            <div class="attribute-set">
                <div class="flex justify-between">
                    <div>
                        <x-input-label class="mt-3" for="category" :value="__('Category')" />
                        <select  class="w-full text-center py-2 form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm category_select" name="categories[]" id="category">
                            <option value="" selected disabled hidden>Choose Category</option>                           
                            @foreach ($categories as $category)
                                <option value="{{$category->Category}}">{{$category->Category}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <x-input-label class="mt-3" for="product" :value="__('Product')" />
                        <select class="w-full text-center py-2 form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm products" name="products[]" id="product">
                        <option value="" selected disabled hidden>Choose Product</option>
                        <option value="option 1" >option 1</option>
                        <option value="option 2" >option 2</option>
                        <option value="option 3" >option 3</option>
                        </select>
                    </div>
                    <div>
                    <x-input-label class="mt-3" for="product_count" :value="__('Quantity')" />
                        <x-text-input id="product_count" class="block mt-1 w-full" type="text" maxlength="5" name="product_counts[]" value="1" required autofocus autocomplete="price" />
                    </div>
                </div>
                <div class="flex flex-row-reverse justify-between items-center mt-2 tags">

                    <x-delete-button type="button" class=" px-4 py-1 rounded-md uppercase remove" onclick="if (this.parentNode.parentNode.parentNode && this.parentNode.parentNode.parentNode.childElementCount > 1) { this.parentNode.parentNode.remove(); }">Remove</x-delete-button>

                    <span class="text-red-600 text-sm hidden error-message">Category and Product selection is required and quantity must be above 0.</span>
                </div>
            </div>
        </div>-->