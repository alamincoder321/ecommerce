  <!-- ========== Left Sidebar Start ========== -->

  <div class="left side-menu">
      <div class="sidebar-inner slimscrollleft">
          <div class="user-details">
              <div class="pull-left">
                  <img src="@auth{{asset(Auth::user()->image)}}@endauth" alt="" class="thumb-md img-circle">
              </div>
              <div class="user-info">
                  <div class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">@auth {{Auth::user()->name}} @endauth <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                          <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile<div class="ripple-wrapper"></div></a></li>
                          <li>
                              <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                                <i class="md md-settings-power"></i>{{ __('Logout') }}
                              </a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                  @csrf
                              </form> 
                          </li>
                      </ul>
                  </div>
                  
                  <p class="text-muted m-0">Administrator</p>
              </div>
          </div>
          <!--- Divider -->
          <div id="sidebar-menu">
              <ul>
                  <li>
                      <a href="{{route ('dashboard')}}" class="waves-effect  @yield('dashboard')"><i class="md md-home"></i><span> Dashboard </span></a>
                  </li>

                  <li class="has_sub">
                      <a class="waves-effect @yield('slider')"><i class="ion-arrow-down-a"></i><span> SLIDER </span><span class="pull-right"><i class="md md-add"></i></span></a>
                      <ul class="list-unstyled">
                          <li><a href="{{route ('slider.index')}}">SLIDER LIST</a></li>
                          <li><a href="{{route ('slider.create')}}">SLIDER CREATE</a></li>
                      </ul>
                  </li>

                  <li class="has_sub">
                      <a class="waves-effect @yield('brand')"><i class="ion-stop"></i><span> BRAND </span><span class="pull-right"><i class="md md-add"></i></span></a>
                      <ul class="list-unstyled">
                          <li><a href="{{route ('brand.index')}}">BRAND LIST</a></li>
                          <li><a href="{{route ('brand.create')}}">BRAND CREAATE</a></li>
                      </ul>
                  </li>
                  
                  <li class="has_sub">
                      <a class="waves-effect @yield('category')"><i class="ion-navicon-round"></i><span> CATEGORY </span><span class="pull-right"><i class="md md-add"></i></span></a>
                      <ul class="list-unstyled">
                          <li><a href="{{route ('category.index')}}">CATEGORY LIST</a></li>
                          <li><a href="{{route ('category.create')}}">CATEGORY CREATE</a></li>
                      </ul>
                  </li>

                  <li class="has_sub">
                      <a class="waves-effect @yield('subcategory')"><i class="ion-navicon"></i><span> SUB-CATEGORY </span><span class="pull-right"><i class="md md-add"></i></span></a>
                      <ul class="list-unstyled">
                          <li><a href="{{route ('subcategory.index')}}">SUB-CATEGORY LIST</a></li>
                          <li><a href="{{route ('subcategory.create')}}">SUB-CATEGORY CREATE</a></li>
                      </ul>
                  </li>

                  <li class="has_sub">
                      <a class="waves-effect @yield('coupon')"><i class=" md-stars"></i><span> COUPON </span><span class="pull-right"><i class="md md-add"></i></span></a>
                      <ul class="list-unstyled">
                          <li><a href="{{route ('coupon.index')}}">COUPON LIST</a></li>
                          <li><a href="{{route ('coupon.create')}}">COUPON CREATE</a></li>
                      </ul>
                  </li>

                  <li class="has_sub">
                      <a class="waves-effect @yield('product')"><i class="md md-now-widgets"></i><span> PRODUCT </span><span class="pull-right"><i class="md md-add"></i></span></a>
                      <ul class="list-unstyled">
                          <li><a href="{{route ('product.index')}}">PRODUCT LIST</a></li>
                          <li><a href="{{route ('product.create')}}">PRODUCT CREATE</a></li>
                      </ul>
                  </li>

              </ul>
              <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
      </div>
  </div>
  <!-- Left Sidebar End --> 