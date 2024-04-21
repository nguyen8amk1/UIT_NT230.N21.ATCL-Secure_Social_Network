<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Secured Note</title>

        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <style>
            body {
            background-color: #f8f9fa;
            }
            .login-container {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 100px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                        <b>| Hello, {!! Auth::user()->name !!}</b>
                    @else
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Login</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <div class="container">
            <div class="login-container">
              <h2 class="text-center mb-4">Note</h2>
              <form id="submit_form">
                @csrf

                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Enter note's name">
                </div>

                <div class="form-group">
                  <label for="content">Content</label>
                  <textarea type="text" class="form-control" name="content" id="content" placeholder="Enter note's content"></textarea>
                </div>
                
                <div id="msg">
                    
                </div>
                <button type="submit" class="btn btn-primary btn-block">Create</button>
              </form>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js"></script>
        <script src="{{ asset('js/home.js') }}"></script>
    </body>
</html>
