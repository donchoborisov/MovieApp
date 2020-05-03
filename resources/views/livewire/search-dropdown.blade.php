
    <div class="relative mt-3 md:mt-0" x-data="{isOpen:true}" @click.away="isOpen=false">
        <input wire:model.debounce.500ms="search"
               @focus="isOpen = true" type="text"
               @keydown.shift.tab ="isOpen=false"
               @keydown ="isOpen=true"
               x-ref ="search"
               @keydown.window="
               if(event.keyCode === 191){
               event.preventDefault();
               $refs.search.focus();
               }
               "

               class="bg-gray-800 text-sm   rounded-full w-64 pl-8 focus:outline-none focus:shadow-outline px-4 py-1" placeholder="Search">
        <div class="absolute top-0">
            <svg class="fill-current w-5 mt-1 ml-2" viewBox="0 0 24 24" ><path d="M15.759,10.695c0-2.797-2.268-5.062-5.063-5.062c-2.796,0-5.062,2.266-5.063,5.062c0.001,2.797,2.267,5.062,5.063,5.062   c1.275,0,2.427-0.488,3.318-1.266l3.874,3.876l0.479-0.479l-3.874-3.876C15.272,13.122,15.759,11.971,15.759,10.695z    M10.696,15.081c-2.421-0.005-4.38-1.965-4.385-4.385c0.005-2.423,1.963-4.38,4.385-4.385c2.423,0.005,4.381,1.962,4.385,4.385   C15.077,13.116,13.119,15.075,10.696,15.081z"/></svg>
        </div>
        <div wire:loading class="spinner top-0 right-0 mr-4 mt-3"></div>
        @if (strlen($search)>=2)
        <div class="absolute bg-gray-800 w-64 mt-4 text-sm z-50 rounded"

             @keydown.escape.window="isOpen=false" x-show.transition.duration.200ms="isOpen">
          @if($searchResults->count()>0)
            <ul>
                @foreach($searchResults as $result)
                <li class="border-b border-gray-700">
                    <a href="{{route('movies.show',$result['id'])}}"
                       class="block px-3 flex items-center py-3 hover:bg-gray-700"
                    @if($loop->last) @keydown.tab="isOpen=false" @endif
                    >

                         @if ($result['poster_path'])
                        <img src="https://image.tmdb.org/t/p/w92/{{$result['poster_path']}}" class="w-8" alt="poster">
                        <span class="ml-4"> {{$result['title']}}</span>
                        @else
                        <img src="https://via.placeholder.com/50x75" alt="poster" class="w-8">

                        @endif


                    </a>
                </li>
                @endforeach
            </ul>
              @else
              <div class="px-3 py-3">No results for{{$search}} </div>
              @endif
        </div>
        @endif
    </div>

