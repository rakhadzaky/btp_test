<!--Modal-->
<div class="modal-method opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay-method absolute w-full h-full bg-gray-900 opacity-50"></div>
    
    <div class="modal-container bg-white w-full md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
      
      <div class="modal-close-method absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
          <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
        </svg>
        <span class="text-sm">(Esc)</span>
      </div>

      <!-- Add margin if you want to see some of the overlay behind the modal-->
      <div class="modal-content py-4 text-left px-6">
        <!--Title-->
        <div class="flex justify-between items-center pb-3">
          <p class="text-2xl font-bold">Add New Activity</p>
          <div class="modal-close-method cursor-pointer z-50">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
          </div>
        </div>

        <!--Body-->
        <form action="{{route('method.store')}}" class="my-5" method="post">
            @csrf
            <div class="my2">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="w-full rounded-md border-gray-400">
                @error('name')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

        <!--Footer-->
        <div class="flex justify-end pt-2">
          <button type="submit" class="px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Submit</button>
          <a class="modal-close-method px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Close</a>
        </div>
        </form>
        
      </div>
    </div>
  </div>

  <script>
    var openmodal_method = document.querySelectorAll('.modal-open-method')
    for (var i = 0; i < openmodal_method.length; i++) {
      openmodal_method[i].addEventListener('click', function(event){
    	event.preventDefault()
    	toggleModal_method()
      })
    }
    
    const overlay_method = document.querySelector('.modal-overlay-method')
    overlay_method.addEventListener('click', toggleModal_method)
    
    var closemodal_method = document.querySelectorAll('.modal-close-method')
    for (var i = 0; i < closemodal_method.length; i++) {
      closemodal_method[i].addEventListener('click', toggleModal_method)
    }
    
    document.onkeydown = function(evt) {
      evt = evt || window.event
      var isEscape = false
      if ("key" in evt) {
    	isEscape = (evt.key === "Escape" || evt.key === "Esc")
      } else {
    	isEscape = (evt.keyCode === 27)
      }
      if (isEscape && document.body.classList.contains('modal-active')) {
    	toggleModal_method()
      }
    };
    
    
    function toggleModal_method () {
      const body = document.querySelector('body')
      const modal_method = document.querySelector('.modal-method')
      modal_method.classList.toggle('opacity-0')
      modal_method.classList.toggle('pointer-events-none')
      body.classList.toggle('modal-active')
    }
    
     
  </script>