@extends('layout')
@section('content')
<div class="row container" id="wrapper">
         <div class="halim-panel-filter">
            <div class="panel-heading">
               <div class="row">
                  <div class="col-xs-6">
                     <div class="yoast_breadcrumb hidden-xs"><span><span><a href="">Phim hay</a> » <span><a href="{{route('country',[$movie->country->slug])}}">{{$movie->country ->title}}</a> » <span class="breadcrumb_last" aria-current="page">{{$movie->title}}</span></span></span></span></div>
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
                  <div class="iframe-movie">
                     {!! $episode->movie_link !!}
                  </div>
                  <div class="button-watch">
                     <ul class="halim-social-plugin col-xs-4 hidden-xs">
                        <li class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></li>
                     </ul>
                     <ul class="col-xs-12 col-md-8">
                        <div id="autonext" class="btn-cs autonext">
                           <i class="icon-autonext-sm"></i>
                           <span><i class="hl-next"></i> Autonext: <span id="autonext-status">On</span></span>
                        </div>
                        <div id="explayer" class="hidden-xs"><i class="hl-resize-full"></i>
                           Expand
                        </div>
                        <div id="toggle-light"><i class="hl-adjust"></i>
                           Light Off
                        </div>
                        <div id="report" class="halim-switch"><i class="hl-attention"></i> Report</div>
                        <div class="luotxem"><i class="hl-eye"></i>
                           <span>1K</span> lượt xem
                        </div>
                        <div class="luotxem">
                           <a class="visible-xs-inline" data-toggle="collapse" href="#moretool" aria-expanded="false" aria-controls="moretool"><i class="hl-forward"></i> Share</a>
                        </div>
                     </ul>
                  </div>
                  <div class="collapse" id="moretool">
                     <ul class="nav nav-pills x-nav-justified">
                        <li class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></li>
                        <div class="fb-save" data-uri="" data-size="small"></div>
                     </ul>
                  </div>

                  <div class="clearfix"></div>
                  <div class="clearfix"></div>
                  <div class="title-block">
                     <a href="javascript:;" data-toggle="tooltip" title="Add to bookmark">
                        <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="37976">
                           <div class="halim-pulse-ring"></div>
                        </div>
                     </a>
                     <div class="title-wrapper-xem full">
                        <h1 class="entry-title"><a href="" title="{{$movie->title}}" class="tl">{{$movie->title}}</a></h1>
                     </div>
                  </div>
                  <div class="entry-content htmlwrap clearfix collapse" id="expand-post-content">
                     <article id="post-37976" class="item-content post-37976"></article>
                  </div>
                  <div class="clearfix"></div>
                  <div class="text-center">
                     <div id="halim-ajax-list-server"></div>
                  </div>
                  <div id="halim-list-server">
                     <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active server-1"><a href="#server-0" aria-controls="server-0" role="tab" data-toggle="tab"><i class="hl-server"></i> Vietsub</a></li>
                     </ul>
                     <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active server-1" id="server-0">
                           <div class="halim-server">
                              <ul class="halim-list-eps">
                                 @foreach($movie->episode as $key =>$sotap)
                                    <a href="{{url('xem-phim/'.$movie->slug.'/tap-'.$sotap->episode)}}">
                                       <li class="halim-episode">
                                             <span class="halim-btn halim-btn-2 {{$tap_phim==$sotap->episode ? 'active' : ''}} halim-info-1-1 box-shadow"
                                                data-post-id="37976"
                                                data-server="1"
                                                data-episode="1"
                                                data-position="first"
                                                data-embed="0"
                                                data-title="Xem phim {{$movie->title}} - Tập {{$sotap->episode}}  - vietsub + Thuyết Minh"
                                                data-h1="{{$movie->title}} - tập {{$sotap->episode}}">{{$sotap->episode}}
                                             </span>
                                       </li>
                                    </a>
                                 @endforeach
                              </ul>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="htmlwrap clearfix">
                     <div id="lightout"></div>
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
