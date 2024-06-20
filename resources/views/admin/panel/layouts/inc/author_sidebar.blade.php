<div id="sidebar-menu">

    <ul id="side-menu">

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


    </ul>

</div>