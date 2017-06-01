@if(Auth::user()->role->role === 'superadmin')
<li class="xn-openable">
    <a href="#"><span class="fa fa-cogs"></span> <span class="xn-text">Management</span></a>
    <ul>
      <li><a href="{{route('admin.role')}}"><span class="fa fa-map-marker"></span> <span class="xn-text">Roles</span></a></li>
      <li><a href="{{route('admin.user')}}"><span class="fa fa-map-marker"></span> <span class="xn-text">Users</span></a></li>
    </ul>
</li>
@endif
@if(Auth::user()->role->role === 'admin')
<li class="xn-openable">
    <a href="#"><span class="fa fa-cogs"></span> <span class="xn-text">Management</span></a>
    <ul>
      <li>
          <a href="{{ asset('admin/category/list') }}"><i class="fa fa-bars" aria-hidden="true"></i></span> <span class="xn-text">Category</span></a>
      </li>
      <li>
          <a href="{{ asset('admin/type/list') }}"><i class="fa fa-gavel" aria-hidden="true"></i></span> <span class="xn-text">Type</span></a>
      </li>
      <li>
          <a href="{{ asset('admin/question/list') }}"><i class="fa fa-question" aria-hidden="true"></i><span class="xn-text">Question</span></a>
      </li>

      <li>
          <a href="{{ asset('admin/test/list') }}"><i class="fa fa-graduation-cap" aria-hidden="true"></i> <span class="xn-text">Test</span></a>
      </li>
    </ul>
</li>
<li class="xn-openable">
    <a href="#"><span class="fa fa-cogs"></span> <span class="xn-text">Mark Tests</span></a>
    <ul>
      <li><a href="{{route('admin.test')}}"><span class="fa fa-map-marker"></span> <span class="xn-text">Set mark for test</span></a></li>

      <li><a href="{{route('admin.test.all')}}"><span class="fa fa-map-marker"></span> <span class="xn-text">All Test</span></a></li>
      <li><a href="{{route('admin.test.marked')}}"><span class="fa fa-map-marker"></span> <span class="xn-text">Test marked</span></a></li>
      <li><a href="{{route('admin.test.notmarked')}}"><span class="fa fa-map-marker"></span> <span class="xn-text">Test not mark</span></a></li>

    </ul>
</li>
<li class="xn-openable">
    <a href="#"><span class="fa fa-cogs"></span> <span class="xn-text">Statistic</span></a>
    <ul>
      <li><a href="{{route('admin.rate')}}"><span class="fa fa-map-marker"></span> <span class="xn-text">Rates</span></a></li>
    </ul>
</li>
@endif
