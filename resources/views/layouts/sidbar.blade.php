<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">SmartSchool</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    @auth('admin')
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{route('admin.dashboard')}}">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Home</div>
                </a>
            </li>
            <li>
                <a href="{{route('admin.registers.index')}}">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Requests</div>
                </a>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Media</div>
                </a>
                <ul>
                   @foreach(\App\Models\Category::all() as $category)
                            <li> <a href="{{route("admin.".$category->name.".index")}}"><i class="bx bx-right-arrow-alt"></i>{{$category->name}}</a>
                            </li>
                   @endforeach
                </ul>
            </li>
            <li>
                <a href="{{route('admin.levels.index')}}">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Levels</div>
                </a>
            </li>
            <li>
                <a href="{{route('admin.classes.index')}}">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Classes</div>
                </a>
            </li>
            <li>
                <a href="{{route('admin.subjects.index')}}">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Subjects</div>
                </a>
            </li>
            <li>
                <a href="{{route('admin.teachers.index')}}">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Teachers</div>
                </a>
            </li>
        </ul>
    @elseauth('teacher')
        <ul class="metismenu" id="menu">
            <li>
                <a href="#">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Widgets</div>
                </a>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
                <ul>
                    <li> <a href="index.html"><i class="bx bx-right-arrow-alt"></i>Default</a>
                    </li>
                    <li> <a href="index2.html"><i class="bx bx-right-arrow-alt"></i>Alternate</a>
                    </li>
                </ul>
            </li>
        </ul>
    @endauth
    <!--end navigation-->
</div>
