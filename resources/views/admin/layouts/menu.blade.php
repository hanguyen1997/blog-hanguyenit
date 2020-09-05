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
                    <a href="{{URL::to('/all-image-about')}}">
                        <i class="fa fa-picture-o"></i>
                        <span>Hình ảnh slider trang chủ</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="{{URL::to('/list-contact')}}">
                        <i class="fa fa-comments"></i>
                        <span></span>Danh sách liên hệ</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="{{URL::to('/list-user')}}">
                        <i class="fa fa-user-plus"></i>
                        <span></span>Danh sách người dùng</span>
                    </a>
                </li>
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
