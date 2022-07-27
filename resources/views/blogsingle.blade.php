
@extends('masterlayout')

@section('titlename') Blog Single @endsection

@section('maincontent')
	

		<!-- Section -->
		<section class="bg-section ysuccess pt-10 pb-10" data-black-overlay="8" style="background-image: url({{ asset('public/images/background/bg-2.jpg') }})">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-7">
						<i class="fa fa-home white"></i> <span> / Blog Single</span>	
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

<div style="display:none">
	<label>Blog Id</label>
	<input type="text"  name="BlogId" id="BlogId" value={{$BlogId}}>
</div>


<!-- Blog Section -->
		<div class="blog-area ptb-30">
			<div class="container">
				<div class="row" id="bloglist">


					<!--single post-->
					<!--
					<div class="col-lg-12 col-md-12 col-sm-12">
						<article class="post style-2">
							<div style="width: 35%;" class="post-thumbnail height-blog">
								<img src="{{ URL::asset('storage/app/blog/blog-3.jpg') }}" alt="" />
							</div>
							<div class="post-header">
								<div class="post-meta">
									<span><a href="#"><i class="fa fa-clock-o"></i>2021/03/19 10.30 AM</a></span>
								</div>
								<h2 class="post-title">
									<a href="blog-single.html">Lorem ipsum dolor sit</a>
								</h2>
							</div>
							<div class="post-content">
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
								Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
								when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
								It has survived not only five centuries, but also the leap into electronic typesetting, 
								remaining essentially unchanged. 
								It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
								passages, and more recently with desktop publishing software like Aldus PageMaker including versions 
								of Lorem Ipsum.</p>
							</div>
						</article>
					</div>-->
					<!--/single post-->

					
				</div>
			</div>
		</div>
		<!-- /Blog Section -->

		
 @endsection


@section('customjs')

<script>
	var tableMain;
 	var SITEURL = '{{URL::to('')}}';


 

function getProductCategoryList() {

	    $.ajax({
	        type: "post",
	        url: SITEURL+"/getSingleBlogViewRoute",
	        data: {
	        	"BlogId":$("#BlogId").val(),
        		"_token":$('meta[name="csrf-token"]').attr('content')
        	},
	        success:function(response){		
	        	//console.log(response);
				
				var singleblog="";

				//if(response[0].BlogType == "Text" || response[0].BlogType == "Racipies" || response[0].BlogType == "News"){
	        	if(response[0].BlogType == "Text"){
	        		singleblog +='<div class="col-lg-12 col-md-12 col-sm-12">';
						singleblog +='<article class="post style-2">';
							singleblog +='<div style="width: 35%;" class="post-thumbnail height-blog">';
								singleblog +='<img style="height: 100%;" src="{{ URL::asset('storage/app') }}/'+response[0].Thumbnail+'" alt="" />';
							singleblog +='</div>';
							singleblog +='<div class="post-header">';
								singleblog +='<div class="post-meta">';
									singleblog +='<span><i class="fa fa-clock-o"></i>'+response[0].BlogDateTime+'</span>';
								singleblog +='</div>';
								singleblog +='<h2 class="post-title">';
									singleblog +='<a href="javascript:void(0)">'+response[0].BlogTitle+'</a>';
								singleblog +='</h2>';
							singleblog +='</div>';
							singleblog +='<div class="post-content"><p>'+response[0].Content+'</p>';
							singleblog +='</div>';
						singleblog +='</article>';
					singleblog +='</div>';

				} else if(response[0].BlogType == "Video"){

						singleblog +='<div class="col-lg-12 col-md-12 col-sm-12">';
							singleblog +='<article class="post style-2">';
								singleblog +='<div style="width: 35%;" class="height-blog">';
									singleblog +=response[0].EmbedCode;
								singleblog +='</div>';
								singleblog +='<div class="post-header">';
									singleblog +='<div class="post-meta">';
										singleblog +='<span><i class="fa fa-clock-o"></i>'+response[0].BlogDateTime+'</span>';
									singleblog +='</div>';
									singleblog +='<h2 class="post-title">';
										singleblog +='<a href="javascript:void(0)">'+response[0].BlogTitle+'</a>';
									singleblog +='</h2>';
								singleblog +='</div>';
								singleblog +='<div class="post-content">';
									singleblog +='<p>'+response[0].Content+'</p>';
								singleblog +='</div>';
							singleblog +='</article>';
						singleblog +='</div>';
					}

				$("#bloglist").html(singleblog);
				 
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
				toastr.error("Error");

				}, 1300);

	        }

	    });
	}
 

	$(document).ready(function() {
		getProductCategoryList();
	} );

function clearForm() {
	
}

</script>

<style>
iframe{
	height: 100%;
	width: 100%;
}
</style>

 @endsection