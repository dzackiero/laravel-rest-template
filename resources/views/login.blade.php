<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900 text-gray-200 h-screen flex justify-center items-center">

<div class="w-full max-w-md">
    <div class="bg-gray-800 p-8 shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-100">Login</h2>

        <!-- Check for session errors -->
        @if ($errors->any())
            <div class="bg-red-600 text-white p-4 rounded mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('attempt') }}" method="POST">
            @csrf

            <!-- Email Input -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                <input type="email" name="email" id="email"
                       class="mt-1 block w-full px-4 py-2 bg-gray-700 text-gray-200 border border-gray-600 rounded-md outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                       required autofocus>
            </div>

            <!-- Password Input -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                <input type="password" name="password" id="password"
                       class="mt-1 block w-full px-4 py-2 bg-gray-700 text-gray-200 border border-gray-600 rounded-md outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                       required>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-between items-center">
                <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
