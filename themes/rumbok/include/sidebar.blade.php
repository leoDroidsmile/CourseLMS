<!-- Main Menu -->
<div class="main-menu-2">
    <div class="menu-logo">
        <a href="{{url('/')}}"><img src="{{filePath(getSystemSetting('type_logo')->value)}}" alt="logo"></a>
    </div>
    <ul>
        <li><a href="{{url('/')}}">@translate(home)</a></li>
        <li class="have-submenu"><a href="{{ route('course.filter') }}">@translate(courses)</a>
            <ul class="sub-menu">
                @foreach(categories() as $item)
                    <li class="{{$item->child->count() != 0 ? 'have-submenu' : ''}}">
                        <a href="{{route('course.category',$item->slug)}}">{{$item->name}}</a>
                        @if($item->child->count() != 0)
                            <ul class="sub-menu">
                                @foreach($item->child as $child)
                                    <li>
                                        <a href="{{route('course.category',$child->slug)}}">{{$child->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </li>
        @foreach(\App\Page::where('active',1)->get() as $item)
            <li><a href="{{route('pages',$item->slug)}}">{{$item->title}}</a></li>
        @endforeach
        @guest()
            <li><a href="{{route('login')}}">@translate(log in)</a></li>
            <li><a href="{{route('student.register')}}">@translate(sign up)</a></li>
        @endguest
    </ul>
</div>
