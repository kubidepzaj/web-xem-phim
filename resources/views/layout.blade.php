<!DOCTYPE html>
<html lang="vi">
   <head>
      <meta charset="utf-8" />
      <meta content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
      <meta name="theme-color" content="#234556">
      <meta http-equiv="Content-Language" content="vi" />
      <meta content="VN" name="geo.region" />
      <meta name="DC.language" scheme="utf-8" content="vi" />
      <meta name="language" content="Việt Nam">
      <meta name="csrf-token" content="{{csrf_token()}}" />

      <link rel="shortcut icon" href="{{asset('uploads/logos/'.$info->logo)}}" type="image/x-icon" />
      <meta name="revisit-after" content="1 days" />
      <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
      <title>{{$meta_title}}</title>
      <meta name="description" content="" />

      <link rel="canonical" href="{{Request::url()}}">
      <link rel="next" href="" />
      <meta property="og:locale" content="vi_VN" />
      <meta property="og:title" content="{{$meta_title}}" />
      <meta property="og:description" content="" />
      <meta property="og:url" content="{{Request::url()}}" />
      <meta property="og:site_name" content="{{$meta_title}}" />
      <meta property="og:image" content="" />
      <meta property="og:image:width" content="300" />
      <meta property="og:image:height" content="55" />
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

      <link rel='dns-prefetch' href='//s.w.org' />

      <link rel='stylesheet' id='bootstrap-css' href={{asset('css/bootstrap.min.css?ver=5.7.2')}} media='all' />
      <link rel='stylesheet' id='style-css' href={{asset('css/style.css?ver=5.7.2')}} media='all' />
      <link rel='stylesheet' id='wp-block-library-css' href={{asset('css/style.min.css?ver=5.7.2')}} media='all' />

      <!-- Thư viện SweetAlert2 CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css">

      <!-- Thư viện SweetAlert2 JavaScript -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.js"></script>

      <script src="https://kit.fontawesome.com/c69fb77522.js" crossorigin="anonymous"></script>

      <script type='text/javascript' src={{asset('js/jquery.min.js?ver=5.7.2')}} id='halim-jquery-js'></script>
      <style type="text/css" id="wp-custom-css">
         .textwidget p a img {
         width: 100%;
         }
      </style>
      <style>#header .site-title {background: url('{{asset('uploads/logos/'.$info->logo)}}') no-repeat top left;background-size: contain;text-indent: -9999px;}</style>
   </head>

   <body class="home blog halimthemes halimmovies" data-masonry="">
      <header id="header">
         <div class="container">
            <div class="row" id="headwrap">
               <div class="col-md-3 col-sm-6 slogan">
                  <p class="site-title">
                     <a class="logo" href="" title="phim hay ">
                  </a>
                  </p>
               </div>
               <div class="col-md-5 col-sm-6 halim-search-form hidden-xs">
                  <div class="header-nav">
                     <div class="col-xs-12">
                           <style type="text/css">
                              #result-search {
                                 list-style: none;
                                 position: absolute;
                                 z-index: 9999;
                                 background: #1b2d3c;
                                 width: 94%;
                                 padding: 10px;
                                 margin: 1px;
                              }
                           </style>
                           <div class="form-group form-search">
                              <div class="input-group col-xs-12">
                                 <form id="search-form-pc" name="search" role="search" action="{{route('search')}}" method="GET">
                                    <div class="input-with-button">
                                    <input id="search-layout" type="text" name="search" class="form-control" placeholder="Tìm kiếm..." autocomplete="off" required>
                                          <button class="search-button" type="submit">
                                       <i class="fa-solid fa-magnifying-glass">
                                       </i>
                                    </button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        <ul class="list-group" id="result-search" style="display: none;"></ul>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 hidden-xs">
                  @if (!Session::get('login_publisher'))
                     <div id="get-bookmark" class="box-shadow">
                        <a href="{{route('dang-ky')}}" class="button">Đăng ký</a>
                     </div>
                     <div id="get-bookmark" class="box-shadow">

                        <a href="{{route('dang-nhap')}}" class="button">Đăng nhập</a>
                     </div>
                  @else
                  <style>
                     .btn-group-1{
                        position: relative;
                     }
                     .btn.dropdown-toggle ~ .menu02,
                     ul.menu02 {
                        background-color: rgb(244, 244, 244);
                        background-color: rgb(255, 255, 255);
                        border: 0 solid rgb(66, 133, 244);
                        box-shadow: 0px 0px 3px rgba(25, 25, 25, 0.3);
                        top: 0px;
                        margin: 0px;
                        padding: 0px;
                     }
                     ul.menu02 {
                        position: absolute;
                        right: 0;
                        width: 100%;
                     }
                     .menu02 .dropdown-plus-title {
                        width: 100%;
                        color: #fff;
                        padding: 6px 12px;
                        border: 0 solid rgb(173, 173, 173);
                        border-bottom-width: 2px;
                        cursor: pointer;
                     }
                     .dropdown-menu .divider {
                       margin: 0;
                     }
                     ul.menu02 .dropdown-plus-title {
                        padding-top: 10px;
                        padding-bottom: 10px;
                        line-height: 20px;
                     }
                     @media (min-width: 768px) {
                        ul.menu02 .dropdown-plus-title {
                           padding-top: 15px;
                           padding-bottom: 15px;
                        }
                     }
                     @media (min-width: 768px) {
                        ul.menu02 {
                           width: auto;
                        }
                     }
                  </style>
                 <div class="btn-group">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                      Xin chào <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu menu02" role="menu">
                      <li class="dropdown-plus-title">
                          {{Session::get('name')}}
                          <b class="pull-right glyphicon glyphicon-chevron-up"></b>
                      </li>
                      <li><a href="#">Thông tin</a></li>
                      <li>
                          <a href="#!" onclick="toggleBookmarkList(event)">
                              Bookmarks
                              <span id="movieCount" class="count">{{$bookmark->count()}}</span>
                          </a>
                      </li>
                      <li><a href="#">Nâng cấp tài khoản</a></li>
                      <li class="divider"></li>
                      <li><a href="{{route('dang-xuat')}}">Đăng xuất</a></li>
                  </ul>
              </div>

              <div id="bookmark-list" class="bookmark-list-on-pc">
               <div class="halim-bookmark-box">
                  <div class="section-bar clearfix">
               <h3 class="section-title">
                  <span>Tủ phim</span>
               </h3>
               <span class="remove-all-bookmark box-shadow">x Remove all</span>
            </div>
            <ul class="halim-bookmark-lists">
               @foreach ($bookmark as $key =>$bookmark_list)
                  <li class="bookmark-list" id="bookmark-{{$bookmark_list->id}}">
                     <a href="{{route('movie',$bookmark_list->movie->slug)}}">
                           <img src="{{asset('uploads/movies/'.$bookmark_list->movie->image)}}" alt="{{$bookmark_list->movie->title}}">
                           <span class="bookmark-title">{{$bookmark_list->movie->title}}</span>
                           <span class="bookmark-date">{{$bookmark_list->created_at}}</span>
                     </a>
                     <span class="remove-bookmark box-shadow" data-bookmark-id="{{$bookmark_list->id}}">x</span>
                  </li>
               @endforeach
           </ul>
                  </div>
               </div>
                  @endif
      </header>
      <div class="navbar-container">
         <div class="container">
            <nav class="navbar halim-navbar main-navigation" role="navigation" data-dropdown-hover="1">
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#halim" aria-expanded="false">
                  <span class="sr-only">Menu</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button>
                  <button type="button" class="navbar-toggle collapsed pull-right expand-search-form" data-toggle="collapse" data-target="#search-form" aria-expanded="false">
                  <span class="hl-search" aria-hidden="true"></span>
                  </button>
                  <button type="button" class="navbar-toggle collapsed pull-right get-bookmark-on-mobile">
                  Bookmarks<i class="hl-bookmark" aria-hidden="true"></i>
                  <span class="count">0</span>
                  </button>
                  <button type="button" class="navbar-toggle collapsed pull-right get-locphim-on-mobile">
                  <a href="javascript:;" id="expand-ajax-filter" style="color: #ffed4d;">Lọc <i class="fas fa-filter"></i></a>
                  </button>
               </div>
               <div class="collapse navbar-collapse" id="halim">
                  <div class="menu-menu_1-container">
                     <ul id="menu-menu_1" class="nav navbar-nav navbar-left">
                        <li class="mega"><a title="Trang Chủ" href="{{route('homepage')}}">Trang Chủ</a></li>

                        <li class="mega"><a title="" href="#!">
                           Phim Mới
                        </a></li>
                        @foreach ($category as $key =>$category_home)
                        <li class="mega"><a title="{{$category_home ->title}}" href="{{route('category', $category_home ->slug)}}">
                           {{$category_home ->title}}
                        </a></li>
                        @endforeach
                        <li class="mega dropdown">
                           <a title="Thể Loại" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Thể Loại <span class="caret"></span></a>
                           <ul role="menu" class=" dropdown-menu">
                        @foreach ($genre as $key =>$genre_home)
                        <li class="mega"><a title="{{$genre_home ->title}}" href="{{route('genre', $genre_home ->slug)}}">
                           {{$genre_home ->title}}
                        </a></li>
                        @endforeach
                           </ul>
                        </li>
                        <li class="mega dropdown">
                           <a title="Quốc Gia" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Quốc Gia <span class="caret"></span></a>
                           <ul role="menu" class=" dropdown-menu">
                        @foreach ($country as $key =>$country_home)
                        <li class="mega"><a title="{{$country_home ->title}}" href="{{route('country', $country_home ->slug)}}">
                           {{$country_home ->title}}
                        </a></li>
                        @endforeach
                           </ul>
                        </li>
                     </ul>
                  </div>
                  <ul class="nav navbar-nav navbar-left">
                     <li><a href="#" onclick="toggleFilter()">Lọc Phim</a></li>
                  </ul>
               </div>
            </nav>

         </div>
      </div>
      </div>
      <div class="container">
         <div class="row fullwith-slider" style="background: #171f27;border-bottom: 1px solid #1d2731;padding: 12px 15px; " >
            @include('pages.include.filter')
         </div>
      </div>
      <div class="container">
         @yield('content')
      </div>
      <div class="clearfix"></div>
      <footer id="footer" class="clearfix">
         <div class="container footer-columns">
            {{-- <div class="row container">
               {{-- <div class="widget about col-xs-12 col-sm-4 col-md-4">
                  <div class="footer-logo">
                     <img class="img-responsive" src="https://img.favpng.com/9/23/19/movie-logo-png-favpng-nRr1DmYq3SNYSLN8571CHQTEG.jpg" alt="Phim hay 2021- Xem phim hay nhất" />
                  </div>
                  Liên hệ: +84<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="e5958d8c888d849ccb868aa58288848c89cb868a88">[email&#160;protected]</a>
               </div>

            </div>--}}
            <div class="primary">
               <div class="columenu">
                  <div class="item">
                     <h3>Phim mới</h3>
                     <ul>
                        @foreach ($genre as $key => $genre_home)
                           @if ($key < 5)
                              <li><a href="{{route('genre', $genre_home ->slug)}}">{{ $genre_home->title }}</a></li>
                           @else
                              @break
                           @endif
                        @endforeach
                     </ul>
                  </div>
                  <div class="item">
                     <h3>Phim hay</h3>
                     <ul>
                        @foreach ($country as $key => $country_home)
                           @if ($key < 5)
                              <li><a href="{{route('country', $country_home ->slug)}}">{{ $country_home->title }}</a></li>
                           @else
                              @break
                           @endif
                        @endforeach
                     </ul>
                  </div>
                  <div class="item">
                     <h3>Thông tin</h3>
                     <ul>
                        <li>
                           <a href="#!">
                              Giới thiệu
                           </a>
                           <a href="#!">
                              Liên hệ
                           </a>
                           <a href="#!">
                              Bản quyền
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="fotlogo">
                  <div class="logo">
                     <img src="{{asset('uploads/logos/'.$info->logo)}}" alt="Phimmoi">
                  </div>
                  <div class="text"><p><a href="#!"><b>Netflix and Chill</b></a> - {{$info->description}}</p></div>
               </div>
            </div>
            <div class="copy">Copyright © by Thien</div>
            <span class="top-page">
               <a href="" id="id"></a>
            </span>
            <div class="fmenu">
               <ul id="menu-footer" class="menu">
                  <li id="menu-item-14" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-14">
                     <a href="#">
                        <i class="fab fa-facebook-f"></i>
                     </a>
                  </li>
                  <li id="menu-item-15" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-15">
                     <a href="#">
                        <i class="fab fa-twitter"></i>
                     </a>
                  </li>
                  <li id="menu-item-16" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-16">
                     <a href="#">
                        <i class="fab fa-instagram"></i>
                     </a>
                  </li>
                  <li id="menu-item-17" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-17">
                     <a href="#">
                        <i class="fab fa-youtube"></i>
                     </a>
                  </li>
               </ul>
            </div>
         </div>
      </footer>
      <div id='easy-top'></div>

      <script type='text/javascript' src={{asset('js/bootstrap.min.js?ver=5.7.2')}} id='bootstrap-js'></script>
      <script type='text/javascript' src={{asset('js/owl.carousel.min.js?ver=5.7.2')}} id='carousel-js'></script>

      <script type='text/javascript' src={{asset('js/halimtheme-core.min.js?ver=1626273138')}} id='halim-init-js'></script>


      {{-- cmt facebook --}}
      <div id="fb-root"></div>
      <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v17.0" nonce="LQbf7K2J"></script>

      {{-- sidebar topview --}}
      <script type="text/javascript">

         $(document).ready(function(){
            $.ajax({
               url:"{{url('/filter-topview-default')}}",
               method:"GET",
               success:function(data)
               {
                  $('#show-default').html(data);
               }
            });

            $('.filter-sidebar').click(function(){
            var href = $(this).attr('href');
            if (href == '#today') {
               var value = 0;
            } else if (href == '#week') {
               var value = 1;
            }
            else {
               var value = 2;
            }
            $.ajax({
               url:"{{url('/filter-topview')}}",
               method:"GET",
               data:{value:value},
               success:function(data)
               {
                  $('#show'+value).html(data);
               }
            });
         })
         })
      </script>

      {{-- search-layout --}}
      <script type="text/javascript">
         $(document).ready(function(){
            $('#search-layout').keyup(function(){
               $('#result-search').html('');
               var search = $('#search-layout').val();

               if (search!='') {
                  $('#result-search').css('display','inherit');
                  var expression = new RegExp(search,"i");
                  $.getJSON('/json_file/movies.json',function(data){
                     $.each(data, function(key, value){
                        if (value.title.search(expression) != -1) {
                           $('#result-search').append('<li class="list-group-item" style="cursor: pointer;"><img width="50" height="50" src="/uploads/movies/'+value.image+'">'+value.title+'</li>');
                        }
                     });
                  })
               } else {
                  $('#result-search').css('display','none');
               }
            })
            $('#result-search').on('click','li',function(){
               var click_text = $(this).text();
               $("#search-layout").val($.trim(click_text));
               $("#result-search").html('');
               $('#result-search').css('display','none');
            });
         })
      </script>
      {{-- lọc phim --}}
      <script>
         var isThanhLocPhimHienThi = false;
         function toggleFilter() {
               var filterContainer = document.getElementById("thanh-loc-phim");
               filterContainer.classList.toggle("show");
            }
     </script>
      {{-- bookmarks ẩn hiện--}}
      <script>
         var bookmarkList = document.getElementById("bookmark-list");
         bookmarkList.classList.add("hidden");
         function toggleBookmarkList(event) {
            event.preventDefault();
            var bookmarkList = document.getElementById("bookmark-list");
            bookmarkList.classList.toggle("hidden");
            event.stopPropagation(); // Ngăn chặn sự kiện click lan ra ngoài danh sách
         }

         document.addEventListener("click", function(event) {
            var bookmarkList = document.getElementById("bookmark-list");
            if (!bookmarkList.contains(event.target)) {
               bookmarkList.classList.add("hidden");
            }
         });
      </script>

      {{-- thong bao khi phim chưa được thêm trang watch --}}
      <script>
         function showCustomAlert() {
             Swal.fire({
                 title: "Thông báo",
                 text: "Phim đang cập nhật. Vui lòng chọn phim khác để xem.",
                 icon: "info",
                 confirmButtonText: "Đóng",
                 showCloseButton: true,
             });
         }
     </script>

     {{-- bookmark phim --}}
     <script>
         function bookmarks() {
            var movieCount = document.getElementById('movieCount');
            var count = parseInt(movieCount.innerText);
            var publisher_id = $('#bookmark').data('publisher_id');
            var movie_id = $('#bookmark').data('movie_id');
            var _token = $('input[name="_token"]').val();
            var isAdded = false; // Biến flag để kiểm tra bộ phim đã được thêm hay chưa

            // Kiểm tra xem bộ phim đã được thêm hay chưa
            // Nếu đã thêm, không tăng giá trị movieCount và hiển thị thông báo
            if (isAdded) {
               alert('Phim đã có trong tủ phim');
            } else {
               count += 1;
               movieCount.innerText = count;

               $.ajax({
                  url: "{{route('bookmark')}}",
                  method: "POST",
                  data: { publisher_id: publisher_id, movie_id: movie_id, _token: _token },
                  success: function (data) {
                  if (data == 'Fail') {
                     alert('Phim đã có trong tủ phim');
                     isAdded = true; // Đánh dấu bộ phim đã được thêm vào
                  } else {
                     alert('Thêm vào tủ phim thành công');
                  }
                  },
               });
            }
  return false;
}

     </script>

   {{-- xóa bookmark khỏi list --}}
   <script>
      document.addEventListener('DOMContentLoaded', function() {
          // Lấy tất cả các phần tử có class "remove-bookmark"
          var removeBookmarkButtons = document.getElementsByClassName('remove-bookmark');

          // Lặp qua từng nút "remove-bookmark"
          Array.from(removeBookmarkButtons).forEach(function(button) {
              // Gán sự kiện click cho từng nút
              button.addEventListener('click', function() {
                  // Lấy id của bookmark từ thuộc tính "data-bookmark-id"
                  var bookmarkId = button.getAttribute('data-bookmark-id');

                  // Gửi yêu cầu xóa đến máy chủ
                  deleteBookmark(bookmarkId);
              });
          });
      });

      function deleteBookmark(bookmarkId) {
          // Thực hiện yêu cầu xóa bookmark với bookmarkId được truyền vào
          // Sử dụng Ajax hoặc fetch để gửi yêu cầu xóa đến máy chủ

          // Ví dụ sử dụng fetch
          fetch('/bookmark/delete/' + bookmarkId, {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': '{{ csrf_token() }}' // Chỉ cần thêm nếu bạn sử dụng CSRF protection trong Laravel
              },
          })
          .then(function(response) {
              // Xử lý phản hồi từ máy chủ sau khi xóa thành công
              if (response.ok) {
                  // Xóa phần tử li tương ứng khỏi DOM
                  var bookmarkElement = document.getElementById('bookmark-' + bookmarkId);
                  if (bookmarkElement) {
                      bookmarkElement.remove();
                  }

                  // Giảm giá trị movieCount xuống 1
                  var movieCount = document.getElementById('movieCount');
              }
          })
          .catch(function(error) {
              console.log(error);
          });
      }
   </script>
   {{-- xóa tất cả bookmark --}}
   <script>
      document.addEventListener('DOMContentLoaded', function() {
          // Lấy nút "remove-all-bookmark"
          var removeAllBookmarkButton = document.querySelector('.remove-all-bookmark');

          // Gán sự kiện click cho nút
          removeAllBookmarkButton.addEventListener('click', function() {
              // Gửi yêu cầu xóa tất cả bookmark đến máy chủ
              deleteAllBookmarks();
          });
      });

      function deleteAllBookmarks() {
          // Thực hiện yêu cầu xóa tất cả bookmark
          // Sử dụng Ajax hoặc fetch để gửi yêu cầu xóa đến máy chủ

          // Ví dụ sử dụng fetch
          fetch('/bookmark/delete-all', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': '{{ csrf_token() }}' // Chỉ cần thêm nếu bạn sử dụng CSRF protection trong Laravel
              },
          })
          .then(function(response) {
              // Xử lý phản hồi từ máy chủ sau khi xóa thành công
              if (response.ok) {
                  // Xóa tất cả phần tử li trong ul
                  var bookmarkList = document.querySelector('.halim-bookmark-lists');
                  if (bookmarkList) {
                      bookmarkList.innerHTML = '';
                  }
              }
          })
          .catch(function(error) {
              console.log(error);
          });
      }
  </scrip>


      <style>#overlay_mb{position:fixed;display:none;width:100%;height:100%;top:0;left:0;right:0;bottom:0;background-color:rgba(0, 0, 0, 0.7);z-index:99999;cursor:pointer}#overlay_mb .overlay_mb_content{position:relative;height:100%}.overlay_mb_block{display:inline-block;position:relative}#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:600px;height:auto;position:relative;left:50%;top:50%;transform:translate(-50%, -50%);text-align:center}#overlay_mb .overlay_mb_content .cls_ov{color:#fff;text-align:center;cursor:pointer;position:absolute;top:5px;right:5px;z-index:999999;font-size:14px;padding:4px 10px;border:1px solid #aeaeae;background-color:rgba(0, 0, 0, 0.7)}#overlay_mb img{position:relative;z-index:999}@media only screen and (max-width: 768px){#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:400px;top:3%;transform:translate(-50%, 3%)}}@media only screen and (max-width: 400px){#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:310px;top:3%;transform:translate(-50%, 3%)}}</style>

      <style>
         #overlay_pc {
         position: fixed;
         display: none;
         width: 100%;
         height: 100%;
         top: 0;
         left: 0;
         right: 0;
         bottom: 0;
         background-color: rgba(0, 0, 0, 0.7);
         z-index: 99999;
         cursor: pointer;
         }
         #overlay_pc .overlay_pc_content {
         position: relative;
         height: 100%;
         }
         .overlay_pc_block {
         display: inline-block;
         position: relative;
         }
         #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
         width: 600px;
         height: auto;
         position: relative;
         left: 50%;
         top: 50%;
         transform: translate(-50%, -50%);
         text-align: center;
         }
         #overlay_pc .overlay_pc_content .cls_ov {
         color: #fff;
         text-align: center;
         cursor: pointer;
         position: absolute;
         top: 5px;
         right: 5px;
         z-index: 999999;
         font-size: 14px;
         padding: 4px 10px;
         border: 1px solid #aeaeae;
         background-color: rgba(0, 0, 0, 0.7);
         }
         #overlay_pc img {
         position: relative;
         z-index: 999;
         }
         @media only screen and (max-width: 768px) {
         #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
         width: 400px;
         top: 3%;
         transform: translate(-50%, 3%);
         }
         }
         @media only screen and (max-width: 400px) {
         #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
         width: 310px;
         top: 3%;
         transform: translate(-50%, 3%);
         }
         }
      </style>

      <style>
         .float-ck { position: fixed; bottom: 0px; z-index: 9}
         * html .float-ck /* IE6 position fixed Bottom */{position:absolute;bottom:auto;top:expression(eval (document.documentElement.scrollTop+document.docum entElement.clientHeight-this.offsetHeight-(parseInt(this.currentStyle.marginTop,10)||0)-(parseInt(this.currentStyle.marginBottom,10)||0))) ;}
         #hide_float_left a {background: #0098D2;padding: 5px 15px 5px 15px;color: #FFF;font-weight: 700;float: left;}
         #hide_float_left_m a {background: #0098D2;padding: 5px 15px 5px 15px;color: #FFF;font-weight: 700;}
         span.bannermobi2 img {height: 70px;width: 300px;}
         #hide_float_right a { background: #01AEF0; padding: 5px 5px 1px 5px; color: #FFF;float: left;}
      </style>
   </body>
</html>
