<ul class="side-nav metismenu" id="menu">
    @foreach(config('menu.sidebar') as $menu)
        @if(!isset($menu['access']) || ( isset($menu['access']) && array_search(Auth::user()->role ,$menu['access']) !== false))
            <li class="{{set_active($menu['active'],'active')}}">
                <a href="{{url($menu['link'])}}">
                    <i class="{{$menu['icon']}}"></i> {{$menu['title']}} @if(isset($menu['children']))<span
                            class="icon-fa arrow icon-fa-fw"></span> @endif</a>
                @if(isset($menu['children']))
                    <ul aria-expanded="true" class="collapse">
                        @foreach($menu['children'] as $child)
                            @if(!isset($child['access']) || ( isset($child['access']) && array_search(Auth::user()->role ,$child['access']) !== false))
                                <li class="{{set_active($child['active'],'active')}}">
                                    <a class="pl-5" href="{{url($child['link'])}}">@if(isset($child['icon']))
                                            <i class="{{$child['icon']}}"></i>@endif{{$child['title']}}@if(isset($child['children']))
                                            <span class="icon-fa arrow icon-fa-fw"></span> @endif</a>
                                    @if(isset($child['children']))
                                        <ul aria-expanded="true" class="collapse submenu">
                                            @foreach($child['children'] as $subchild)
                                                <li class="{{set_active($subchild['active'])}}">
                                                    <a class="pl-5"
                                                       href="{{url($subchild['link'])}}">@if(isset($subchild['icon']))
                                                            <i class="{{$subchild['icon']}}"></i>@endif{{$subchild['title']}}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </li>
        @endif
    @endforeach
</ul>