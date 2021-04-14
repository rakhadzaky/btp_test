<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Methods') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-xl leading-tight">Edit Method</h3>
                    <form action="{{route('method.update', $method->id)}}" class="my-5" method="post">
                        @method('PUT')
                        @csrf
                        <div class="my2">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="w-full rounded-md border-gray-400" value="{{$method->name}}">
                            @error('name')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="bg-green-500 hover:bg-grenn-700 rounded-md text-white p-2.5 my-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
