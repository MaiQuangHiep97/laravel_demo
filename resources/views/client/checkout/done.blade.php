@extends('client.layouts.app')
@section('content')
    <!-- NAVIGATION -->
    <nav id="navigation">
        <!-- container -->
        <div class="container">
            <!-- responsive-nav -->
            <div id="responsive-nav">
                <!-- NAV -->
                <ul class="main-nav nav navbar-nav">
                    <li class="active"><a href="">Home</a></li>
                    @foreach ($categories as $category)
                        <li><a href="{{ url('category', $category->slug) }}">{{ $category->category_name }}</a></li>
                    @endforeach
                </ul>
                <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>
    <!-- /NAVIGATION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="text-center" style="margin-top: 30px;">
                <h4>Thank you for your order</h4>
                <a href="{{url('/')}}">Home page</a>
            </div>
        </div>
        <!-- /container -->
    </div>
@endsection
