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
                    <button type="button" class="p-2.5 my-3 bg-green-500 rounded-md text-white hover:bg-green-700" data-toggle="modal" data-target="#myModal">Add Activity</button>
                    @include('learning_activity.create_modal')
                    <table class="table table-borderless table-striped table-responsive">
                        <thead class="text-left">
                            <th>Metode</th>
                            <th>Januari</th>
                            <th>Februari</th>
                            <th>Maret</th>
                            <th>April</th>
                            <th>Mei</th>
                            <th>Juni</th>
                            <th>Juli</th>
                            <th>Agustus</th>
                            <th>September</th>
                            <th>Oktober</th>
                            <th>November</th>
                            <th>Desember</th>
                            <th></th>
                        </thead>
                        <tbody class="text-left">
                            @foreach($method_act_map as $key => $map)
                                <tr>
                                <td class="font-weight-bold">
                                    {{$key}}
                                </td>
                                @for($i=1; $i<=12; $i++)
                                    <td>
                                        @if(array_key_exists($i, $map))
                                            @foreach($map[$i] as $act)
                                                {{$act->title}}<br>
                                                <small class="text-primary">{{date('d M Y', strtotime($act->start_date))}} - {{date('d M Y', strtotime($act->end_date))}}</small><br>
                                                <div>
                                                    <form action="{{route('learning_activity.destroy', $act->id)}}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="button" class="btn text-yellow-400 hover:text-yellow-700" data-toggle="modal" data-target="#myModal_edit{{$act->id}}">
                                                            <span class='fas fa-edit'></span>
                                                        </button>
                                                        @include('learning_activity.edit_modal')
                                                        <button type="submit" class="btn text-red-500 hover:text-red-700" onclick="return confirm('Are you sure?');">
                                                            <span class="fas fa-trash"></span>
                                                        </button>
                                                    </form>
                                                </div>
                                                <hr>
                                            @endforeach
                                        @endif
                                    </td>
                                @endfor
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
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
    </div>
</x-app-layout>
