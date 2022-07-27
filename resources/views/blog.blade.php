
@extends('masterlayout')

@section('titlename') Blog @endsection

@section('maincontent')
	

		<!-- Section -->
		<section class="bg-section ysuccess pt-10 pb-10" data-black-overlay="8" style="background-image: url({{ asset('public/images/background/bg-2.jpg') }})">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-7">
						<i class="fa fa-home white"></i> <span> / Blog</span>	
					</div>
					<div class="col-lg-5 align-right">
						@if (Route::has('login'))
	                        <div class="top-right links">
	                            @auth
	                                <span>Hi,</span> <a href="{{ url('profile') }}" <span class="font-white"><u>{{ Auth::user()->name }}</u></span> </a>
	                                <a class="btn btn-primary mb-0" href="{{ url('logout') }}"><i class="fa fa-lock"></i> {{ __('Logout') }}</a>
	                            @else
	                                <a class="btn btn-info mb-0" href="{{ route('login') }}"><i class="fa fa-unlock"></i> {{ __('Login') }}</a>

	                                @if (Route::has('register'))
	                                   <!-- <a class="btn btn-success mb-0" href="{{ route('register') }}"><i class="fa fa-user-plus"></i> {{ __('Register') }}</a>-->
	                                @endif
	                            @endauth
	                        </div>
                   		@endif

					</div>
				</div>
			</div>
		</section>
		<!-- /Section -->	




<!-- Testimonial Section -->
		<section class="testimonial-area pt-10 pb-10">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 mb-12"><center>
						<div class="btn-group" role="group" aria-label="Type">
						  <button type="button" class="btn btn-primary" onclick="getBlogList(0)">All</button>
						  <button type="button" class="btn btn-success" onclick="getBlogList(1)">Text</button>
						  <button type="button" class="btn btn-warning" onclick="getBlogList(2)">Video</button>
						</div></center>
					</div>
				</div>
              </div>
		</section>

<!-- Blog Section -->
		<div class="blog-area ptb-30">
			<div class="container">
				<div class="row" id="bloglist">
					 



<!--
					<div class="col-lg-4 col-md-6 col-sm-12">
						<article class="post style-2">
							<div class="post-thumbnail height-blog">
								<img src="{{ URL::asset('public/images/blog/blog-3.jpg') }}" alt="" />
							</div>
							<div class="post-header">
								<div class="post-meta">
									<span><a href="{{ url('blogsingle/1') }}"><i class="fa fa-clock-o"></i>2021/03/19 10.30 AM</a></span>
								</div>
								<h2 class="post-title">
									<a href="{{ url('blogsingle/1') }} " target="_blank">Lorem ipsum dolor sit</a>
								</h2>
							</div>
							<div class="post-content">
								<p>Lorem ipsum dolor sit amet elit adipiscing sed do...</p>
								<a href="{{ url('blogsingle/1') }} " target="_blank" class="more-btn-black">Read More</a>
							</div>
						</article>
					</div>

					<div class="col-lg-4 col-md-6 col-sm-12">
						<article class="post style-2">
							<div class="height-blog">
								<iframe width="100%" height="100%" src="https://www.youtube.com/embed/Bacf3wTY2EQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							</div>
							<div class="post-header">
								<div class="post-meta">
									<span><a href="{{ url('blogsingle/1') }}"><i class="fa fa-clock-o"></i>2021/03/19 10.30 AM</a></span>
								</div>
								<h2 class="post-title">
									<a href="{{ url('blogsingle/1') }} " target="_blank">Lorem ipsum dolor sit</a>
								</h2>
							</div>
							<div class="post-content">
								<p>Lorem ipsum dolor sit amet elit adipiscing sed do...</p>
								<a href="{{ url('blogsingle/1') }} " target="_blank" class="more-btn-black">Read More</a>
							</div>
						</article>
					</div>

					<div class="col-lg-4 col-md-6 col-sm-12">
						<article class="post style-2">
							<div class="post-thumbnail height-blog">
								<img src="{{ URL::asset('public/images/blog/blog-3.jpg') }}" alt="" />
							</div>
							<div class="post-header">
								<div class="post-meta">
									<span><a href="{{ url('blogsingle/2') }}"><i class="fa fa-clock-o"></i>2021/03/19 10.30 AM</a></span>
								</div>
								<h2 class="post-title">
									<a href="{{ url('blogsingle/2') }} " target="_blank">Lorem ipsum dolor sit</a>
								</h2>
							</div>
							<div class="post-content">
								<p>Lorem ipsum dolor sit amet elit adipiscing sed do...</p>
								<a href="{{ url('blogsingle/2') }} " target="_blank" class="more-btn-black">Read More</a>
							</div>
						</article>
					</div>

					<div class="col-lg-4 col-md-6 col-sm-12">
						<article class="post style-2">
							<div class="post-thumbnail">
								<img src="{{ URL::asset('public/images/blog/blog-3.jpg') }}" alt="" />
							</div>
							<div class="post-header">
								<div class="post-meta">
									<span><a href="{{ url('blogsingle') }}"><i class="fa fa-clock-o"></i>2021/03/19 10.30 AM</a></span>
								</div>
								<h2 class="post-title">
									<a href="{{ url('blogsingle') }} " target="_blank">Lorem ipsum dolor sit</a>
								</h2>
							</div>
							<div class="post-content">
								<p>Lorem ipsum dolor sit amet elit adipiscing sed do...</p>
								<a href="{{ url('blogsingle') }} " target="_blank" class="more-btn-black">Read More</a>
							</div>
						</article>
					</div>

					<div class="col-lg-4 col-md-6 col-sm-12">
						<article class="post style-2">
							<div class="post-thumbnail">
								<img src="{{ URL::asset('public/images/blog/blog-3.jpg') }}" alt="" />
							</div>
							<div class="post-header">
								<div class="post-meta">
									<span><a href="{{ url('blogsingle') }}"><i class="fa fa-clock-o"></i>2021/03/19 10.30 AM</a></span>
								</div>
								<h2 class="post-title">
									<a href="{{ url('blogsingle') }} " target="_blank">Lorem ipsum dolor sit</a>
								</h2>
							</div>
							<div class="post-content">
								<p>Lorem ipsum dolor sit amet elit adipiscing sed do...</p>
								<a href="{{ url('blogsingle') }} " target="_blank" class="more-btn-black">Read More</a>
							</div>
						</article>
					</div>

					<div class="col-lg-4 col-md-6 col-sm-12">
						<article class="post style-2">
							<div class="post-thumbnail">
								<img src="{{ URL::asset('public/images/blog/blog-3.jpg') }}" alt="" />
							</div>
							<div class="post-header">
								<div class="post-meta">
									<span><a href="{{ url('blogsingle') }}"><i class="fa fa-clock-o"></i>2021/03/19 10.30 AM</a></span>
								</div>
								<h2 class="post-title">
									<a href="{{ url('blogsingle') }} " target="_blank">Lorem ipsum dolor sit</a>
								</h2>
							</div>
							<div class="post-content">
								<p>Lorem ipsum dolor sit amet elit adipiscing sed do...</p>
								<a href="{{ url('blogsingle') }} " target="_blank" class="more-btn-black">Read More</a>
							</div>
						</article>
					</div>
							-->	
					
					


				</div>
			</div>
		</div>
		<!-- /Blog Section -->

		
 @endsection


@section('customjs')

<script>
	var tableMain;
 	var SITEURL = '{{URL::to('')}}';

function getBlogList(filtertype) {

	    $.ajax({
	        type: "post",
	        url: SITEURL+"/getAllBlogViewRoute",
	        data: {
	        	"id":1,
	        	"filtertype":filtertype,
        		"_token":$('meta[name="csrf-token"]').attr('content')
        	},
	        success:function(response){		
	        	
				var bloghtml="";
	        	
				$.each(response, function(i, obj) {
					//console.log(obj.BlogType);

					var singleblog="";
					var surl = "{{url('blogsingle')}}/"+obj.BlogId;


					var bcontent = "";
					if(!obj.Content.length){
						bcontent = "";
					}
					else if(obj.Content.length>80){
						bcontent = obj.Content.substring(0, 80)+"...";
					}
					else{
						bcontent = obj.Content;						
					}

					//if(obj.BlogType == "Text" || obj.BlogType == "Racipies" || obj.BlogType == "News"){
					if(obj.BlogType == "Text"){
						singleblog +='<div class="col-lg-4 col-md-6 col-sm-12">';
							singleblog +='<article class="post style-2">';
								singleblog +='<div class="post-thumbnail height-blog">';
									singleblog +='<img style="height: 100%;" src="{{ URL::asset('storage/app') }}/'+obj.Thumbnail+'" alt="" />';
								singleblog +='</div>';
								singleblog +='<div class="post-header">';
									singleblog +='<div class="post-meta">';
										singleblog +='<span><a href=" '+surl+' " target="_blank"><i class="fa fa-clock-o"></i>'+obj.BlogDateTime+'</a></span>';
									singleblog +='</div>';target="_blank"
									singleblog +='<h2 class="post-title">';
										singleblog +='<a href="'+surl+' " target="_blank">'+obj.BlogTitle+'</a>';
									singleblog +='</h2>';
								singleblog +='</div>';
								singleblog +='<div class="post-content">';
									singleblog +='<p>'+bcontent+'</p>';
									singleblog +='<a href="'+surl+' " target="_blank" class="more-btn-black">Read More</a>';
								singleblog +='</div>';
							singleblog +='</article>';
						singleblog +='</div>';
					
					}else /*if(obj.BlogType == "Video")*/{

						singleblog +='<div class="col-lg-4 col-md-6 col-sm-12">';
							singleblog +='<article class="post style-2">';
								singleblog +='<div class="height-blog">';
									singleblog +=obj.EmbedCode;
								singleblog +='</div>';
								singleblog +='<div class="post-header">';
									singleblog +='<div class="post-meta">';
										singleblog +='<span><a href="'+surl+'"><i class="fa fa-clock-o"></i>'+obj.BlogDateTime+'</a></span>';
									singleblog +='</div>';
									singleblog +='<h2 class="post-title">';
										singleblog +='<a href="'+surl+' " target="_blank">'+obj.BlogTitle+'</a>';
									singleblog +='</h2>';
								singleblog +='</div>';
								singleblog +='<div class="post-content">';
									singleblog +='<p>'+bcontent+'</p>';
									singleblog +='<a href="'+surl+' " target="_blank" class="more-btn-black">Read More</a>';
								singleblog +='</div>';
							singleblog +='</article>';
						singleblog +='</div>';
					}




					bloghtml +=singleblog;

				});



				$("#bloglist").html(bloghtml);
				 
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
				toastr.error("Blog can not fillup");

				}, 1300);

	        }

	    });
	}

	$(document).ready(function() {
	 
		
		getBlogList(0);
	} );

function clearForm() {
	
}

</script>

<style>

iframe{
	height: 100%;
	width: 100%;
}

	.align-left {
		text-align: left;
	}
	.align-center {
		text-align: center !important;
	}
	.align-right {
		text-align: right;
	}
.font-white {
    color: white !important;
}
</style>

 @endsection