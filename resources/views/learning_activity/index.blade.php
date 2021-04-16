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
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" id="input_act" class="btn bg-green-500 rounded-md text-white hover:bg-green-700" data-toggle="modal" data-target="#myModal">Add Activity</button>
                        </div>
                        <div class="col-md-6 text-right">
                            <button class="btn btn-light" id="refresh"><span class="fas fa-sync-alt"></span></button>
                        </div>
                        <script>
                            var learningSchedule = ""

                            $("#refresh").click(function(){
                                loadingSchedule()
                                $.get("refresh", function (data) {
                                    learningSchedule = data
                                    showSchedule()
                                })
                            });
                        </script>
                    </div>
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
                        <tbody class="text-left" id="schedule">
                            <tr>
                                <td colspan="13" class="text-center">
                                    <div class="spinner-grow text-secondary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </td>
                            </tr>
                            <script>
                                function loadingSchedule(){
                                    $("#schedule").html("<tr>"+
                                        "<td colspan='13' class='text-center'>"+
                                            "<div class='spinner-grow text-secondary' role='status'>"+
                                                "<span class='sr-only'>Loading...</span>"+
                                            "</div>"+
                                        "</td>"+
                                    "</tr>")
                                }
                                function showSchedule(){
                                    $("#schedule").html("")
                                    let id = 1
                                    $.each(learningSchedule, function(key, map){
                                        $("#schedule").append("<tr class='"+id+"'><td class='font-weight-bold'>"+key+"</td></tr>")
                                        for (let month = 1; month <= 12; month++) {
                                            $("."+id).append("<td class='"+id+month+"'></td>")
                                            if (month in map) {
                                                $.each(map[month], function(i, act){
                                                    $("."+id+month).append(act.title+"<br><small class='text-primary'>"+act.start_date+" - "+act.end_date+"</small><br>"+
                                                    "<button type='button' class='btn text-yellow-400 hover:text-yellow-700 edit_act' data-id='"+act.id+"' data-toggle='modal' data-target='#myModal'>"+
                                                        "<span class='fas fa-edit'></span>"+
                                                    "</button>"+
                                                    "<button type='button' data-id='"+act.id+"' class='btn text-red-500 hover:text-red-700 delete_act'>"+
                                                        "<span class='fas fa-trash'></span>"+
                                                    "</button><hr>")
                                                })
                                            }
                                        }
                                        id++
                                    })
                                    
                                }
                            </script>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>    

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $('#input_act').on('click', function () {
                $('#title_modal').html("Add New Activity");
                $("input[name=id_input]").val("");
                $("input[name=title_input]").val("");
                $("input[name=start_input]").val("");
                $("input[name=end_input]").val("");
                $("input[name=method_input]").val("");
            });

            $('body').on('click', '.edit_act', function () {
                var act_id = $(this).data("id");

                console.log(act_id)
                let url_edit = "{{ route('learning_activity.index') }}"+'/'+act_id+'/edit'
                $.get(url_edit, function (data) {
                    $('#title_modal').html("Edit Activity");
                    // $('#ajaxModel').modal('show');
                    $("input[name=id_input]").val(data.id);
                    $("input[name=title_input]").val(data.title);
                    $("input[name=start_input]").val(data.start_date);
                    $("input[name=end_input]").val(data.end_date);
                    $("input[name=method_input]").val(data.id_method);
                })
            });
            
            $('body').on('click', '.delete_act', function () {
                var act_id = $(this).data("id");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    let url_delete = "{{ route('learning_activity.index') }}"+'/'+act_id
                    console.log(url_delete)
                    $.ajax({
                        type: "DELETE",
                        url: url_delete,
                        success: function (data) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            $("#refresh").click()
                        },
                        error: function (data) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Cannot delete the data!',
                            })
                            console.log('Error:', data);
                        }
                    });
                }
                })
            });

            $( document ).ready(function() {
                $("#refresh").click()
            });
        </script>

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
