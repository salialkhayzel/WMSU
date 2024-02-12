<div>
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            @foreach($current_roles as $item => $value)
                    @if($value->access_role_create || $value->access_role_read || $value->access_role_update || $value->access_role_delete)
                <li class="nav-item">
                    <a class="nav-link" href="{{ Route($value->module_nav_route) }}" wire:navigate style="{{request()->is('admin/'.$value->module_nav_route.'*') ? 'background-color: #e0e0e0;  color: #990000;' : ''}}">
                    <i class="{{$value->module_nav_icon}}" style="{{request()->is('admin/'.$value->module_nav_route.'*') ? 'color: #990000;' : ''}}"></i>
                        <span>{{$value->module_nav_name}}</span>
                    </a>
                </li>
                    @endif
            @endforeach
        </ul>
    </aside>
</div>
