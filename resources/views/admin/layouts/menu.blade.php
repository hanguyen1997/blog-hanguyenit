<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL::to('/dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Thống kê</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-sticky-note-o"></i>
                        <span>Bài viết</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/all-blog')}}">Danh sách bài viết</a></li>
						<li><a href="{{URL::to('/add-blog')}}">Thêm bài viết</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-picture-o"></i>
                        <span>Hình ảnh slider trang chủ</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/all-image-about')}}">Danh sách hình ảnh</a></li>
                        <li><a href="{{URL::to('/add-image-about')}}">Thêm hình ảnh</a></li>
                    </ul>
                </li>
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
