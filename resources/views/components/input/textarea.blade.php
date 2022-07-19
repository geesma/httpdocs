<textarea
    {{ $attributes->merge(['class' => 'w-full px-4 py-2 transition rounded-2xl border border-black duration-150 hover:outline-none hover:ring-2 hover:ring-offset-2 hover:ring-offset-white-800 hover:ring-black focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-offset-white-800 focus:ring-black']) }}>{{ $slot }}</textarea>
