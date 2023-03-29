<div
id="trailerCarousel"
class="relative border-8 border-gray-200 rounded-lg"
data-te-carousel-init
data-te-carousel-slide
>
<div
  class="absolute inset-x-0 bottom-0 z-[2] mx-[15%] mb-4 flex list-none justify-center p-0"
  data-te-carousel-indicators>
  @foreach ($trailers as $video)
  <button
    type="button"
    data-te-target="#trailerCarousel"
    data-te-slide-to="{{$loop->index}}"
    {{$loop->first ? 'data-te-carousel-active' : ''}}
    class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none"
></button>
  @endforeach
</div>
<div
  class="relative w-full overflow-hidden after:clear-both after:block after:content-['']">
    @foreach ($trailers as $video)
        <div
            class="relative float-left -mr-[100%] hidden w-full !transform-none opacity-0 transition-opacity duration-[600ms] ease-in-out motion-reduce:transition-none"
            data-te-carousel-fade
            data-te-carousel-item
            {{$loop->first ? 'data-te-carousel-active' : ''}}>
            <div class="embed-responsive embed-responsive-16by9 relative w-full overflow-hidden">
                <div class="player" id="{{$video['key']}}"></div>
            </div>
        </div>
    @endforeach
</div>
<button
  class="absolute top-0 bottom-0 left-0 z-[1] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-white opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-white hover:no-underline hover:opacity-90 hover:outline-none focus:text-white focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none"
  type="button"
  data-te-target="#trailerCarousel"
  data-te-slide="prev">
  <span class="inline-block h-8 w-8">
    <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke-width="1.5"
      stroke="currentColor"
      class="h-6 w-6">
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M15.75 19.5L8.25 12l7.5-7.5" />
    </svg>
  </span>
  <span
    class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]"
    >Previous</span
  >
</button>
<button
  class="absolute top-0 bottom-0 right-0 z-[1] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-white opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-white hover:no-underline hover:opacity-90 hover:outline-none focus:text-white focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none"
  type="button"
  data-te-target="#trailerCarousel"
  data-te-slide="next">
  <span class="inline-block h-8 w-8">
    <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke-width="1.5"
      stroke="currentColor"
      class="h-6 w-6">
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M8.25 4.5l7.5 7.5-7.5 7.5" />
    </svg>
  </span>
  <span
    class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]"
    >Next</span
  >
</button>
</div>
<script>
    const myCarousel = document.getElementById('trailerCarousel');
    var carousel;

    var tag = document.createElement("script");
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName("script")[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    window.addEventListener("load", function(event){

        $.when(
            $(".player").each(function() {
                initPlayer($(this).attr('id'))
            })
        ).done(function( x ) {
                carousel = new te.Carousel(myCarousel);
        });

        function initPlayer(id){
            console.log(id)
            new YT.Player(id, {
                width: '100%',
                videoId: id,
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
                });
        }

        function onPlayerReady(event) {
            //
        }

        function onPlayerStateChange(event) {
            var playerStatus = event.data;
            if (playerStatus == 1) {
                carousel.pause();
            } else {
                carousel.cycle();
            }
        }
    });

</script>
