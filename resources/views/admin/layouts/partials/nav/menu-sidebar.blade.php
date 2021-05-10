<ul class="side-nav metismenu" id="menu">
    @foreach(config('menu.sidebar') as $menu)
        <li class="{{set_active($menu['active'],'active')}}">
            <a href="{{url($menu['link'])}}">
                <i class="{{$menu['icon']}}"></i> {{$menu['title']}} @if(isset($menu['children']))<span
                        class="icon-fa arrow icon-fa-fw"></span> @endif</a>
            @if(isset($menu['children']))
                <ul aria-expanded="true" class="collapse">
                    @foreach($menu['children'] as $child)
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
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>