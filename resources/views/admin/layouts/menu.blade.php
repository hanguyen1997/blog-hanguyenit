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
                    <a href="javascript:;" id="menu-blogs">
                        <i class="fa fa-sticky-note-o"></i>
                        <span>Bài viết</span>
                    </a>
                    <ul class="sub">
						<li id="list_blog" ><a href="{{URL::to('/all-blog')}}">Danh sách bài viết</a></li>
						<li id="add_blog" ><a href="{{URL::to('/add-blog')}}">Thêm bài viết</a></li>
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
                <?php 
                /*if the user is an admin, show menu list user admin is user_group_id = 1*/ 
                $user_group_id = Session::get('user_group_id');
                if($user_group_id == "1")
                {;
                ?>
                <li class="sub-menu">
                    <a href="javascript:;"  id="menu-users">
                        <i class="fa fa-user-plus"></i>
                        <span>Thành viên</span>
                    </a>
                    <ul class="sub">
                        <li id="list_user" ><a href="{{URL::to('/list-user')}}">Danh sách thành viên</a></li>
                        <li id="add_user" ><a href="{{URL::to('/form-add-user')}}">Thêm thành viên mới</a></li>
                        <li id="list_group_user" ><a href="{{URL::to('/list-user-group')}}">Danh sách nhóm thành viên</a></li>
                    </ul>
                </li>
                <?php 
                }
                ?>
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
