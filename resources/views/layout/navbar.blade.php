<nav id="navbar" class="">
    <div class="nav-wrapper">
      <!-- Navbar Logo -->
      <div class="logo">
        <img src="{{ asset('assets/images/logo.png') }}" width="70" >
      </div>
  
      <!-- Navbar Links -->
      <ul id="menu">
        @guest
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="{{ url('login') }}">Login</a></li>
        @endguest
        @auth
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="{{ url('category') }}">Category</a></li>
          <li><a href="{{ url('product') }}">Product</a></li>
          <li>
            <?php
             $cart_utama = \App\Models\Cart::where('user_id', Auth::user()->id)->where('status',0)->first();
             if(!empty($cart_utama))
                {
                 $notif = \App\Models\CartDetail::where('cart_id', $cart_utama->id)->count(); 
                }
            ?>
            <a class="nav-link" href="{{ url('check-out') }}">
                <i class="fa fa-shopping-cart"></i>
                @if(!empty($notif))
                <span class="badge badge-danger">{{ $notif }}</span>
                @endif
            </a>
        </li>
          <li><a href="{{ url('logout') }}">Welcome, {{ auth()->user()->name }}</a></li>
        @endauth
      </ul>
    </div>
</nav>