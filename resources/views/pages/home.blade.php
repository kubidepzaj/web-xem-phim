@extends('layout')
@section('content')
<div class="row container" id="wrapper">
            <div class="halim-panel-filter">
               <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                  <div class="ajax"></div>
               </div>
            </div>
            <div id="halim_related_movies-2xx" class="wrap-slider">
               <div class="section-bar clearfix">
                  <h3 class="section-title"><span>PHIM HOT</span></h3>
               </div>
               <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                  @foreach ($hot_movie as $key =>$hot)
                     <article class="thumb grid-item post-38498">
                        <div class="halim-item">
                           <a class="halim-thumb" href="{{route('movie',$hot->slug)}}" title="{{$hot->title}}">
                              <figure><img class="lazy img-responsive" src="{{asset('uploads/movies/'.$hot->image)}}" alt="{{$hot->title}}" title="{{$hot->title}}"></figure>
                              <span class="status">
                                 @if ($hot ->quality == 0)
                                    HD
                                 @elseif($hot ->quality == 1)
                                    Full HD
                                 @elseif($hot ->quality == 2)
                                    Cam
                                 @endif
                              </span>
                             <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                              @if ($hot ->subtitle == 0)
                              VietSub
                              @elseif($hot ->subtitle == 1)
                              Thuyết Minh
                              @endif</span>
                              <div class="icon_overlay"></div>
                              <div class="halim-post-title-box">
                                 <div class="halim-post-title ">
                                    <p class="entry-title">{{$hot->title}}</p>
                                    <p class="original_title">{{$hot->eng_name}}</p>
                                 </div>
                              </div>
                           </a>
                        </div>
                     </article>
                  @endforeach
               </div>
               <script>
                  $(document).ready(function($) {
                  var owl = $('#halim_related_movies-2');
                  owl.owlCarousel({loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:6},1000: {items: 6}}})});
               </script>
            </div>
            <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
               @foreach ($category_home as $key => $cate_home)

               <section id="halim-advanced-widget-2">
                  <div class="section-heading">
                     <a href="{{route('category',$cate_home->slug)}}" title="{{$cate_home ->title}}">
                     <span class="h-text">{{$cate_home ->title}} MỚI CẬP NHẬT</span>
                     </a>
                  </div>
                  <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                     @foreach ($cate_home->movie->take(15) as $key => $movie_home)
                      <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                        <div class="halim-item">
                           <a class="halim-thumb" href="{{route('movie',$movie_home->slug)}}">
                              <figure><img class="lazy img-responsive" src="{{asset('uploads/movies/'.$movie_home->image)}}"></figure>
                              <span class="status">
                                 @if ($movie_home ->episode_count == $movie_home->number_episode)
                                    @if ($movie_home ->episode_count == 1)
                                       Hoàn Thành
                                       @else
                                       Full ({{$movie_home ->episode_count}}/{{$movie_home->number_episode}}) Tập
                                    @endif

                                 @elseif($movie_home ->episode_count == 0 && $movie_home->number_episode == 1)
                                    Đang Cập Nhật
                                 @elseif($movie_home ->episode_count == 0 && $movie_home->number_episode != 1)
                                    Coming soon
                                 @else
                                     Tập {{$movie_home ->episode[0]->episode}}
                                 @endif
                              </span>
                              <span class="episode">
                                 <i class="fa fa-play" aria-hidden="true"></i>
                                 @if ($movie_home ->subtitle == 0)
                                    VietSub
                                 @elseif($movie_home ->subtitle == 1)
                                    Thuyết Minh
                                 @endif
                              </span>
                              <div class="icon_overlay"></div>
                              <div class="halim-post-title-box">
                                 <div class="halim-post-title ">
                                    <p class="entry-title">{{$movie_home ->title}}</p>
                                    <p class="original_title">
                                    @if (isset($movie_home->eng_name))
                                       {{$movie_home->eng_name}}
                                    @else
                                       {{$movie_home->title}}
                                    @endif</p>
                                 </div>
                              </div>
                           </a>
                        </div>
                     </article>
                     @endforeach
                  </div>
               </section>
               <div class="clearfix"></div>
               @endforeach
            </main>
            @include('pages.include.sidebar')
         </div>
@endsection
