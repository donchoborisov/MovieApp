@extends('layouts.main')


@section('content')
<div class="movie-info border-b border-gray-800">
    <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
        <div class="flex flex-none">
        <img src="{{'https://image.tmdb.org/t/p/w500/'.$movie['poster_path']}}" alt="" class="w-64 lg:w-96">
        </div>
        <div class="md:ml-24">
            <h2 class="text-4xl font-semibold">{{$movie['title']}}</h2>



                <div class="flex items-center flex-wrap text-gray-400 text-sm  ">
                  <span>
                    <svg class="fill-current w-6 mt-1 text-orange-500" x="0px" y="0px" viewBox="0 0 64 80" enable-background="new 0 0 64 64" xml:space="preserve"><path d="M57.671,26.046c-0.268-0.824-1.036-1.382-1.902-1.382H39.064L33.902,8.776C33.635,7.953,32.866,7.395,32,7.395   c-0.867,0-1.634,0.558-1.902,1.382l-5.162,15.888H8.231c-0.867,0-1.634,0.558-1.902,1.382c-0.268,0.824,0.026,1.727,0.727,2.236   L20.57,38.1l-5.163,15.888c-0.268,0.824,0.026,1.727,0.727,2.236c0.701,0.51,1.65,0.51,2.352,0L32,46.404l13.515,9.819   c0.351,0.255,0.764,0.382,1.176,0.382s0.825-0.127,1.176-0.382c0.701-0.51,0.994-1.412,0.727-2.236L43.43,38.1l13.515-9.817   C57.646,27.773,57.938,26.87,57.671,26.046z M39.902,35.718c-0.701,0.51-0.994,1.412-0.727,2.236l3.71,11.415l-9.71-7.055   c-0.701-0.51-1.65-0.51-2.352,0l-9.71,7.055l3.709-11.415c0.268-0.824-0.026-1.727-0.727-2.236l-9.709-7.054h12.002   c0.867,0,1.634-0.558,1.902-1.382L32,15.867l3.709,11.416c0.268,0.824,1.036,1.382,1.902,1.382h12.001L39.902,35.718z"/></svg>

                  </span>
                    <span class="ml-1">{{$movie['vote_average'] * 10 . '%'}}</span>
                    <span class="mx-2">|</span>
                    <span>{{\Carbon\Carbon::parse($movie['release_date'])->format('d M Y')}}</span>
                    <span class="mx-2">|</span>
                    <span>
                         @foreach($movie['genres'] as $genre)
                            {{$genre['name']}}@if(!$loop->last),@endif
                        @endforeach
                    </span>
                </div>
            <p class="mt-8">
                {{$movie['overview']}}
            </p>

            <div class="mt-12">
                <h4 class="text-white font-semibold">Featured cast</h4>
                <div class="flex mt-4">
                    @foreach($movie['credits']['crew'] as $crew)
                      @if($loop->index < 2)
                            <div class="mr-8">
                                <div>{{$crew['name']}}</div>
                                <div class="text-sm text-gray-400">{{$crew['job']}}</div>
                            </div>
                       @else
                          @break
                       @endif
                    @endforeach
                </div>



            </div>
            <div x-data="{isOpen:false}">
            <div >
            @if(count($movie['videos']['results'])>0)
            <div class="mt-12">
                <button @click="isOpen=true" href="https://youtube.com/watch?v={{$movie['videos']['results']['0']['key']}}" class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold
                px-5 py-4 hover:bg-orange-600 transition-ease-in-out duration-150 ">
                    <svg class="fill-current w-6 pt-1" viewBox="0 0 100 125" x="0px" y="0px"><polygon points="39.72 31.86 39.72 67.78 69.15 49.82 39.72 31.86"/><path d="M49.85,92.12a42.31,42.31,0,1,1,42.31-42.3A42.35,42.35,0,0,1,49.85,92.12Zm0-82.61A40.31,40.31,0,1,0,90.16,49.82,40.35,40.35,0,0,0,49.85,9.51Z"/></svg>
                     <span class="ml-2 ">Play trailer</span>
                </button>
            </div>

        </div>
          @endif
        <!-----modal---->
        <div x-show.transition.duration.200ms="isOpen"
            style="background-color: rgba(0, 0, 0, .5);"
            class=" fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
        >
            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                <div class="bg-gray-900 rounded">
                    <div class="flex justify-end pr-4 pt-2">
                        <button
                            @click="isOpen = false"
                            @keydown.escape.window="isOpen = false"
                            class="text-3xl leading-none hover:text-gray-300">&times;
                        </button>
                    </div>
                    <div class="modal-body px-8 py-8">
                       <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                            <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
        <!-----modal end---->
        </div>


    </div>
</div> <!----- end movie info ------>


<div class="movie cast border-b border-gray-800"><!----- movie cast ------>
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">Cast</h2>
        <div class="grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3  lg:grid-cols-5  gap-8">

            @foreach($movie['credits']['cast'] as $cast)
                @if($loop->index < 5)
                <div class="mt-8">
                    <a href="{{route('actors.show',$cast['id'])}}">
                        <img src="{{'https://image.tmdb.org/t/p/w300/'.$cast['profile_path']}}" class="hover:opacity-75 transition ease-in-out duration-150" alt="">
                    </a>
                    <div class="mt-2">
                        <a href="{{route('actors.show',$cast['id'])}}" class="text-lg hover:text-gray-300 mt-2" >{{$cast['name']}}</a>
                        <div class=" items-center text-gray-400 text-sm mt-1">

                            <p class="text-sm">{{$cast['character']}}</p>

                        </div>

                    </div>
                </div>
                @else
                 @break
               @endif


            @endforeach








            <div>


            </div>



        </div>

    </div>


</div><!----- movie cast ------>

<div class="movie pictures border-b border-gray-800" x-data="{isOpen:false, image:''}"><!----- movie pictures ------>
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">Pictures</h2>
        <div class="grid grid grid-cols-1 sm:grid-cols-2 md:gap-3  lg:grid-cols-3  gap-8">
            @foreach($movie['images']['backdrops'] as $image)
                @if($loop->index < 9)
        <div class="mt-8">

            <a
                @click.prevent=" isOpen = true
                            image='{{ 'https://image.tmdb.org/t/p/original/'.$image['file_path'] }}'
                            "
                href="#"
            >
                <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$image['file_path'] }}" alt="image1" class="hover:opacity-75 transition ease-in-out duration-150">
            </a>

        </div>
                    @else
                    @break

                @endif
            @endforeach




        </div>
        <div x-show="isOpen"
            style="background-color: rgba(0, 0, 0, .5);"
            class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
        >
            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                <div class="bg-gray-900 rounded">
                    <div class="flex justify-end pr-4 pt-2">
                        <button
                            @click="isOpen = false"
                            @keydown.escape.window="isOpen = false"
                            class="text-3xl leading-none hover:text-gray-300">&times;
                        </button>
                    </div>
                    <div class="modal-body px-8 py-8">
                       <img :src="image" alt="poster">
                    </div>
                </div>
            </div>
        </div>



    </div>


</div>



@endsection
