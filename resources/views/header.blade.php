<!-- header -->
    <header id="sticky-header" class="header style-1">
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('public/images/logo.png') }}" alt="logo" />
                        </a>
                    </div>
                </div>

                <div class="col-lg-8 col-md-8">
                    <!-- Main Menu -->
                    <div class="menu-area d-none d-md-block">
                        <nav>
                            <ul class="main-menu pull-right clearfix">
                                <li><a href="{{ url('/') }}">Home</a></li>

                                @if(Auth::check())
          
                                    @if(Auth::user()->userrole =='Admin')
                                     <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                                        
                                        <!--<li><a href="{{ url('dashboard') }}">Dashboard</a></li>-->
<!--
                                        <li><a href="JavaScript:Void(0);">Reports<span class="tp-angle pull-right"><i class="fa fa-angle-down"></i></span></a>
                                            <ul class="submenu">
                                               <li><a href="{{ url('orderreports') }}">Order Details Report</a></li>
                                               <li><a href="{{ url('receivedetails') }}">Receive Details Report</a></li>
                                            </ul>
                                        </li>   -->                                
          
                                        <li><a href="JavaScript:Void(0);">Admin<span class="tp-angle pull-right"><i class="fa fa-angle-down"></i></span></a>
                                            <ul class="submenu">
                                                <li><a href="{{ url('userentry') }}">User List</a>
                                               
                                                <li><a href="{{ url('productsentry') }}">Medicine Entry</a></li>
                                                 <li><a href="{{ url('productcategoryentry') }}">Medicine Unit Entry</a></li>

                                                 
                                                <!--<li><a href="{{ url('productwaitforapproval') }}">Product Wait for Approval</a></li>-->
                                                <li><a href="{{ url('orders') }}">Order List</a></li>
                                                <!--<li><a href="{{ url('receiveentry') }}">Receive Entry</a></li>-->
                                                <li><a href="{{ url('blogentry') }}">Blog Entry</a></li>
                                            </ul>
                                        </li>
                                    @endif
                                   




                                <li><a href="JavaScript:Void(0);">Customer<span class="tp-angle pull-right"><i class="fa fa-angle-down"></i></span></a>
                                    <ul class="submenu">
                                        <li><a href="{{ url('orderplace') }}">Order</a></li>
                                        

                                        @if(Auth::check())
                                            @if(Auth::user()->userrole =='Customer')
                                               <!--  <li><a href="{{ url('myproductslist') }}">My Orders</a></li> -->
                                            @endif
                                        @endif

                                        <!--<li><a href="{{ url('myproductslist') }}">My Products</a></li>-->

                                    </ul>
                                </li>
                                @endif

                   
                                
                                <li><a href="{{ url('blog') }}">Blog</a></li>
                                <li><a href="{{ url('aboutus') }}">About Us</a></li>
                                <li><a href="{{ url('contact') }}">Contact</a></li>

                            </ul>
                        </nav>
                    </div>
                    <!-- /Main Menu -->

                    <!-- Mobile Menu -->
                    <!--<div class="mobile-menu-area">
                        <nav id="mobile-menu">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="dashboard.php">Dashboard</a></li>
                                
                                <li><a href="#">Reports</a>
                                    <ul>
                                        <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                        <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Admin</a>
                                    <ul>
                                        <li><a href="shortcodes-testimonial.html">Testimonial</a></li>
                                        <li><a href="shortcodes-team.html">Team</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>-->
                    <!-- /Mobile Menu -->
                </div>
            </div>
        </div>
    </div>
</header>

<!-- /header -->