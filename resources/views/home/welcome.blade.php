@extends("home.layouts.master2")
@section("carousel")
<div class="col-md-10 col-md-offset-1">
	<div id="owl-demo" class="owl-carousel owl-theme">
		<div class="item"><img src="/images/image1.png" style="width: 100%;" alt="slider-image">
		</div>
		<div class="item"><img src="/images/image2.jpg" style="width: 100%;" alt="slider-image">
		</div>
		<div class="item"><img src="/images/image3.jpg" style="width: 100%;" alt="slider-image">
		</div>
	</div>

</div>
@endsection
@section("content")
<div class="row" style="margin-top: 100px;">
	<!-- Left Heading Section Start -->
	<div class="text-center">
        <h3 class="border-primary"><span class="heading_border bg-primary">About us</span></h3>
    </div>
	<div class="col-md-7 col-sm-12">
		<p>
			Oceanlink Institute (OI) has been created to produce, through training, the best sea-based and land-based professionals for domestic and international employment in the maritime, hospitality, and culinary arts industries.
		</p>
		<p>
			The company aims to prepare current and upcoming seafarers and hoteliers by providing them with quality training and education.
		</p>
		<p>
			OI offers programs required for domestic and international employment onboard vessels which are accredited by the <b>Maritime Industry Authority (MARINA)</b>. The company also provides training programs to enhance the service skills and technical knowhow of Hotel and Restaurant Service practitioners.
		</p>
		<p>
			Students who want to work onboard international and domestic vessels after graduation can take advantage of programs that link schools to the real world of work of seafarers. OI offers programs that use vessels of our accredited international and domestic shipping companies, our floating classrooms, as the main training environment.
		</p>
		<p><b>Oceanlink Institute</b> is an <b>ISO 9001:2008 certified</b> company</p>
	</div>
	<!-- //Left Heaing Section End -->
	<div class="col-md-5">
		<img src="/images/img-about.jpg" style="border-radius: 9px; border: 1px black solid;">
	</div>
	<div class="col-md-12">
		<div class="text-center">
	        <h3 class="border-primary"><span class="heading_border bg-primary">Mission and Vision</span></h3>
	    </div>
	    <div class="col-md-6">
		    <div class="text-center"><h2>Vision</h2></div>
		    <p>
		    	We will be the preferred training provider of skilled and competent maritime, hospitality, and culinary arts professionals.
		    </p>
	    </div>
	    <div class="col-md-6">
		    <div class="text-center"><h2>Mission</h2></div>
		    <p>
		    	Develop students' competence through the delivery of quality education to meet global requirements of the shipping and other service industries.
		    </p>
		    <p>
		    	Provide a harmonious working environment for the employees, suppliers, customers and other stakeholders.
		    </p>
		    <p>
		    	Comply with the Safety and Environmental Protection Policy of shipping companies whom we are dealing with and uphold its Corporate Responsibility Program.
		    </p>
	    </div>
	</div>
	<div class="col-md-6">
		<div class="text-center">
	        <h3 class="border-primary"><span class="heading_border bg-primary">Partners</span></h3>
	    </div>
	    <img src="/images/logo-2go.png" style="border-radius: 9px; height: 50px;" >
	    <img src="/images/logo-oc.png" style="border-radius: 9px; margin-left: 5%;" >
	    <img src="/images/logo-aha.png" style="border-radius: 9px;margin-left: 5%;" >
	</div>
</div>
@endsection