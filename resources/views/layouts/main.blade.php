


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Main')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="shortcut icon" href="{{ url('../../img/logo-oldmoney.png') }}" />
   </head>
<body class=" dark:bg-zinc-800">
    <x-nav />
    <x-nav-template />


<div class=" md:ml-64">
   <div class="p-4  mt-4">
    <!-- grid grid-cols-3 gap-4 mb-4" -->
      <div class="">         
         
        <div>
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

