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
                    <button class="modal-open p-2.5 my-3 bg-green-500 rounded-md text-white hover:bg-green-700">Add Activity</button>
                    @include('learning_activity.create_modal')
                    <table class="table table-auto w-full">
                        <thead class="text-left">
                            <th>Title</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Methods</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @if($activitys->count() < 1)
                                <tr>
                                    <td colspan="4" class="text-center">There is no data</td>
                                </tr>
                            @else
                            @foreach($activitys as $activity)
                            <tr>
                                <td>{{$activity->title}}</td>
                                <td>{{$activity->start_date}}</td>
                                <td>{{$activity->end_date}}</td>
                                <td>{{$activity->methods->name}}</td>
                                <td>
                                    <form action="{{route('learning_activity.destroy', $activity->id)}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <a href="{{route('learning_activity.edit', $activity->id)}}" class="bg-yellow-500 p-2.5 rounded-md text-white hover:bg-yellow-700 mr-3">
                                            Edit
                                        </a>
                                        <button type="submit" class="bg-red-500 p-2.5 rounded-md text-white hover:bg-red-700" onclick="return confirm('Are you sure?');">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- <a href="{{route('method.create')}}"><button class="p-2.5 my-3 bg-green-500 rounded-md text-white hover:bg-green-700">Add Method</button></a> -->
                    <button class="modal-open-method p-2.5 my-3 bg-green-500 rounded-md text-white hover:bg-green-700">Add Method</button>
                    @include('methods.create_modal')
                    <table class="table table-auto w-full">
                        <thead class="text-left">
                            <th>Name</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @if($methods->count() < 1)
                                <tr>
                                    <td class="text-center">There is no data</td>
                                </tr>
                            @else
                            @foreach($methods as $method)
                            <tr>
                                <td>{{$method->name}}</td>
                                <td>
                                    <form action="{{route('method.destroy', $method->id)}}" method="post">
                                    @method('delete')
                                    @csrf
                                    <a href="{{route('method.edit', $method->id)}}" class="bg-yellow-500 p-2.5 rounded-md text-white hover:bg-yellow-700 mr-3">
                                        Edit
                                    </a>
                                    <button type="submit" class="bg-red-500 p-2.5 rounded-md text-white hover:bg-red-700" onclick="return confirm('Are you sure?');">
                                        Delete
                                    </button>
                                    
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
