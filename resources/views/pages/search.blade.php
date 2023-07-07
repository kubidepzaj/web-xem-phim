@extends('layout')
@section('content')
<div class="row container" id="wrapper">
            <div class="halim-panel-filter">
               <div class="panel-heading">
                  <div class="row">
                     <div class="col-xs-6">
                        {{-- <div class="yoast_breadcrumb hidden-xs"><span><span>Kết quả tìm kiếm:</div> --}}
                     </div>
                  </div>
               </div>
               <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                  <div class="ajax"></div>
               </div>
            </div>
            <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
               <section>
                  <div class="section-bar clearfix">
                     <h1 class="section-title"><span>Kết quả tìm kiếm: {{$search}}</span></h1>
                  </div>
                  <div class="halim_box">
                    <div id="halim-ajax-popular-post" class="popular-post">

                     @foreach ($movie as $key =>$category_movie)
                     {{-- <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-27021">
                        <div class="halim-item">
                           <a class="halim-thumb" href="{{route('movie',$category_movie->slug)}}" title="{{$category_movie->title}}">
                              <figure><img class="lazy img-responsive" src="{{asset('uploads/movies/'.$category_movie->image)}}" alt="{{$category_movie->title}}" title="{{$category_movie->title}}"></figure>
                              <span class="status">5/5</span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                 @if ($category_movie ->subtitle == 0)
                                    VietSub
                                 @elseif($category_movie ->subtitle == 1)
                                    Thuyết Minh
                                 @endif
                              </span>
                              <div class="icon_overlay"></div>
                              <div class="halim-post-title-box">
                                 <div class="halim-post-title ">
                                    <p class="entry-title">{{$category_movie->title}}</p>
                                    <p class="original_title">The Mire Season 1</p>
                                 </div>
                              </div>
                           </a>
                        </div>
                     </article> --}}
                        <div class="item post-37176">
                           <a href="{{route('movie',$category_movie->slug)}}" title="{{$category_movie->title}}">
                              <div class="item-link">
                                 <img src="{{asset('uploads/movies/'.$category_movie->image)}}" class="lazy post-thumb1" alt="{{$category_movie->title}}" title="{{$category_movie->title}}" />
                                 <span class="is_trailer">Trailer</span>
                              </div>
                              <h3 class="title" style="color: #fff" >{{$category_movie->title}}</h3>
                              <h5 class="title" style="color: #fff">
                                 @if(isset($category_movie->eng_name))
                                    {{$category_movie->eng_name}} ({{$category_movie->year}})
                                 @else
                                    {{$category_movie->title}} {{$category_movie->year}}
                                 @endif
                              </h5>
                           </a>
                           <div class="des-search" style="color: #9d9d9d;">
                              @if (strlen($category_movie->description)> 800)
                                 @php
                                    $description = substr($category_movie->description,0,700);
                                    echo $description.'...'
                                 @endphp
                                 @else
                                 {{$category_movie->description}}
                              @endif
                           </div>
                           <div style="float: left;">
                              <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                              <span style="width: 0%"></span>
                              </span>
                           </div>
                        </div>
                     @endforeach
                  </div>

                  <div class="clearfix"></div>
                  <div class="text-center">
                     {{-- <ul class='page-numbers'>
                        <li><span aria-current="page" class="page-numbers current">1</span></li>
                        <li><a class="page-numbers" href="">2</a></li>
                        <li><a class="page-numbers" href="">3</a></li>
                        <li><span class="page-numbers dots">&hellip;</span></li>
                        <li><a class="page-numbers" href="">55</a></li>
                        <li><a class="next page-numbers" href=""><i class="hl-down-open rotate-right"></i></a></li>
                     </ul> --}}
                     {!!$movie->links("pagination::bootstrap-4") !!}
                  </div>
               </section>
            </main>
            @include('pages.include.sidebar')
         </div>
@endsection
