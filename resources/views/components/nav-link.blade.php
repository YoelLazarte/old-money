<div>
    <!-- <a class="nav-link {{ request()->routeIs($route) ?'active' : '' }}"
        {!! request()->routeIs($route) ?'aria-current="page"' : '' !!}
        href="{{ route($route) }}">{{ $slot }}</a> -->

        <a href="{{ route($route) }}" class="flex items-center p-2 text-gray-900 dark:text-white w-full group {{ request()->routeIs($route) ?  'text-emerald-600 font-black' : '' }}">
               <span class="flex-1 ms-3 whitespace-nowrap">{{ $slot }}</span>
         </a>
</div>