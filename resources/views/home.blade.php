@extends('masterlayout')


@section('titlename') Home @endsection

@section('maincontent')

    <!-- Section authentication -->
    <section class="bg-section ysuccess pt-10 pb-10" data-black-overlay="8" style="background-image: url({{ asset('public/images/background/bg-2.jpg') }})">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 align-right">
                     @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
                                <span>Hi,</span> <a href="{{ url('profile') }}" <span class="font-white"><u>{{ Auth::user()->name }}</u></span> </a>
                                <a class="btn btn-primary mb-0" href="{{ url('logout') }}"><i class="fa fa-lock"></i> {{ __('Logout') }}</a>
                            @else
                                <a class="btn btn-info mb-0" href="{{ route('login') }}"><i class="fa fa-unlock"></i> {{ __('Login') }}</a>

                                @if (Route::has('register'))
                                   <a class="btn btn-success mb-0" href="{{ route('register') }}"><i class="fa fa-user-plus"></i> {{ __('Register') }}</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- /Section authentication-->   

    <!-- Slider Section -->
   <!-- <div class="slider-section">
        <div class="single-slider slider-screen" data-black-overlay="5" style="background-image:url({{ asset('public/images/slider/slider-2.jpg') }});">
            <div id="particles-js"></div>
            <div class="container">
                <div class="slider-content style-1">
                    <p>Welcome to Online</p>
                    <h2>Library Management System</h2>
                </div>
            </div>
        </div>
    </div>-->
    <!-- /Slider Section -->

<!--
<span><a href="{{ url('paymentgetwayRouteTest') }}/100"><i class="fa fa-clock-o"></i>Click</a></span>
-->

 <section >
    <!-- Slider Section -->
        <div class="slider-section">
            <div class="slider-active owl-carousel">
                <!-- Slider 1 -->
                <div class="single-slider slider-screen slider-overlay" style="background-image:url({{ asset('public/images/slider/slider-3.jpg') }});">
                    <div class="container">
                        <div class="slider-content style-1">
                            <p>Welcome to Medicine Point</p>
                            <h2>E-commerce System of order and delivery all type of medicine</h2>
                        </div>
                    </div>
                </div><!-- /Slider 1 -->
                <!-- Slider 2 -->
                <div class="single-slider slider-screen slider-overlay" style="background-image:url({{ asset('public/images/slider/slider-1.jpg') }});">
                    <div class="container">
                        <div class="slider-content style-1">
                            <p>Welcome to Medicine Point</p>
                            <h2>E-commerce System of order and delivery all type of medicine</h2>
                        </div>
                    </div>
                </div><!-- /Slider 2 -->
                <!-- Slider 3 -->
                <div class="single-slider slider-screen slider-overlay" style="background-image:url({{ asset('public/images/slider/slider-2.jpg') }});">
                    <div class="container">
                        <div class="slider-content style-1">
                            <p>Welcome to Medicine Point</p>
                            <h2>E-commerce System of order and delivery all type of medicine</h2>
                        </div>
                    </div>
                </div><!-- /Slider 3 -->
            </div>
        </div>
        <!-- /Slider Section -->
        </section>

    <section >









<!-- Blog Section -->
        <div class="blog-area ptb-30">
            <div class="container">
                <div class="row" id="productlist">


                   


                   <!--
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <article class="post style-2">
                            <div class="post-thumbnail height-blog">
                                <img src="{{ URL::asset('storage/app/bookfile/pic1.jpg') }}" alt="" />
                            </div>
                            <div class="post-header">
                                <h2 class="post-title font20">
                                    Mushroom Planter Bag
                                </h2>
                                <div class="post-meta productprice">
                                    <span><i class="fa fa-money"></i>1500 ৳</span>
                                </div>
                            </div>
                            <div class="post-content">
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout</p>
                                <a class="btn blue-btn" href=" '+surl+' " target="_blank">Place order</a>
                            </div>
                        </article>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <article class="post style-2">
                            <div class="post-thumbnail height-blog">
                                <img src="{{ URL::asset('storage/app/bookfile/pic2.jpg') }}" alt="" />
                            </div>
                            <div class="post-header">
                                <h2 class="post-title font20">
                                    Mushroom Planter Bag
                                </h2>
                                <div class="post-meta productprice">
                                    <span><i class="fa fa-money"></i>1500 ৳</span>
                                </div>
                            </div>
                            <div class="post-content">
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout</p>
                                <a class="btn blue-btn" href="#">Place order</a>
                            </div>
                        </article>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <article class="post style-2">
                            <div class="post-thumbnail height-blog">
                                <img src="{{ URL::asset('storage/app/bookfile/pic3.jpg') }}" alt="" />
                            </div>
                            <div class="post-header">
                                <h2 class="post-title font20">
                                    Mushroom Planter Bag
                                </h2>
                                <div class="post-meta productprice">
                                    <span><i class="fa fa-money"></i>1500 ৳</span>
                                </div>
                            </div>
                            <div class="post-content">
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout</p>
                                <a class="btn blue-btn" href="#">Place order</a>
                            </div>
                        </article>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <article class="post style-2">
                            <div class="post-thumbnail height-blog">
                                <img src="{{ URL::asset('storage/app/bookfile/pic4.jpg') }}" alt="" />
                            </div>
                            <div class="post-header">
                                <h2 class="post-title font20">
                                    Mushroom Planter Bag
                                </h2>
                                <div class="post-meta productprice">
                                    <span><i class="fa fa-money"></i>1500 ৳</span>
                                </div>
                            </div>
                            <div class="post-content">
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout</p>
                                <a class="btn blue-btn" href="#">Place order</a>
                            </div>
                        </article>
                    </div>

-->



                    
                </div>
            </div>
        </div>
        <!-- /Blog Section -->




















    </section>


    <!-- Featured Section -->
    <!-- <section class="featured-area1 style-11">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-3 col-md-3">
                    <div class="featured-item">
                        <i class="fa fa-user-o" aria-hidden="true"></i>
                        <h3>Admin</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3">
                    <div class="featured-item active">
                        <i class="fa fa-group" aria-hidden="true"></i>
                        <h3 class="active">Teacher</h3>
                        <p class="active">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3">
                    <div class="featured-item">
                        <i class="fa fa-group" aria-hidden="true"></i>
                        <h3>Student</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3">
                    <div class="featured-item active">
                        <i class="fa fa-handshake-o" aria-hidden="true"></i>
                        <h3 class="active">Others</h3>
                        <p class="active">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>-->
    <!-- /Featured Section -->

    <!-- About Us Section -->
    <!--
    <section class="about-area pt-50 pb-90">
        <div class="container">
            <div class="row text-center">
                <div class="col">
                    <div class="section-heading mb-70">
                        <h2>About Us</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 mb-30">
                    <div class="about-text">
                        <h3>Publicly accessable e-book</h3>
                        <table id="tableMain" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                   <th style="display:none;">BookId</th>
                                    <th>Book Name</th>
                                    <th>Author</th>
                                    <th></th>
                                    <th style="display:none;">isValid</th>
                                    <th style="display:none;">URL</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="col-lg-5 mb-30">
                    <div class="about-img-1">
                        <img src="{{ asset('public/images/about/about-2.jpg') }}" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>-->
    <!-- /About Us Section -->

@endsection


@section('customjs')

<!-- particles js -->
<script src="{{ asset('public/js/particles.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('public/js/app.js') }}" crossorigin="anonymous"></script>

<script>
    var tableMain;
    var SITEURL = '{{URL::to('')}}';


function getProductList() {

        $.ajax({
            type: "post",
            url: SITEURL+"/getAllProductsRoute",
            data: {
                "id":1,
                "_token":$('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){     
                
                var producthtml="";
                
                $.each(response, function(i, obj) {
                    //console.log(obj.BlogType);

                    var singleproduct="";
                    var surl = "{{url('placeorder')}}/"+obj.ProductId;


                    var bcontent = "";
                    
                    if(!obj.Remarks){
                        bcontent = "";
                    }
                    else if(obj.Remarks.length>80){
                        bcontent = obj.Remarks.substring(0, 80)+"...";
                    }
                    else{
                        bcontent = obj.Remarks;                     
                    }

                    
                    if(!obj.ImageURL){
                        obj.ImageURL = "products/noimage.jpg";
                    }



                    singleproduct +='<div class="col-lg-4 col-md-4 col-sm-12">';
                        singleproduct +='<article class="post style-2">';
                            singleproduct +='<div class="post-thumbnail height-blog">';
                                //singleproduct +='<img src="{{ URL::asset('storage/app/bookfile/pic1.jpg') }}" alt="" />';
                                singleproduct +='<img style="height:100%" src="{{ URL::asset('storage/app') }}/'+obj.ImageURL+'" alt="" />';
                            singleproduct +='</div>';
                            singleproduct +='<div class="post-header">';
                                singleproduct +='<h2 class="post-title font20">';
                                    singleproduct +=obj.ProductName
                                singleproduct +='</h2>';
                                singleproduct +='<div class="post-meta">';
                                    singleproduct +='<span class="productprice"><i class="fa fa-money"></i>'+obj.Price+' ৳</span>';
                                singleproduct +='</div>';


                                singleproduct +='<div class="post-meta">';
                                    singleproduct +='<span class="Availability"><i class="fa fa-shopping-cart"></i>'+obj.StockStatus+'</span>';
                                    /*singleproduct +='<span class="Availability"><i class="fa fa-snowflake-o"></i>Available Stock: '+obj.Availability+' '+obj.StockStatus+'</span>';*/
                                singleproduct +='</div>';

                            singleproduct +='</div>';
                            singleproduct +='<div class="post-content">';
                                singleproduct +='<p>'+bcontent+'</p>';
                                if(obj.Availability > 0){
                                    //singleproduct +='<a class="btn blue-btn" href=" '+surl+' " target="_self">Place order</a>';
                                }else{
                                    singleproduct +='<span class="Availability"><i class="fa fa-stop-circle-o"></i> Stockout</span>';
                                }
                            singleproduct +='</div>';
                        singleproduct +='</article>';
                    singleproduct +='</div>';

/*


                    if(obj.BlogType == "Normal"){
                        
                        singleproduct +='<div class="col-lg-4 col-md-6 col-sm-12">';
                            singleproduct +='<article class="post style-2">';
                                singleproduct +='<div class="post-thumbnail height-blog">';
                                    singleproduct +='<img style="height: 100%;" src="{{ URL::asset('storage/app/blog') }}/'+obj.Thumbnail+'" alt="" />';
                                singleproduct +='</div>';
                                singleproduct +='<div class="post-header">';
                                    singleproduct +='<div class="post-meta">';
                                        singleproduct +='<span><a href=" '+surl+' " target="_blank"><i class="fa fa-clock-o"></i>'+obj.BlogDateTime+'</a></span>';
                                    singleproduct +='</div>';target="_blank"
                                    singleproduct +='<h2 class="post-title">';
                                        singleproduct +='<a href="'+surl+' " target="_blank">'+obj.BlogTitle+'</a>';
                                    singleproduct +='</h2>';
                                singleproduct +='</div>';
                                singleproduct +='<div class="post-content">';
                                    singleproduct +='<p>'+bcontent+'</p>';
                                    singleproduct +='<a href="'+surl+' " target="_blank" class="more-btn-black">Read More</a>';
                                singleproduct +='</div>';
                            singleproduct +='</article>';
                        singleproduct +='</div>';
                    
                    }else if(obj.BlogType == "Video"){

                        singleproduct +='<div class="col-lg-4 col-md-6 col-sm-12">';
                            singleproduct +='<article class="post style-2">';
                                singleproduct +='<div class="height-blog">';
                                    singleproduct +=obj.Thumbnail;
                                singleproduct +='</div>';
                                singleproduct +='<div class="post-header">';
                                    singleproduct +='<div class="post-meta">';
                                        singleproduct +='<span><a href="'+surl+'"><i class="fa fa-clock-o"></i>'+obj.BlogDateTime+'</a></span>';
                                    singleproduct +='</div>';
                                    singleproduct +='<h2 class="post-title">';
                                        singleproduct +='<a href="'+surl+' " target="_blank">'+obj.BlogTitle+'</a>';
                                    singleproduct +='</h2>';
                                singleproduct +='</div>';
                                singleproduct +='<div class="post-content">';
                                    singleproduct +='<p>'+bcontent+'</p>';
                                    singleproduct +='<a href="'+surl+' " target="_blank" class="more-btn-black">Read More</a>';
                                singleproduct +='</div>';
                            singleproduct +='</article>';
                        singleproduct +='</div>';
                    }


*/

                    producthtml +=singleproduct;

                });



                $("#productlist").html(producthtml);
                 
            },
            error:function(error){
                //alert("fail");
                setTimeout(function() {
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 4000
                    };
                toastr.error("Product can not fillup");

                }, 1300);

            }

        });
    }

   
    $(document).ready(function() {
 
        getProductList();
    });


</script>

<style>

.font-white {
    color: white !important;
}
</style>
@endsection