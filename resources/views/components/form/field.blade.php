@props(['type', 'label', 'name', 'value', 'placeholder', 'disabled', 'choices', 'mimes', 'sizemax', 'rows', 'bind', 'options', 'optionsNumber'])

@php
if(isset($bind)) {
    $value = old($name) ?? $bind[$name];
} else if(isset($value)) {
    $value = old($name) ?? $value;
} else {
    $value = old($name) ?? '';
}
if(isset($mimes)) {
    $types = [];
    foreach(explode(',', $mimes) as $mime) {
        array_push($types, strtoupper(explode('/', $mime)[1]));
    }
    $typesName = implode(", ", $types);
}
$id = strtolower(preg_replace('/\W/', '_', $name));
@endphp
<div  @if($disabled ?? '') class="opacity-50" disabled @endif>
@switch($type)
    @case('input')
        <div class="col-span-6">
            <label for="{{ $id }}" class="block text-sm font-medium text-p1">{{ $label ?? $name }}</label>
            <input type="text" value="{{ $value ?? '' }}" placeholder="{{ $placeholder ?? '' }}" name="{{ $id }}" id="{{ $id }}" autocomplete="off" class="bg-si mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm @error($id) border-red-500 @else border-si @enderror rounded-md">
        </div>
    @break
    @case('date')
        <div class="col-span-6">
            <label for="{{ $id }}" class="block text-sm font-medium text-p1">{{ $label ?? $name }}</label>
            <input data-type="date" type="text" value="{{ $value ?? '' }}" placeholder="{{ $placeholder ?? '' }}" name="{{ $id }}" id="{{ $id }}" autocomplete="off" class="bg-si mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm @error($id) border-red-500 @else border-si @enderror rounded-md">
        </div>
    @break
    @case('textarea')
        <div>
            <label for="{{ $id }}" class="block text-sm font-medium text-p1">
                {{ $label ?? $name }}
            </label>
            <div class="mt-1">
                <textarea id="{{ $id }}" name="{{ $id }}" placeholder="{{ $placeholder ?? '' }}" rows="{{ $rows ?? 5 }}" class="bg-si shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm  @error($id) border-red-500 @else border-si @enderror rounded-md">{{ $value ?? '' }}</textarea>
            </div>
        </div>
    @break
    @case('file')
        <div>
            <label class="block text-sm font-medium text-p1">
                {{ $label ?? $name }}
            </label>
            <div class="bg-no-repeat bg-contain bg-center dropContainer mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 @error($id) border-red-500 @enderror border-dashed rounded-md" @if($value ?? '') style="background-image: url({{ $value }})" @endif>
                <div class="space-y-1 text-center px-4 py-2 rounded bg-gray-500 bg-opacity-50">
                    <svg class="mx-auto h-12 w-12 text-p3" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <div class="flex text-sm text-p3">
                    <label for="{{ $id }}" class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                        <span>Ajouter un fichier</span>
                        <input id="{{ $id }}" name="{{ $id }}" accept="{{ $mimes }}" type="file" class="sr-only">
                    </label>
                    <p class="pl-1">ou glisser-déposer</p>
                    </div>
                    <p class="text-xs text-p3">
                        {{ $typesName ?? 'PNG, JPG, GIF' }} {{ isset($maxsize)?('jusqu\'à'.$maxsize):'' }}
                    </p>
                </div>
            </div>
        </div>
    @break
    @case('checkbox')
        <div class="mt-4 space-y-4">
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="{{ $id }}" name="{{ $id }}" type="checkbox" @if($value ?? null) checked @endif class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                </div>
                <label for="{{ $id }}" class="ml-3 text-sm select-none cursor-pointer">
                    <span class="font-medium text-p1">{{ $label ?? $name }}</span>
                    <p class="text-p2">{{ $placeholder ?? '' }}</p>
                </label>
            </div>
        </div>
    @break
    @case('select')
        <div class="col-span-6 sm:col-span-3">
            <label for="country" class="block text-sm font-medium text-p1">{{ $label ?? $name }}</label>
            <select id="{{ $id }}" name="{{ $id }}" autocomplete="off" class="mt-1 block w-full py-2 border border-s3 px-3 bg-si rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @if(count(array_filter(array_keys($options), 'is_string')) > 0 || ($optionsNumber??null) )
                    @foreach($options as $_value => $_name)    
                        <option value="{{ $_value }}" @if($_value == ($value ?? '')) selected @endif>{{ $_name }}</option>
                    @endforeach
                @else 
                    @foreach($options as $option)    
                        <option value="{{ $option }}" @if($option == ($value ?? '')) selected @endif>{{ $option }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    @break
    @case('quill')
        <div>
            <label for="{{ $id }}" class="block text-sm font-medium text-p1">
                {{ $label ?? $name }}
            </label>
            <div class="mt-1">
                <input type="hidden" class="quillHidden" id="{{ $id }}" name="{{ $id }}" value="{{ $value ?? '' }}">
                <div class="quillContainer bg-si mt-1 border-si py-2 rounded-md @error($id) border-red-500 @else border-si @enderror" data-placeholder="{{ $placeholder ?? '' }}"></div>
            </div>
        </div>
    @break
    @case('hidden')
    <input type="hidden" value="{{ $value ?? '' }}" name="{{ $id }}" id="{{ $id }}" autocomplete="off">
    @break
@endswitch
    @error($id)
        <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
            {{ $message }}
        </span>
    @enderror
</div>