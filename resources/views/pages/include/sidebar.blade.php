<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
   <div class="dt_mainmeta clearfix">
      <nav class="releases">
         <h2>Năm Phát Hành</h2>
         <ul class="releases scrolling">
            @for($year = 2000; $year <=2023;$year++)
                  <li><a title="{{$year}}" href="{{url('year/'.$year)}}">{{$year}}</a></li>
            @endfor
         </ul>
      </nav>
   </div>
   <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
      <div class="section-bar clearfix">
         <div class="section-title">
            <span>Top Views</span>
            <ul class="halim-popular-tab" role="tablist">
               <li role="presentation" class="nav-item active">
                  <a class="nav-link filter-sidebar" role="tab" data-toggle="pill" data-showpost="10" data-type="today" href="#today">Day</a>
               </li>
               <li role="presentation" class="nav-item">
                  <a class="nav-link filter-sidebar" role="tab" data-toggle="pill" data-showpost="10" data-type="week" href="#week">Week</a>
               </li>
               <li role="presentation" class="nav-item">
                  <a class="nav-link filter-sidebar" role="tab" data-toggle="pill" data-showpost="10" data-type="month" href="#month">Month</a>
               </li>
            </ul>
         </div>
      </div>
      {{-- <section class="tab-content">
         <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
            <div class="halim-ajax-popular-post-loading hidden"></div>
            <div id="halim-ajax-popular-post" class="popular-post">
               <div class="item post-37176">
                  <a href="chitiet.php" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ">
                     <div class="item-link">
                        <img src="https://ghienphim.org/uploads/GPax0JpZbqvIVyfkmDwhRCKATNtLloFQ.jpeg?v=1624801798" class="lazy post-thumb" alt="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" />
                        <span class="is_trailer">Trailer</span>
                     </div>
                     <p class="title">CHỊ MƯỜI BA: BA NGÀY SINH TỬ</p>
                  </a>
                  <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                  <div style="float: left;">
                     <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                     <span style="width: 0%"></span>
                     </span>
                  </div>
               </div>
            </div>
         </div>
      </section> --}}
      <div class="tab-content" id="pills-tabContent">
         <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
            <div class="halim-ajax-popular-post-loading hidden"></div>
            <div id="halim-ajax-popular-post" class="popular-post">
               <span id="show-default"></span>
            </div>
         </div>
         <div class="tab-pane fade" id="today" role="tabpanel" aria-labelledby="pills-home-tab">
            <div id="halim-ajax-popular-post" class="popular-post">
               <span id="show0"></span>
            </div>
         </div>
         <div class="tab-pane fade" id="week" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div id="halim-ajax-popular-post" class="popular-post">
               <span id="show1"></span>
         </div>
      </div>
         <div class="tab-pane fade" id="month" role="tabpanel" aria-labelledby="pills-contact-tab">
            <div id="halim-ajax-popular-post" class="popular-post">
               <span id="show2"></span>
            </div>
         </div>
       </div>
      <div class="clearfix"></div>
   </div>
</aside>
