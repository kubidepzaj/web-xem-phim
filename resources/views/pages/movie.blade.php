@extends('layout')
@section('content')
<div class="row container" id="wrapper">
            <div class="halim-panel-filter">
               <div class="panel-heading">
                  <div class="row">
                     <div class="col-xs-6">
                        <div class="yoast_breadcrumb hidden-xs"><span><span><a href="{{route('category', $movie->category->slug)}}">{{$movie->category->title}}</a> » <span><a href="{{route('country', $movie->country->slug)}}">{{$movie->country->title}}</a> » <span class="breadcrumb_last" aria-current="page">{{$movie->title}}</span></span></span></span></div>
                     </div>
                  </div>
               </div>
               <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                  <div class="ajax"></div>
               </div>
            </div>
            <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
               <section id="content" class="test">
                  <div class="clearfix wrap-content">

                     <div class="halim-movie-wrapper">
                        <div class="title-block">
                           <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                              <div class="halim-pulse-ring"></div>
                           </div>
                           <div class="title-wrapper" style="font-weight: bold;">
                              Bookmark
                           </div>
                        </div>
                        <div class="movie_info col-xs-12">
                           <div class="movie-poster col-md-3">
                              <img class="movie-thumb" src="{{asset('uploads/movies/'.$movie->image)}}" alt="{{$movie->title}}" alt="GÓA PHỤ ĐEN">
                              <div class="bwa-content">
                                 <div class="loader"></div>
                                    @if (isset($episode_first->episode))
                                       <a href="{{url('xem-phim/'.$movie->slug.'/tap-'.$episode_first->episode)}}" class="bwac-btn">
                                       @else
                                       <a href="#!" class="bwac-btn">
                                    @endif
                                 <i class="fa fa-play"></i>
                                 </a>
                              </div>
                           </div>
                           <div class="film-poster col-md-9">
                              <h1 class="movie-title title-1" style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">{{$movie->title}}</h1>
                              <h2 class="movie-title title-2" style="font-size: 12px;">Black Widow (2021)</h2>
                              <div class="slimScrollDiv">
                              <ul class="list-info-group">
                                 <li class="list-info-group-item"><span>Trạng thái</span> :
                                    <span class="quality">
                                       @if ($movie ->quality == 0)
                                          HD
                                       @elseif($movie ->quality == 1)
                                          Full HD
                                       @elseif($movie ->quality == 2)
                                          Cam
                                       @endif
                                    </span>
                                    <span class="episode">
                                       @if ($movie ->subtitle == 0)
                                          VietSub
                                       @elseif($movie ->subtitle == 1)
                                          Thuyết Minh
                                       @endif
                                    </span>
                                 </li>
                                 @if (($movie->number_episode)!= 1)
                                    <li class="list-info-group-item"><span>Tập phim</span> :
                                       @if (count($movie->episode) == 0)
                                          Đang Cập Nhật
                                       @else
                                          {{count($movie->episode)}}/{{$movie->number_episode}} Tập
                                       @endif
                                    </li>
                                    @elseif(($movie->number_episode)== 1 && count($movie->episode) == 0)
                                       <li class="list-info-group-item"><span>Tập phim</span> :
                                          Đang Cập Nhật
                                    @elseif(($movie->number_episode)== 1 && count($movie->episode) == 1)
                                    <li class="list-info-group-item"><span>Tập phim</span> :
                                          Hoàn Thành
                                 @endif

                                 @if (isset($movie->time))
                                    <li class="list-info-group-item"><span>Thời lượng</span> : {{$movie->time}}</li>
                                 @endif
                                 @if (isset($movie->year))
                                    <li class="list-info-group-item"><span>Sản xuất năm</span> : <a href="{{url('year/'.$movie->year)}}" rel="tag">{{$movie->year}}</a></li>
                                 @endif
                                 <li class="list-info-group-item">
                                    <span>Thể loại</span> :
                                       <a href="{{route('category', $movie->category->slug)}}" rel="category tag">
                                          {{$movie->category->title}}
                                       </a>
                                       @if(count($movie->movie_genre) > 0)
                                          @php
                                             $hasItem = false;
                                          @endphp
                                          @foreach ($movie->movie_genre as $key => $item)
                                             @if ($item->title)
                                                @php
                                                   $hasItem = true;
                                                @endphp
                                                @if ($hasItem)
                                                   ,
                                                @endif
                                                <a href="{{route('genre', $item->slug)}}" rel="category tag">
                                                   {{$item->title}}
                                                </a>
                                             @endif
                                          @endforeach
                                       @endif

                                 </li>
                                 <li class="list-info-group-item"><span>Quốc gia</span> : <a href="{{route('country',$movie->country->slug)}}" rel="tag">{{$movie->country->title}}</a></li>
                                 <li class="list-info-group-item"><span>Đạo diễn</span> : <a class="director" rel="nofollow" href="https://phimhay.co/dao-dien/cate-shortland" title="Cate Shortland">Cate Shortland</a></li>
                                 <li class="list-info-group-item last-item" style="-overflow: hidden;-display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-flex: 1;-webkit-box-orient: vertical;"><span>Diễn viên</span> : <a href="" rel="nofollow" title="C.C. Smiff">C.C. Smiff</a>, <a href="" rel="nofollow" title="David Harbour">David Harbour</a>, <a href="" rel="nofollow" title="Erin Jameson">Erin Jameson</a>, <a href="" rel="nofollow" title="Ever Anderson">Ever Anderson</a>, <a href="" rel="nofollow" title="Florence Pugh">Florence Pugh</a>, <a href="" rel="nofollow" title="Lewis Young">Lewis Young</a>, <a href="" rel="nofollow" title="Liani Samuel">Liani Samuel</a>, <a href="" rel="nofollow" title="Michelle Lee">Michelle Lee</a>, <a href="" rel="nofollow" title="Nanna Blondell">Nanna Blondell</a>, <a href="" rel="nofollow" title="O-T Fagbenle">O-T Fagbenle</a></li>
                              </ul>
                           </div>
                              <div class="movie-trailer hidden"></div>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div id="halim_trailer"></div>
                     <div class="clearfix"></div>
                     <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
                     </div>
                     <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                           <article id="post-38424" class="item-content">
                              <p>Phim <b> {{$movie->title}}</b> {{$movie->description}}</p>
                           </article>
                        </div>

                  </div>
                  <div class="entry-content htmlwrap clearfix">
                     <div class="video-item halim-entry-box">
                        <article id="post-38424" class="item-content">
                           <h5>Từ Khoá Tìm Kiếm:</h5>
                           <ul>

                              @if ($movie->tags!=NULL)
                                 @php
                                    $tags = array();
                                    $tags = explode(',', $movie ->tags);
                                 @endphp
                                 @foreach($tags as $key =>$tags)
                                 <li> <a href="{{url('tags/'.$tags)}}">{{$tags}}</a> </li>
                                 @endforeach
                                 @else
                                    <li> {{$movie->title}}</li>
                              @endif
                           </ul>
                        </article>
                     </div>
               </div>
               <div class="entry-content htmlwrap clearfix" style="background: white">
                  <div class="video-item halim-entry-box">
                     <article id="post-38424" class="item-content">
                        @php
                           $current_url = Request::url();
                        @endphp
                           <div class="fb-comments" data-href="{{$current_url}}" data-width="100%" data-numposts="10" data-colorscheme="light"></div>

                     </article>
                  </div>
            </div>
               </section>
               <section class="related-movies">
                  <div id="halim_related_movies-2xx" class="wrap-slider">
                     <div class="section-bar clearfix">
                        <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
                     </div>
                     <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                        @foreach ($related as $key =>$related_movie)
                        <article class="thumb grid-item post-38498">
                           <div class="halim-item">
                              <a class="halim-thumb" href="chitiet.php" title="{{$related_movie->title}}">
                                 <figure><img class="lazy img-responsive" src="{{asset('uploads/movies/'.$related_movie->image)}}" alt="{{$related_movie->title}}" title="{{$related_movie->title}}"></figure>
                                 <span class="status">
                                    @if ($related_movie ->quality == 0)
                                       HD
                                    @elseif($related_movie ->quality == 1)
                                       Full HD
                                    @elseif($related_movie ->quality == 2)
                                       Cam
                                    @endif
                                 </span>
                                 <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>Vietsub</span>
                                 <div class="icon_overlay"></div>
                                 <div class="halim-post-title-box">
                                    <div class="halim-post-title ">
                                       <p class="entry-title">{{$related_movie->title}}</p>
                                       <p class="original_title">Monkey King: The One And Only</p>
                                    </div>
                                 </div>
                              </a>
                           </div>
                        </article>
                        @endforeach
                     </div>
                     <script>
                        jQuery(document).ready(function($) {
                        var owl = $('#halim_related_movies-2');
                        owl.owlCarousel({loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:4},1000: {items: 4}}})});
                     </script>
                  </div>
               </section>
            </main>
            @include('pages.include.sidebar')
         </div>
@endsection
