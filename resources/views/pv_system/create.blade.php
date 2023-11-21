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
        <form id="form" method="POST" action="{{ route('pv_system.store') }}">
        <span id="form_error" class="mb-4 float-right text-red-600 text-sm hidden">At least one Solar Panel, one Inverter and one Wire is needed to save your PV System Model.</span>
            @csrf
            <x-primary-button class="dark:active:bg-white dark:focus-visible:bg-white dark:focus-within:bg-white" type="button" onclick="addAttribute()">
                {{ __('+ Add Product') }}
            </x-primary-button>
            <div class="attributes">
                <div class="attribute-set" >
                    <div class="grid grid-cols-10 gap-5">
                        <div class="col-span-3">
                            <!--Try adding the attributes and attributes-set dive here -->
                            <x-input-label class="mt-3" for="category" :value="__('Category')" />
                            <select class="w-full text-center py-2 form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm category_select" name="categories[]" id="category">
                                @foreach ($categories as $category)
                                    <option value="{{$category->Category}}">{{$category->Category}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-5">
                            <x-input-label class="mt-3" for="product" :value="__('Product')" />
                            <select class="w-full text-center py-2 form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm products" name="products[]" id="product">
                                <option value="" selected disabled hidden>Choose Product</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <x-input-label class="mt-3" for="product_count" :value="__('Quantity')" />
                            <x-text-input id="product_count"  oninput="this.value = this.value.replace(/[^1-9]/g, '');" class="w-full text-center py-2 form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm product_counts"  maxlength="5" name="product_counts[]" value="1" required autofocus autocomplete="price" />
                        </div>
                    </div>
                    <div class="flex flex-row-reverse justify-between items-center mt-2 tags">
                        <x-delete-button type="button" class=" px-4 py-1 rounded-md uppercase remove" onclick="if (this.parentNode.parentNode.parentNode && this.parentNode.parentNode.parentNode.childElementCount > 1) { this.parentNode.parentNode.remove(); }updatePrices();updateEnergy();">Remove</x-delete-button>

                        <span class="text-red-600 text-sm hidden error-message">Category and Product selection is required and quantity must be above 0.</span>
                    </div>

                </div>
            </div>
            <!--Close the attributes and attributes-set dive here-->
            <div class="flex justify-between">
                <div>
                    <x-input-label class="mt-3" for="energy_generated" :value="__('Energy Generated:')" />
                    <x-text-input readonly id="energy_generated" name="energy_generated" :value="old('energy_generated')" />
                    <x-input-error :messages="$errors->get('energy_generated')" class="mt-2" />
                </div>
                <div>
                    <x-input-label class="mt-3" for="energy_requirement" :value="__('Energy Requirement:')" />
                    <x-text-input readonly id="energy_requirement" name="energy_requirement" :value="2100" />
                    <x-input-error :messages="$errors->get('energy_requirement')" class="mt-2" />
                </div>
            </div>
            <div class="flex justify-between">
                <div>
                    <x-input-label class="mt-3" for="price" :value="__('Estimated price:')" />
                    <x-text-input id="price" class="block mt-1 w-full" type="text" maxlength="5" name="price" value="{{ old('price') }}" readonly autofocus autocomplete="price" />
                    <x-input-error :messages="$errors->get('template_price')" class="mt-2" />
                </div>
                <div>
                    <x-input-label class="mt-3" for="budget" :value="__('My Budget:')" />
                    <x-text-input id="budget" class="block mt-1 w-full" maxlength="5" name="budget"  value="{{ old('user->budget', $user->budget) }}" autofocus autocomplete="budget" />
                    <x-input-error :messages="$errors->get('budget')" class="mt-2" />
                </div>
            </div>
            <div class="flex justify-between">
                <x-primary-button class="mt-4" ><!--onclick="return validateAttributeSets()"-->
                    {{__('Save')}}
                </x-primary-button>
                <x-primary-button type=" button" class="button mt-4" id="get_recommendation">
                    {{__('Get Recommendation')}}
                </x-primary-button>
            </div>
            <div>
            <span id="template_error" class="mt-4 float-right text-red-600 text-sm hidden">No valid recommendations could be found.</span>
            </div>
            <input class="hidden" id="hidden_products" value="{{json_encode($products)}}">
            <input class="hidden" id="hidden_template" value="{{json_encode($template_products)}}">
        </form>
        @endauth       
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
    function addFormEvent() {
        const form = document.getElementById('form')
        form.addEventListener('submit', function(e) {
            if(!checkForm()) {
                e.preventDefault()
                const form_error = document.getElementById('form_error')
                form_error.classList.remove("hidden");
                // Set a timer to hide the error message after 4000 milliseconds (4 seconds)
                setTimeout(function() {
                    form_error.classList.add("hidden");
                }, 4500);
            } 
        })
    }

    function checkForm() {
        const category_selects = document.querySelectorAll('.category_select')
        const products = document.querySelectorAll('.products')
        const product_counts = document.querySelectorAll('.product_counts')
        let validForm = false
        if((hasWire(category_selects)) && (hasInverter(category_selects)) && (hasSolarPanel(category_selects))) {
            validForm = true;
        }
        return validForm;
    }

    function hasWire(selects) {
        let hasWire = false
        selects.forEach((select) => {
            if(select.value === 'Wire') {
                hasWire = true
                return
            }
        })
        return hasWire;
    }

    function hasInverter(selects) {
        let hasInverter = false
        selects.forEach((select) => {
            if(select.value === 'Inverter') {
                hasInverter = true
                return
            }
        })
        return hasInverter;
    }

    function hasSolarPanel(selects) {
        let hasSolarPanel = false
        selects.forEach((select) => {
            if(select.value === 'Solar Panel') {
                hasSolarPanel = true
                return
            }
        })
        return hasSolarPanel;
    }

    function addAttribute() {
        const attributesContainer = document.querySelector(".attributes");
        const attributeSets = attributesContainer.querySelectorAll(".attribute-set");

        let allInputsValid = true; // Assume all inputs are valid initially
        attributeSets.forEach(attributePair => {
            const categorySelect = attributePair.querySelector("#category");
            const productSelect = attributePair.querySelector("#product");
            const product_countInput = attributePair.querySelector("#product_count");
            //console.log(categorySelect)
            if (categorySelect.value.trim() === "" || productSelect.value.trim() === "" || product_countInput.value.trim() === "") {
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
            const product_countInput = attributeSet.querySelector("#product_count")
            categorySelect.value = ""; // Reset value for select
            attributesContainer.appendChild(attributeSet);
            
            addProductCategoryEvents(attributeSet)
            addProductEvents()
            // updateEnergyGenerated()
        }
    }

    function updateEnergyGenerated() {
        const categorySelect = attributePair.querySelector("#category");
        const productSelect = attributePair.querySelector("#product");
        const product_countInput = attributePair.querySelector("#product_count");
        const energyGenerated = document.getElementById('energy_generated');

        if (categorySelect.value === "Solar Panel") {
            let productInfo = productSelect.value.split("---");
            let solarPanelCount = parseInt(productCountInput.value);
            //it should work, it just needs the name of the product information table and index number holding wattage 
            let solarPanelEnergy = parseInt( /*productinfo[cell_number that holds wattage]*/ )
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
    function addProductCategoryEvents(elem = null) {
        let all_products = JSON.parse(hidden_products.value)
        const category_selects = document.querySelectorAll('.category_select')
        const products = document.querySelectorAll('.products')
        category_selects.forEach((select, index) => {
            select.addEventListener('change', function(e) {
                individual_products = all_products[this.value]
                removeAllChildNodes(products[index])
                for (i = 0; i < individual_products.length; i++) {
                    var opt = document.createElement('option')
                    opt.value = individual_products[i]['product_id']
                    opt.innerHTML = individual_products[i]['Name']+", "+individual_products[i]['Attribute_Value']
                    products[index].appendChild(opt)
                }
            })
        })

        // if(elem)
        // {
        //     console.log(elem)
        //     let event = new Event("change")
        //     elem.querySelector('.category_select').dispatchEvent(event)
        // }
    }

    function addProductEvents() {
        const category_selects = document.querySelectorAll('.category_select')
        const products = document.querySelectorAll('.products')
        const product_counts = document.querySelectorAll('.product_counts')
        products.forEach((product) => {
            product.addEventListener('change', updatePrices)
            product.addEventListener('blur', updatePrices)
            product.addEventListener('focus', updatePrices)
            product.addEventListener('change', updateEnergy)
            product.addEventListener('blur', updateEnergy)
            product.addEventListener('focus', updateEnergy)
        })
        category_selects.forEach((category_select) => {
            category_select.addEventListener('change', updatePrices)
            category_select.addEventListener('blur', updatePrices)
            category_select.addEventListener('focus', updatePrices)
            category_select.addEventListener('change', updateEnergy)
            category_select.addEventListener('blur', updateEnergy)
            category_select.addEventListener('focus', updateEnergy)
        })
        product_counts.forEach((product_count) => {
            product_count.addEventListener('input', updatePrices)
            product_count.addEventListener('input', updateEnergy)
        })
    }

    function updatePrices() {
        let amount = 0
        let all_products = JSON.parse(hidden_products.value)
        const category_selects = document.querySelectorAll('.category_select')
        const products = document.querySelectorAll('.products')
        const product_counts = document.querySelectorAll('.product_counts')
        const price = document.getElementById('price')
        products.forEach((product, index) => {
            let prod_category = category_selects[index].value
            let db_products = all_products[prod_category]
            db_products.forEach((db_product) => {
                if (parseInt(db_product['product_id']) === parseInt(product.value)) {
                    if(!isNaN(product_counts[index].value)) {
                        amount += parseInt(db_product['Price']) * product_counts[index].value 
                    }
                    
                }
            })
        })
        price.innerText = amount
        price.value = amount
    }

    function updateEnergy() {
        let energy = 0;
        let all_products = JSON.parse(hidden_products.value)
        let solar_panels = all_products['Solar Panel']
        const category_selects = document.querySelectorAll('.category_select')
        const products = document.querySelectorAll('.products')
        const product_counts = document.querySelectorAll('.product_counts')
        const energy_field = document.getElementById('energy_generated')
        products.forEach((product, index) => {
            if (category_selects[index].value === 'Solar Panel') {
                solar_panels.forEach((solar_panel) => {
                    if (parseInt(solar_panel['product_id']) === parseInt(product.value)) {
                        prod_energy = solar_panel['Attribute_Value'].split("W")[0];
                        if(!isNaN(product_counts[index].value)) {
                           energy += parseInt(prod_energy) * product_counts[index].value; 
                        }
                    }
                })
            }
        })
        energy_field.value = energy
        energy_field.innerText = energy
    }

    function removeAllChildNodes(parent) {
        while (parent.firstChild) {
            parent.removeChild(parent.firstChild);
        }
    }

    function addRecommendationEvent() {
        const recommendation_button = document.getElementById('get_recommendation')
        recommendation_button.addEventListener('click', function(e)
        {
            if(JSON.parse(document.getElementById('hidden_template').value))
            {
                showTemplate()
            }
            else
            {
                const error_message = document.getElementById('template_error')
                error_message.classList.remove("hidden");
                // Set a timer to hide the error message after 4000 milliseconds (4 seconds)
                setTimeout(function() {
                    error_message.classList.add("hidden");
                }, 3000);
            }
        })
    }

    function showTemplate() {
        var attributesContainer = document.querySelector(".attributes");
        const template = document.getElementById('hidden_template')
        //console.log(template.value)
        let template_json = JSON.parse(template.value)
        console.log(template_json)

        // get a clone of an attribute set as the base
        var baseSet = document.querySelector(".attribute-set").cloneNode(true);

        var template_sets = []

        // clear the current list of products
        removeAllChildNodes(attributesContainer)
        // document.querySelector(".attributes").innerHTML = "";

        /*
        for each template product:
            clone a product set from the base
            add the set to an array for later
            append the set to the parent container
        
        for each set in the array:
            select the correct product category
            populate the product name select
            select the correct product name
            enter the correct product count
        */

        template_json.forEach(function(newTemplate, index) {
            console.log(newTemplate)
            // clone the base set to get the attrib set
            let templateSet = baseSet.cloneNode(true);

            template_sets[index] = templateSet;
            attributesContainer.appendChild(templateSet)
        })

        addProductCategoryEvents()

        template_json.forEach(function(newTemplate, index) {
            let categoryOptions = template_sets[index].querySelector("#category").querySelectorAll("option")
            console.log(categoryOptions)
            categoryOptions.forEach(function(option) {
                if (option.value.localeCompare(newTemplate["Category"]) == 0) {
                    option.setAttribute("selected", "true")
                }
            })
            categorySelect = template_sets[index].querySelector("#category")

            let event = new Event("change")
            categorySelect.dispatchEvent(event)

            let productOptions = template_sets[index].querySelector("#product").querySelectorAll("option")
            console.log(productOptions)
            productOptions.forEach(function(option) {
                if (option.value.localeCompare(newTemplate["id"]) == 0) {
                    option.setAttribute("selected", "true")
                }
            })

            template_sets[index].querySelector("#product_count").value = newTemplate["product_count"]
        
        function validateAttributeSets() {
            const attributeSets = document.querySelectorAll('.attribute-set');
            const types = new Set();

            attributeSets.forEach(attributeSet => {
            const categorySelect = attributeSet.querySelector('.category_select');
            const productSelect = attributeSet.querySelector('.products');

            if (categorySelect && productSelect) {
            const type = categorySelect.value + '|' + productSelect.value;
            types.add(type);
                }
            });

            return types.size >= 3;
        }
            addProductEvents()
            updateEnergy()
            updatePrices()

        })


        /* //for each product in the thing add a corresponding attribute set
         template_json.forEach(function(newTemplate) {
             console.log(newTemplate)
            //clone the base set to get the attrib set
             let templateSet = baseSet.cloneNode(true);

             // set the category
             templateSet.querySelector("#category").value = template["Category"];

             // append the template set to the list
             attributesContainer.appendChild(templateSet)
         })*/
    }

    addProductCategoryEvents()
    addRecommendationEvent()
    addProductEvents()
    addFormEvent()
</script>
