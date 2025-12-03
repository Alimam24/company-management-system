<button
    {{ $attributes->merge(['class' => 'rounded-md bg-purple-900 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-900','type'=>'submit']) }}
    >{{ $slot }}</button>
