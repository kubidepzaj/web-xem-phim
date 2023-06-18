<div id="thanh-loc-phim" class="filter-container">
    <form class="form-filter" method="GET" action="{{route('filter')}}">
       <div class="filter-item">
          <select name="order" id="order" class="input form-control">
             <option value="">Sắp xếp</option>
             <option value="publish_date">Ngày đăng</option>
             <option value="publish_year">Năm sản xuất</option>
             <option value="name_a_z">Tên phim</option>
             <option value="watch_views">Lượt xem</option>
          </select>
       </div>
       <div class="filter-item">
          <select name="genre" id="genre" class="input form-control">
             <option value="">Thể loại</option>
             @foreach ($genre as $key =>$genre_filter)
             <option {{(isset($_GET['genre']) && $_GET['genre'] ==$genre_filter->id) ? 'selected' : ''}} value="{{$genre_filter->id}}">{{$genre_filter ->title}}</option>
             @endforeach
          </select>
       </div>
       <div class="filter-item">
          <select name="country" id="country" class="input form-control">
             <option value="">Quốc gia</option>
             @foreach ($country as $country_filter)
             <option {{(isset($_GET['country']) && $_GET['country'] ==$country_filter->id) ? 'selected' : ''}} value="{{$country_filter->id}}">{{$country_filter ->title}}</option>
             @endforeach
          </select>
       </div>
       <div class="filter-item">
            @php
                if (isset($_GET['year'])) {
                    $year = $_GET['year'];
                }
                else {
                    $year = Null;
                }
            @endphp
             {!!Form::selectYear('year',2000,2023,$year,['class'=>'form-control','placeholder' => 'Năm']) !!}
       </div>
       <input type="submit" class="btn btn-success" value="Lọc phim">
    </form>
 </div>
