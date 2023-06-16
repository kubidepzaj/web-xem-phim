<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloundflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../css/navbar.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- multiple genre --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">

    {{-- hien thi thong bao aleart --}}
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>


    <!-- Scripts -->

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">

            @if(Auth::user())
                @include('layouts.navbar')
            @endif

            @yield('content')
        </main>
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript">
        $(document).ready( function () {
            $('#tableMovie').DataTable();
        } );
            function ChangeToSlug()
                {

                    var slug;

                    //Lấy text từ thẻ input title
                    slug = document.getElementById("slug").value;
                    slug = slug.toLowerCase();
                    //Đổi ký tự có dấu thành không dấu
                        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                        slug = slug.replace(/đ/gi, 'd');
                        //Xóa các ký tự đặt biệt
                        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                        //Đổi khoảng trắng thành ký tự gạch ngang
                        slug = slug.replace(/ /gi, "-");
                        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                        slug = slug.replace(/\-\-\-\-\-/gi, '-');
                        slug = slug.replace(/\-\-\-\-/gi, '-');
                        slug = slug.replace(/\-\-\-/gi, '-');
                        slug = slug.replace(/\-\-/gi, '-');
                        //Xóa các ký tự gạch ngang ở đầu và cuối
                        slug = '@' + slug + '@';
                        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                        //In slug ra textbox có id “slug”
                    document.getElementById('convert_slug').value = slug;
                }

            </script>
            <script type="text/javascript">
                $('.order_position').sortable({

                    placeholder: 'ui-state-hightlight',
                    update: function (event,ui) {
                        var array_id = [];
                        $('.order_position tr').each(function() {
                            array_id.push($(this).attr('id'));
                        })
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{route('resorting_category')}}",
                            method: "POST",
                            data: {array_id: array_id},
                            success: function (data) {
                                alert("Sap xep thanh cong");
                            }
                        })
                    }

                })
            </script>

            <script type="text/javascript">
                $('.select-year').change(function(){
                    var year = $(this).find(':selected').val();
                    var movie_id = $(this).attr('id');

                    $.ajax({
                        url:"{{url('/update-movie-year')}}",
                        method:"GET",
                        data:{year:year,movie_id:movie_id},
                        success:function(){
                            alert('Thay đổi năm phim theo năm' +year+ ' thành công');
                        }
                    });
                })
            </script>
            <script type="text/javascript">
                $('.select-topview').change(function(){
                    var topview = $(this).find(':selected').val();
                    var movie_id = $(this).attr('id');

                    if(topview==0) {
                        var text = "Ngày";
                    } else if(topview==1) {
                        var text = "Tuần";
                    }else{
                        var text = "Tháng";
                    }
                    $.ajax({
                        url:"{{url('/update-topview')}}",
                        method:"GET",
                        data:{topview:topview,movie_id:movie_id},
                        success:function(){
                            alert('Thay đổi phim theo topview' +text+ ' thành công');
                        }
                    });
                })
            </script>

            {{-- multiple genre --}}
            <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
            <script>
                new MultiSelectTag('genre')  // id
            </script>

            {{-- tu movie => tap phim --}}
            <script type="text/javascript">
                $('.select-movie').change(function(){
                    var id = $(this).val();
                    $.ajax({
                        url:"{{url('/select-movie')}}",
                        method:"GET",
                        data:{id:id},
                        success:function(data)
                        {
                            if (data === '') {
                                // Swal.fire('Thông báo', 'Phim đã được thêm hết số tập', 'success');
                                alert('Phim đã được thêm hết số tập');
                                $('#show_episode').empty();
                            } else {
                                // $('#missing-episodes-message').empty();
                                $('#show_episode').html(data);
                            }
                        }

                    });
                    $('#form_episode').submit(function(event) {
                        var selectedEpisode = $('#show_episode').val();
                        var linkPhim = $('#link').val();

                        if (selectedEpisode === '---Chọn tập phim---' && linkPhim.trim() === '') {
                            event.preventDefault(); // Ngăn chặn submit form

                            Swal.fire('Thông báo', 'Chưa điền cả link phim và tập phim', 'error');
                        } else if (selectedEpisode === '---Chọn tập phim---') {
                            event.preventDefault(); // Ngăn chặn submit form

                            Swal.fire('Thông báo', 'Vui lòng chọn tập phim', 'error');
                        } else if (linkPhim.trim() === '') {
                            event.preventDefault(); // Ngăn chặn submit form

                            Swal.fire('Thông báo', 'Bắt buộc phải điền link phim', 'error');
                        }
                    });
                })
            </script>

            {{-- chon phim bo hoac phim le, bo ->duoc nhap, le auto = 1 --}}

            <script>
                $(document).ready(function() {
                    // Lắng nghe sự kiện thay đổi của trường "Danh Mục"
                    $('#category-select').change(function() {
                        var selectedCategory = $(this).val();
                        var episodeInput = $('#episode-input');

                        // Kiểm tra nếu danh mục là phim lẻ
                        if (selectedCategory == 16) {
                            episodeInput.val('1'); // Mặc định là 1 tập
                            episodeInput.prop('readonly', true); // Không cho phép chỉnh sửa
                        } else {
                            episodeInput.val(''); // Xóa giá trị
                            episodeInput.prop('readonly', false); // Cho phép chỉnh sửa
                        }
                    });
                });
                </script>
    </div>
</body>
</html>
