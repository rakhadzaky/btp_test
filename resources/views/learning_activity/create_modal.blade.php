<!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New Activity</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form action="{{route('learning_activity.store')}}" method="post">
        @csrf
        <div class="modal-body">
            <div>
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="{{old('title')}}">
                @error('title')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="grid grid-cols-2 gap-4 my-2">
                <div>
                    <label for="start">Start Date</label>
                    <input type="date" name="start" id="start" class="form-control" value="{{old('start')}}">
                    @error('start')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="end">End Date</label>
                    <input type="date" name="end" id="end" class="form-control" value="{{old('end')}}">
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
                        <option value="{{$method->id}}" {{old('method') == $method->id ? 'selected' : ''}}>{{$method->name}}</option>
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