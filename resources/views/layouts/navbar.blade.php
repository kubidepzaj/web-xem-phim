<nav class="main-menu">
            <ul>
                <li>
                    <a href="{{route('home')}}">
                        <i class="fa fa-home fa-2x"></i>
                        <span class="nav-text">
                           Trang Chủ
                        </span>
                    </a>

                </li>

                <li class="has-subnav">
                    <a href="{{route('category.index')}}">
                       <i class="fa fa-comments fa-2x"></i>
                        <span class="nav-text">
                            Danh Mục Phim
                        </span>
                    </a>

                </li>

                <li class="has-subnav">
                    <a href="{{route('genre.index')}}">
                        <i class="fa fa-globe fa-2x"></i>
                        <span class="nav-text">
                            Thể Loại
                        </span>
                    </a>

                </li>

                <li class="has-subnav">
                    <a href="{{route('country.index')}}">
                       <i class="fa fa-camera-retro fa-2x"></i>
                        <span class="nav-text">
                            Quốc Gia
                        </span>
                    </a>

                </li>
                <li>
                    <a href="{{route('movie.index')}}">
                        <i class="fa fa-film fa-2x"></i>
                        <span class="nav-text">
                            Phim
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('episode.index')}}">
                        <i class="fa fa-book fa-2x"></i>
                        <span class="nav-text">
                           Tập Phim
                        </span>
                    </a>
                </li>
        </nav>

