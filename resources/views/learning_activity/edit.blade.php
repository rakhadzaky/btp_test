<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Learning Activity') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-xl leading-tight">Edit Activity</h3>
                    <form action="{{route('learning_activity.update', $activity->id)}}" class="my-5" method="post">
                        @method('PUT')
                        @csrf
                        <div class="my2">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="w-full rounded-md border-gray-400" placeholder="Title" value="{{ old('title') == null ? $activity->title : old('title')}}">
                            @error('title')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="grid grid-cols-2 gap-4 my-2">
                            <div>
                                <label for="start">Start Date</label>
                                <input type="date" name="start" id="start" class="w-full rounded-md border-gray-400" value="{{ old('start') == null ? $activity->start_date : old('start')}}">
                                @error('start')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="end">End Date</label>
                                <input type="date" name="end" id="end" class="w-full rounded-md border-gray-400" value="{{ old('end') == null ? $activity->end_date : old('end')}}">
                                @error('end')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="my-2">
                            <label for="method">Method</label>
                            <input list="methods" class="form-control" name="method" id="method">

                            <datalist id="methods">
                                <option value="" disabled selected>Choose One</option>
                                @foreach($methods as $method)
                                    <option value="{{$method->id}}" {{old('method') != null ? old('method') == $method->id ? 'selected' : '' : $method->id == $activity->id_method ? 'selected' : ''}}>{{$method->name}}</option>
                                @endforeach
                            </datalist>
                            @error('method')
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
