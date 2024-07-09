<div class="col-lg-3">
   <!-- <div class="shop-widget-promo">
        <a href="#"><img src="{{ asset('front/assets/images/promo/shop/01.jpg') }}" alt="promo"></a>
    </div> -->
  <!--  <div class="shop-widget">
        <h6 class="shop-widget-title">فیلتر براساس قیمت</h6>
        <form action="?max_price={{request()->input('max_price')}}&min_price={{ request()->input('min_price') }}">
            <div class="shop-widget-group">
                <input name="min_price" type="text" placeholder="کم - 00" value="0">
                <input name="max_price" type="text" placeholder="بیشتر - 50" value="0">
            </div>
            <button class="shop-widget-btn">
                <i class="fas fa-search"></i>
                <span>اعمال</span>
            </button>
        </form>
    </div> -->

  <!--  <div class="shop-widget">
        <h6 class="shop-widget-title">فیلتر براساس تگ</h6>
        <form>
            <ul class="shop-widget-list">
                <li>
                    <div class="shop-widget-content">
                        <input type="checkbox" id="tag1">
                        <label for="tag1">جدیدترین ها</label>
                    </div>
                    <span class="shop-widget-number">(13)</span>
                </li>
                <li>
                    <div class="shop-widget-content">
                        <input type="checkbox" id="tag2">
                        <label for="tag2">فروش</label>
                    </div>
                    <span class="shop-widget-number">(28)</span>
                </li>
                <li>
                    <div class="shop-widget-content">
                        <input type="checkbox" id="tag3">
                        <label for="tag3">امتیاز</label>
                    </div>
                    <span class="shop-widget-number">(35)</span>
                </li>
                <li>
                    <div class="shop-widget-content">
                        <input type="checkbox" id="tag4">
                        <label for="tag4">ویژه ها</label>
                    </div>
                    <span class="shop-widget-number">(47)</span>
                </li>
                <li>
                    <div class="shop-widget-content">
                        <input type="checkbox" id="tag5">
                        <label for="tag5">تخفیفی</label>
                    </div>
                    <span class="shop-widget-number">(59)</span>
                </li>
            </ul>
            <button class="shop-widget-btn">
                <i class="far fa-trash-alt"></i>
                <span>پاک کردن فیلتر</span>
            </button>
        </form>
    </div> -->
    <div class="shop-widget">
        <div class="account-title">
            <h6>برندها</h6>

        </div>
        <form>
            <!-- <input class="shop-widget-search" type="text" placeholder="جستجو ..."> -->
            <ul class="shop-widget-list shop-widget-scroll">

                @foreach(\App\Models\Brand::get() as $brand)
                    <li>
                        <div class="shop-widget-content">
                            <!--  <input type="checkbox" id="cate4"> -->
                            <a rel="nofollow" href="{{ route('indexByBrand',['brand'=>$brand->id,'slug'=>slugMaker($brand->name)]) }}">  <label for="cate4">{{ $brand->name }}</label> </a>
                        </div>

                    </li>
                @endforeach


            </ul>
        </form>
    </div>
    <div class="shop-widget">
        <div class="account-title">
            <h6>دسته ها</h6>

        </div>
        <form>
           <!-- <input class="shop-widget-search" type="text" placeholder="جستجو ..."> -->
            <ul class="shop-widget-list shop-widget-scroll">

                @foreach(\App\Models\Category::where('type','product')->get() as $category)
                <li>
                    <div class="shop-widget-content">
                      <!--  <input type="checkbox" id="cate4"> -->
                       <a rel="nofollow" href="{{ route('indexByCategory',['category'=>$category->id,'slug'=>slugMaker($category->name)]) }}">  <label for="cate4">{{ $category->name }}</label> </a>
                    </div>

                </li>
                @endforeach


            </ul>

        </form>
    </div>
</div>

<style>
    .d
    {
        color: #e0dfdf;
    }

</style>