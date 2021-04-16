<!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="title_modal">Add New Activity</h4>
          <button type="button" id="close_modal" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post" id="input_form_act">
        @csrf
        <div class="modal-body">
            <input type="hidden" name="id_input" value="">
            <div>
                <label for="title">Title</label>
                <input type="text" name="title_input" id="title" class="form-control" placeholder="Title" value="{{old('title')}}">
                <div name="val_title" class="text-red-500"></div>
            </div>
            <div class="grid grid-cols-2 gap-4 my-2">
                <div>
                    <label for="start">Start Date</label>
                    <input type="date" name="start_input" id="start" class="form-control" value="{{old('start')}}">
                    <div name="val_start" class="text-red-500"></div>
                </div>
                <div>
                    <label for="end">End Date</label>
                    <input type="date" name="end_input" id="end" class="form-control" value="{{old('end')}}">
                    <div name="val_end" class="text-red-500"></div>
                </div>
            </div>
            <div class="my-2">
                <label for="method">Method</label>
                <input list="methods" class="form-control" name="method_input" id="method">

                <datalist id="methods">
                    <option value="" disabled selected>Choose One</option>
                    @foreach($methods as $method)
                        <option value="{{$method->id}}" {{old('method') == $method->id ? 'selected' : ''}}>{{$method->name}}</option>
                    @endforeach
                </datalist>
                <div name="val_method" class="text-red-500"></div>
            </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="save_act" class="btn btn-primary">Submit</button>
        </div>
        </form>
        
      </div>
    </div>
  </div>

  <script>
    $("#save_act").click(function(event){
        event.preventDefault();

        $("div[name=val_title]").html(""); 
        $("div[name=val_start]").html(""); 
        $("div[name=val_end]").html(""); 
        $("div[name=val_method]").html(""); 

        let title = $("input[name=title_input]").val();
        let start = $("input[name=start_input]").val();
        let end = $("input[name=end_input]").val();
        let method = $("input[name=method_input]").val();
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          url: "{{route('learning_activity.store')}}",
          type:"POST",
          data: $('#input_form_act').serialize(),
          success:function(response){
            console.log(response);
            if(response.status == 'success') {
              $('.success').text(response.success);
              $("#input_form_act")[0].reset();
              $('#close_modal').click();
              $("#refresh").click()
            }else{
              if (response.validation.title_input) {
                $("div[name=val_title]").html(response.validation.title_input[0]); 
              }
              if (response.validation.start_input) {
                $("div[name=val_start]").html(response.validation.start_input[0]); 
              }
              if (response.validation.end_input) {
                $("div[name=val_end]").html(response.validation.end_input[0]); 
              }
              if (response.validation.method_input) {
                $("div[name=val_method]").html(response.validation.method_input[0]); 
              }
            }
          },
        });
    });
  </script>