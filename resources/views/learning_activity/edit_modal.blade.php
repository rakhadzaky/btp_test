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
        <form action="{{route('learning_activity.update',$act->id)}}" method="post">
        @method('PUT')
        @csrf
        <div class="modal-body">
            <div>
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="{{ old('title') == null ? $act->title : old('title')}}">
                @error('title')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="grid grid-cols-2 gap-4 my-2">
                <div>
                    <label for="start">Start Date</label>
                    <input type="date" name="start" id="start" class="form-control" value="{{ old('start') == null ? $act->start_date : old('start')}}">
                    @error('start')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="end">End Date</label>
                    <input type="date" name="end" id="end" class="form-control" value="{{ old('end') == null ? $act->end_date : old('end')}}">
                    @error('end')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="my-2">
                <label for="method">Method</label>
                <input list="methods" class="form-control" name="method" id="method" value="{{ old('method') == null ? $act->id_method : old('method')}}">

                <datalist id="methods">
                    @foreach($methods as $method)
                        <option value="{{$method->id}}">{{$method->name}}</option>
                    @endforeach
                </datalist>
                @error('method')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
        
      </div>
    </div>
  </div>