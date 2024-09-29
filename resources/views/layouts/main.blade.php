


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Main')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="shortcut icon" href="{{ url('../../img/logo-oldmoney.png') }}" />
   </head>
<body class=" dark:bg-zinc-800">
    
    <x-nav />
    <x-nav-template />


    <div class=" md:ml-64">
       <div class="p-4  mt-4">
          <div class="">         

            <div>
                @if (session()->has('feedback.message'))
                <div class="w-96 mt-8 mx-auto flex items-center p-4 mb-4 text-sm text-{{session()->get('feedback.color')}}-800 border border-{{session()->get('feedback.color')}}-300 rounded-lg bg-{{session()->get('feedback.color')}}-50 dark:bg-gray-800 dark:text-white dark:border-{{session()->get('feedback.color')}}-800" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                <span class="sr-only">Info</span>
                <div>
                {!! session()->get('feedback.message') !!}
                </div>
                </div>
                @endif

                @yield('content')
            </div>

        </div>
    </div>


    <x-footer></x-footer>
    </div>




<script src="{{ asset('js/darkmode.js') }}" ></script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js" ></script>
<script>
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
</script>

</body>
</html>

