<head>
    <meta charset="utf-8">
    <title>Username Error</title>
</head>

<body>
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-white">
                        <p>Please ensure that you have entered your First and Last Names in your Profile Page.<br>
                            <a href="{{ route('profile.edit') }}" class="text-blue-500 hover:underline">Profile</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>