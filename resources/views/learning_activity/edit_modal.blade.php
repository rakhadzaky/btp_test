<!-- The Modal -->
<div class="modal fade" id="myModal_edit{{$act->id}}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New Activity</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post" id="edit_form_act{{$act->id}}">
        @csrf
        <div class="modal-body">
            <div>
                <label for="title">Title</label>
                <input type="text" name="title_edit" id="title" class="form-control" placeholder="Title" value="{{ old('title') == null ? $act->title : old('title')}}">
                <div name="val_title" class="text-red-500"></div>
            </div>
            <div class="grid grid-cols-2 gap-4 my-2">
                <div>
                    <label for="start">Start Date</label>
                    <input type="date" name="start_edit" id="start" class="form-control" value="{{ old('start') == null ? $act->start_date : old('start')}}">
                    <div name="val_start" class="text-red-500"></div>
                </div>
                <div>
                    <label for="end">End Date</label>
                    <input type="date" name="end_edit" id="end" class="form-control" value="{{ old('end') == null ? $act->end_date : old('end')}}">
                    <div name="val_end" class="text-red-500"></div>
                </div>
            </div>
            <div class="my-2">
                <label for="method">Method</label>
                <input list="methods" class="form-control" name="method_edit" id="method" value="{{ old('method') == null ? $act->id_method : old('method')}}">

                <datalist id="methods">
                    @foreach($methods as $method)
                        <option value="{{$method->id}}">{{$method->name}}</option>
                    @endforeach
                </datalist>
                <div name="val_method" class="text-red-500"></div>
            </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="edit_act{{$act->id}}" class="btn btn-primary">Submit</button>
        </div>
        </form>
        
      </div>
    </div>
  </div>

  <script>
    $("#edit_act{{$act->id}}").click(function(event){
        event.preventDefault();

        $("div[name=val_title]").html(""); 
        $("div[name=val_start]").html(""); 
        $("div[name=val_end]").html(""); 
        $("div[name=val_method]").html(""); 

        let title = $("input[name=title_edit]").val();
        let start = $("input[name=start_edit]").val();
        let end = $("input[name=end_edit]").val();
        let method = $("input[name=method_edit]").val();
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          url: "{{route('learning_activity.store', $act->id)}}",
          type:"POST",
          data: $('#edit_form_act{{$act->id}}').serialize(),
          success:function(response){
            console.log(response);
            if(response.status == 'success') {
              $('.success').text(response.success);
              $('#close_modal').click();
              $("#refresh").click()
            }else{
              if (response.validation.title_edit) {
                $("div[name=val_title]").html(response.validation.title_edit[0]); 
              }
              if (response.validation.start_edit) {
                $("div[name=val_start]").html(response.validation.start_edit[0]); 
              }
              if (response.validation.end_edit) {
                $("div[name=val_end]").html(response.validation.end_edit[0]); 
              }
              if (response.validation.method_edit) {
                $("div[name=val_method]").html(response.validation.method_edit[0]); 
              }
            }
          },
        });
    });
  </script>