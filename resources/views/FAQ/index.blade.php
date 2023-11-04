<x-app-layout>
    @auth
    <div class="container mx-auto flex flex-col items-center text-white">
    <div class="flex gap-10">
        <h1 class="text-2xl font-semibold mt-4">FAQ</h1>
        <div class="relative">
        <a href="{{ route('FAQs.index') }}" class="absolute left-0 top-0 text-blue-500 hover:text-blue-600 font-semibold text-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline align-text-top" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back
        </a>
        </div>
    </div>
    <div class="my-8">
        @foreach ($FAQs->groupBy('Category') as $category => $faqs)
        <h2 class="text-xl font-semibold text-white">{{ $category }}</h2>
        <div class="flex flex-col gap-4 w-[280px]">
        @foreach ($faqs as $faq)
        <div class="text-lg text-white">Q: {{ $faq->Questions }}</div>
        <div class="text-lg text-white">A: {{ $faq->Answers }}</div>
        @endforeach
        <br>
        <br>
        </div>
        @endforeach
    </div>
    </div>
    @endauth
</x-app-layout>