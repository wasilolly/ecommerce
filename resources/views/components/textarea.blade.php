@props(['value','cols','rows','name','placeholder'])

<textarea class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" cols="{{ $cols}}" rows="{{$rows}}" name="{{$name}}" placeholder="{{$placeholder}}"
        >{{ $value }}
</textarea>
