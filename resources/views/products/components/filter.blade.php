    @php $categories= \App\Models\Category::orderBy('order','desc')->get(); @endphp
<div class="position-relative" style="padding:0px 40px"> 
  <div class="filter">
      <ul class="nav nav-tabs" id="myTabs">
{{--          <li class="nav-item">--}}
{{--              <a class="nav-link {{request('cat_id')  ? '' : 'active'}}"  href="{{ url()->current() }}">--}}
{{--                  <div class="image_category d-flex justify-content-center align-items-center">--}}
{{--                    <img   src="{{$category->where('name_en','all')->value('image_url') ?? "https://as2.ftcdn.net/v2/jpg/00/81/38/59/1000_F_81385977_wNaDMtgrIj5uU5QEQLcC9UNzkJc57xbu.jpg"}}" alt="category image" loading="lazy"/>--}}
{{--                  </div>--}}
{{--                  <p class="title">All</p>--}}
{{--              </a>--}}
{{--          </li>--}}
       @foreach($categories as $category)
            <li class="nav-item">
              <a class="nav-link {{request('cat_id') == $category->id ? 'active' : ''}} {{$category->name_en == 'All' && request('cat_id') == null ? 'active' : ''}}"  @if($category->name_en == 'All') href="{{ route('products') }}" @else href="{{ url()->current() }}?{{ http_build_query(['cat_id' =>$category->id]) }}" @endif>
                <div class="image_category d-flex justify-content-center align-items-center">
                    <img   src="{{$category->image_url ?? "https://as2.ftcdn.net/v2/jpg/00/81/38/59/1000_F_81385977_wNaDMtgrIj5uU5QEQLcC9UNzkJc57xbu.jpg"}}" alt="category image" loading="lazy"/>
                </div>
                <p class="title">  {{$category->name_en}}</p>
              </a>
            </li>
      @endforeach
  </ul>

  </div>
  <div class="scroll-btn left-btn"><i class="fa-solid fa-chevron-left"></i></div>
  <div class="scroll-btn right-btn"><i class="fa-solid fa-chevron-right"></i></div>


</div>

<script>
  window.addEventListener("DOMContentLoaded", function() {
  var filter = document.querySelector(".filter");
  var content = document.querySelector(".filter ul");
  var leftBtn = document.querySelector(".left-btn");
  var rightBtn = document.querySelector(".right-btn");

  function updateScrollButtons() {
    if (content.scrollWidth > filter.offsetWidth) {
      leftBtn.classList.add("show");
      rightBtn.classList.add("show");
    } else {
      leftBtn.classList.remove("show");
      rightBtn.classList.remove("show");
    }

    if (content.scrollLeft === 0) {
      leftBtn.classList.remove("show");
    }
    if (content.scrollLeft + filter.offsetWidth >= content.scrollWidth) {
      rightBtn.classList.remove("show");
    }
  }

  content.addEventListener("scroll", function() {
    updateScrollButtons();
  });

  leftBtn.addEventListener("click", function() {
    content.scrollLeft -= 100;
  });

  rightBtn.addEventListener("click", function() {
    content.scrollLeft += 100; // Adjust the scroll amount as desired
  });

  // Initial check when the page loads
  if (content.scrollLeft + filter.offsetWidth < content.scrollWidth) {
      rightBtn.classList.add("show");
    }
});
</script>
