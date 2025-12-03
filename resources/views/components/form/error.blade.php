@props(['name'])

@error($name)
    <p class="text-red-500 text-xs mt-0 mb-2">* {{ $message }}</p>
@enderror
