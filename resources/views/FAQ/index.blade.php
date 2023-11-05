<x-app-layout>
    @auth
    <div class="container mx-auto p-6 text-white">
        <h1 class="text-3xl font-bold text-center my-8">Frequently Asked Questions</h1>
        
        @foreach ($FAQs->groupBy('Category') as $category => $faqs)
            <div class="mb-10">
                <h2 class="text-xl font-semibold mb-4">{{ $category }}</h2>
                <div class="space-y-6">
                    @foreach ($faqs as $faq)
                        <div class="bg-gray-800 p-4 rounded-md">
                            <p class="text-lg font-semibold">Q: {{ $faq->Questions }}</p>
                            <p class="text-lg mt-2">{{ $faq->Answers }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="text-left">
            <a href="{{ route('dashboard') }}" class="text-blue-500 hover:text-blue-600 font-semibold text-lg inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
        </div>
    </div>
    @endauth
</x-app-layout>