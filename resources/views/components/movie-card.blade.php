<div class="mt-8">
    <a href="{{route('movies.show',$movie['id'])}}">
        <img src="{{'https://image.tmdb.org/t/p/w500/'.$movie['poster_path']}}" class="hover:opacity-75 transition ease-in-out duration-150" alt="">
    </a>
    <div class="mt-2">
        <a href="{{route('movies.show',$movie['id'])}}" class="text-lg hover:text-gray-300 mt-2" >{{$movie['title']}}</a>
        <div class="flex items-center text-gray-400 text-sm mt-1 ">
                  <span>
                    <svg class="fill-current w-6  text-orange-500" x="0px" y="0px" viewBox="0 0 64 80" enable-background="new 0 0 64 64" xml:space="preserve"><path d="M57.671,26.046c-0.268-0.824-1.036-1.382-1.902-1.382H39.064L33.902,8.776C33.635,7.953,32.866,7.395,32,7.395   c-0.867,0-1.634,0.558-1.902,1.382l-5.162,15.888H8.231c-0.867,0-1.634,0.558-1.902,1.382c-0.268,0.824,0.026,1.727,0.727,2.236   L20.57,38.1l-5.163,15.888c-0.268,0.824,0.026,1.727,0.727,2.236c0.701,0.51,1.65,0.51,2.352,0L32,46.404l13.515,9.819   c0.351,0.255,0.764,0.382,1.176,0.382s0.825-0.127,1.176-0.382c0.701-0.51,0.994-1.412,0.727-2.236L43.43,38.1l13.515-9.817   C57.646,27.773,57.938,26.87,57.671,26.046z M39.902,35.718c-0.701,0.51-0.994,1.412-0.727,2.236l3.71,11.415l-9.71-7.055   c-0.701-0.51-1.65-0.51-2.352,0l-9.71,7.055l3.709-11.415c0.268-0.824-0.026-1.727-0.727-2.236l-9.709-7.054h12.002   c0.867,0,1.634-0.558,1.902-1.382L32,15.867l3.709,11.416c0.268,0.824,1.036,1.382,1.902,1.382h12.001L39.902,35.718z"/></svg>

                  </span>
            <span class="ml-1">{{$movie['vote_average'] * 10 . '%'}}</span>
            <span class="mx-2">|</span>
            <span>{{\Carbon\Carbon::parse($movie['release_date'])->format('d M Y')}}</span>
        </div>
        <div class="text-gray-400 text-sm">
            @foreach($movie['genre_ids'] as $genre){{$genres->get($genre)}} @if(!$loop->last),@endif @endforeach
        </div>
    </div>
</div>
