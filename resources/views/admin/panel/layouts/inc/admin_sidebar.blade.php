<div id="sidebar-menu">

    <ul id="side-menu">

        <li class="menu-title mt-2"> تجارت الکترونیک </li>

        <li>
            <a href="{{ route('dashboard') }}">   <i data-feather="airplay"></i> <span> داشبورد </span>  </a>
        </li>

        <li>

            <a href="#sidebarEcommerce" data-bs-toggle="collapse">

                <i data-feather="shopping-cart"></i>
                <span> فروشگاه  </span>

                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarEcommerce">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{ route('products.index') }}">
                            محصولات
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('orders.index') }}">   سفارش‌ها  </a>
                    </li>

                    <li>

                        <a href="{{ route('brands.index') }}">  برند ها </a>

                    </li>


                    <li>
                        <a href="{{ route('categories.index') }}"> دسته بندی  </a>
                    </li>

                    <li>
                        <a href="{{ route('tags.index') }}">  برچسب   </a>
                    </li>

                    <li>

                        <a href="{{ route('supplier.index') }}">   تامین کنندگان </a>


                    </li>

                    <li>

                        <a href="{{ route('coupons.index') }}">   کوپن ها  </a>

                    </li>

                </ul>
            </div>

        </li>

        <li>
            <a href="#sidebarUsers" data-bs-toggle="collapse">

                <i data-feather="user-plus"></i>
                <span> کاربران  </span>

                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarUsers">
                <ul class="nav-second-level">

                    <li>
                        <a href="{{ route('user.index') }}"> لیست کاربران  </a>
                    </li>


                </ul>
            </div>
        </li>

        <!--
<li>
<a href="#sidebarAccounting" data-bs-toggle="collapse">

    <i class="mdi mdi-calculator"></i>
    <span> حسابداری  </span>

    <span class="menu-arrow"></span>
</a>
<div class="collapse" id="sidebarAccounting">
    <ul class="nav-second-level">

        <li>
            <a href="{{ route('stock.create') }}">  ثبت برداشت </a>
        </li>

        <li>
            <a href="{{ route('customers.index') }}"> صدور فاکتور </a>
        </li>





    </ul>
</div>
</li> -->




        <li class="menu-title mt-2"> وبلاگ </li>

        <li>
            <a href="#sidebarBlog" data-bs-toggle="collapse">
                <i class="mdi mdi-notebook-outline"></i>

                <span> مقالات </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarBlog">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{ route('posts.index') }}">مدیریت مقالات</a>
                    </li>
                    <li>
                        <a href="{{ route('posts.create') }}">  افزودن مقاله  </a>
                    </li>
                    <li>
                        <a href="{{ route('blogCategories.index') }}">  دسته بندی  </a>
                    </li>
                    <li>
                        <a href="{{ route('blogTags.index') }}">  برچسب    </a>
                    </li>

                </ul>
            </div>
        </li>

        <li>
            <a href="#sidebarPages" data-bs-toggle="collapse">
                <i class="mdi mdi-book-outline"></i>
                <span> صفحات </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarPages">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{ route('page.index') }}"> مدیریت صفحات </a>
                    </li>
                    <li>
                        <a href="{{ route('page.create') }}"> افزودن صفحه </a>
                    </li>


                </ul>
            </div>
        </li>


        <li class="menu-title mt-2"> چندرسانه ای </li>


        <li>
            <a href="#sidebarMultimedia" data-bs-toggle="collapse">
                <i class="mdi mdi-album"></i>
                <span> رسانه </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarMultimedia">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{ route('slider.index') }}">اسلایدر</a>
                    </li>
                    <li>
                        <a href="{{ route('multimedia.index') }}">  فایل</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="menu-title mt-2"> مدیریت </li>

        <li>
            <a href="#sidebarSystem" data-bs-toggle="collapse">
                <i class="mdi mdi-application-settings"></i>
                <span>  سیستم </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarSystem">
                <ul class="nav-second-level">

                    <li>
                        <a href="{{ route('barcode') }}">   بارکدساز  </a>

                    </li>
                    <li>
                        <a href="{{ route('menu.index') }}">   منوها  </a>

                    </li>



                    <li>
                        <a href="{{ route('log-system') }}">واحد کنترل</a>
                    </li>
                    <li>
                        <a href="{{ route('setting') }}">تنظیمات</a>
                    </li>
                </ul>
            </div>
        </li>


        <li class="menu-title mt-2"> آسانسور </li>

        <li>
            <a href="#sidebarElevator" data-bs-toggle="collapse">
                <i class="mdi mdi-elevator"></i>
                <span>  آسانسور </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarElevator">
                <ul class="nav-second-level">

                    <li>
                        <a href="{{ route('eed.index') }}">   سیستم EED  </a>

                    </li>

                </ul>
            </div>
        </li>

    </ul>

</div>
