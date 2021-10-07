@extends('layouts.frontEnd.app')
@section('content')


<div class="container">


<h2 class="my-3">You've added the {{ $plans->plan_name }} Plan.</h2>
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
  {{-- card section one --}}
  <div class="col mb-4 col-md-7 col-sm-6 col-xs-12" >
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Select term length</h5>
        <p class="card-text">Lock in your savings with a multi-year term.</p>
        <div class="row">
          {{-- section one --}}
          @foreach ($plansonsale as $key => $planmonth)
              <div class="col-md-4">
            <label class="radio">
              <input type="radio" name="plan_price" value="{{ number_format($planmonth->discount, 2) }}" class="plan_priceCheck">
              <span class="custom"><span class="month">{{ $planmonth->month }}</span></span>
            </label>
          </div>
          <div class="col-md-8">
            @if ($plans->amount == $planmonth->discount)
            <b style="float: right" class="plan_price">$ {{ number_format($planmonth->discount, 2) }}<small>/mo</small></b>
            @else 
            <b style="float: right" class="plan_price">$ {{ number_format($planmonth->discount, 2) }}<small>/mo</small><br>
            <del class="pl-4"><small>$ {{ number_format($plans->amount, 2) }}/mo</small></del><br>
            <small>On Sale (save 16%)</small>
            </b>
            @endif
          </div>
            <div class="col-md-12">
              <hr>
            </div>
          @endforeach
          
        {{-- section two --}}
            {{-- <div class="col-md-4">
              <label class="radio">
                <input type="radio" name="plan_price" value="{{ number_format('150', 2) }}" class="plan_priceCheck">
                <span class="custom"><span class="month">12 months</span></span>
              </label>
            </div>
            <div class="col-md-8">
              <b style="float: right" class="plan_price">$ {{ number_format($plans->amount, 2) }}<small>/mo</small><br>
              <del class="pl-4"><small>$ {{ number_format('150', 2) }}/mo</small></del><br>
              <small>On Sale (save 16%)</small>
              </b>
            </div>
            <div class="col-md-12">
              <hr>
            </div> --}}
        {{-- section three --}}
            {{-- <div class="col-md-4">
              <label class="radio">
                <input type="radio" name="plan_price" value="{{ number_format('150', 2) }}" class="plan_priceCheck">
                <span class="custom"><span class="month">24 months</span></span>
              </label>
            </div>
            <div class="col-md-8">
            <b style="float: right" class="plan_price">$ {{ number_format($plans->amount, 2) }}<small>/mo</small><br>
              <del class="pl-4"><small>$ {{ number_format('150', 2) }}/mo</small></del><br>
              <small>On Sale (save 16%)</small>
              </b><br>
            </div>
            <div class="col-md-12">
              <hr>
            </div> --}}
        {{-- section four --}}
            {{-- <div class="col-md-4">
              <label class="radio">
                <input type="radio" name="plan_price" value="{{ number_format('150', 2) }}" class="plan_priceCheck" checked>
                <span class="custom"><span class="month">36 months</span></span>
              </label>
            </div>
            <div class="col-md-8">
            <b style="float: right" class="plan_price">$ {{ number_format($plans->amount, 2) }}<small>/mo</small><br>
              <del class="pl-4"><small>$ {{ number_format('150', 2) }}/mo</small></del><br>
              <small>On Sale (save 16%)</small>
              </b>
            </div> --}}
        {{-- <div class="col-md-12">
          <hr>
        </div> --}}
        </div>
      </div>
    </div>
  </div>
  {{-- right card section --}}
  <div class="col mb-4 col-md-5 col-sm-6 col-xs-12" id="right-side">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Order Summary</h5>
        <p class="card-text"></p>
        <div class="row">
          <div class="col-md-7">
            {{ $plans->plan_name }}
          </div>
          <div class="col-md-5">
           <b style="float: right" class="plan_price pl-4"> <b class="plan_money"></b><small>/mo</small><br>
          <small class="month_value"></small>
          </b>
          </div>
          <div class="col-md-12">
            <hr>
          </div>
           <div class="col-md-7">
            {{ $plans->plan_name }}
          </div>
          <div class="col-md-5">
           <b style="float: right" class="plan_price pl-4"> <b class="plan_money"></b><small>/mo</small><br>
          <small class="month_value"></small>
          </b>
          </div>
          <div class="col-md-12">
            <hr>
          </div>
            <div class="col-md-7">
            {{ $plans->plan_name }}
          </div>
          <div class="col-md-5">
           <b style="float: right" class="plan_price pl-4"> <b class="plan_money"></b><small>/mo</small><br>
          <small class="month_value"></small>
          </b>
          </div>
          <div class="col-md-12">
            <hr>
          </div>
            <div class="col-md-7">
            {{ $plans->plan_name }}
          </div>
          <div class="col-md-5">
           <b style="float: right" class="plan_price pl-4"> <b class="plan_money"></b><small>/mo</small><br>
          <small class="month_value"></small>
          </b>
          </div>
          <div class="col-md-12">
            <hr>
          </div>
            <div class="col-md-7">
            {{ $plans->plan_name }}
          </div>
          <div class="col-md-5">
           <b style="float: right" class="plan_price pl-4"> <b class="plan_money"></b><small>/mo</small><br>
          <small class="month_value"></small>
          </b>
          </div>
          <div class="col-md-12">
            <hr>
          </div>
            <div class="col-md-7">
            {{ $plans->plan_name }}
          </div>
          <div class="col-md-5">
           <b style="float: right" class="plan_price pl-4"> <b class="plan_money"></b><small>/mo</small><br>
          <small class="month_value"></small>
          </b>
          </div>
          <div class="col-md-12">
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>

    {{-- card section two --}}
  <div class="col mb-4 col-md-7 col-sm-6 col-xs-12" >
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">We’ve added Website Backup with basic security. Here’s why.</h5>
        <p class="card-text">You’ve put a lot of work into your site. Website Backup makes sure you won’t lose it with automatic daily backups, plus basic security features like daily malware scanning and continuous security monitoring for other threats. We highly recommend Website Backup, but it is an optional feature.</p>
        <div class="row my-5">
          <div class="col-md-12 mb-4">
             <b class="">Protect your hard work</b>
          </div>
          {{-- section one --}}
          <div class="col-md-4">
          <label class="radio">
            <input type="radio" name="plan_price">
            <span class="custom"><span class="month">Add Website Backup</span></span>
          </label>
        </div>
        
        <div class="col-md-8">
          <b style="float: right" class="plan_price">$ {{ number_format($plans->amount, 2) }}<small>/mo</small><br>
          <del class="pl-4"><small>$ {{ number_format('150', 2) }}/mo</small></del><br>
          <small>On Sale (save 16%)</small>
          </b>
        </div>
        <div class="col-md-7">
          <p class="pl-4">Protect your website with automatic backups, plus daily malware scans and continuous security monitoring.</p>
        </div>
        <div class="col-md-12">
          <hr>
        </div>
        {{-- section two --}}
        <div class="col-md-4">
          <label class="radio">
            <input type="radio" name="plan_price">
            <span class="custom"><span class="month">No Thanks</span></span>
          </label>
        </div>
        <div class="col-md-12">
          <p>* Website Backup is available in English only.</p>
        </div>
        {{-- <div class="col-md-12">
          <hr>
        </div> --}}
        </div>
      </div>
    </div>
  </div>

   {{-- card section three --}}
  <div class="col mb-4 col-md-7 col-sm-6 col-xs-12" >
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Protect your data and increase your Google ranking</h5>
        <p class="card-text"></p>
        <div class="row my-5">
          
          {{-- section one --}}
          <div class="col-md-4">
          <label class="radio">
            <input type="radio" name="plan_price">
            <span class="custom"><span class="month">Add SSL Certificate</span></span>
          </label>
        </div>
        
        <div class="col-md-8">
          <b style="float: right" class="plan_price">$ {{ number_format($plans->amount, 2) }}<small>/mo</small><br>
          <del class="pl-4"><small>$ {{ number_format('150', 2) }}/mo</small></del><br>
          <small>On Sale (save 16%)</small>
          </b>
        </div>
        <div class="col-md-7">
          <p class="pl-4">Adding an SSL certificate will secure sensitive data (e.g., passwords, credit card numbers), boost your Google search ranking and prevent your site from being flagged "Not Secure" in your website's address bar.</p>
        </div>

        {{-- <div class="col-md-12">
          <hr>
        </div> --}}
        </div>
      </div>
    </div>
  </div>

   {{-- card section four --}}
  <div class="col mb-4 col-md-7 col-sm-6 col-xs-12" >
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Enhance your security and speed</h5>
        <p class="card-text">We highly recommend Website Security to protect your site, but it is an optional feature.</p>
        <div class="row my-5">
          {{-- section one --}}
          <div class="col-md-4">
          <label class="radio">
            <input type="radio" name="plan_price">
            <span class="custom"><span class="month">Add Essential Website Security</span></span>
          </label>
        </div>
        
        <div class="col-md-8">
         <b style="float: right" class="plan_price">$ {{ number_format($plans->amount, 2) }}<small>/mo</small><br>
          <del class="pl-4"><small>$ {{ number_format('150', 2) }}/mo</small></del><br>
          <small>On Sale (save 16%)</small>
          </b>
        </div>
        <div class="col-md-7">
          <p class="pl-4">Defend your site against hackers and malware. Automatic daily scans detect malware on your site and our guaranteed clean up removes it.</p>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <div id="backup"></div>
  <div class="col-md-12" style="text-align: center; margin-bottom:100px">
  <button class="btn btn-dark" > Continue</button>
  </div>
</div>
<!-- /.container -->




<style>
  @media (max-width: 576px) {  
  .xs {color:red;font-weight:bold;}
}

/* Small devices (landscape phones, 576px and up) */
@media (min-width: 576px) and (max-width:768px) {  
  .sm {color:red;font-weight:bold;}
}
 
/* Medium devices (tablets, 768px and up) The navbar toggle appears at this breakpoint */
@media (min-width: 768px) and (max-width:992px) {  
 .md {color:red;font-weight:bold;}
}
 
/* Large devices (desktops, 992px and up) */
@media (min-width: 992px) and (max-width:1200px) { 
 .lg {color:red;font-weight:bold;}
}
 
/* Extra large devices (large desktops, 1200px and up) */
@media (min-width: 1200px) {  
    .xl {color:red;font-weight:bold;}
}

hr {
  border: 0.5px solid rgb(120, 121, 120);
  border-radius: 5px;
}

/* input[type=radio] {
    border: 0px;
    width: 100%;
    height: 2em;
} */

* {
  box-sizing: border-box;
}

.month{
  font-size: 20px;
  font-family: Verdana, Geneva, Tahoma, sans-serif;
  font-weight: bolder;
  margin-bottom: 5px;
  padding-left: 10px;
}

.plan_price{
  font-size: 18px;
  font-family: Verdana, Geneva, Tahoma, sans-serif;
  font-weight: bolder;
}

input[type="radio"] {
  display: none;
  cursor: pointer;
}

label {
  cursor: pointer;
  min-width: 50px;
  display:inline-block;
  position:relative;
}

.radio span.custom > span {
  margin-left: 24px;
  margin-right: 10px;
  display: inline-block;
  white-space: nowrap;
  line-height: 22px;
}

.radio .custom {  
  display: inline;
}

.radio .custom:after{ 
  content: '';
  height: 20px;
  left: 0;
  top: 0;
  width: 20px;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 3px;
  position: absolute;
}

.radio input:checked + .custom:after {
  background-color: #0574ac;
  border-radius: 50%;
  content: "";
  display: block;
  height: 20px;
  width: 20px;
  /* content: "\f00c";
  font-family: 'FontAwesome'; */
  /* color: #fff; */
  
}

.radio input:checked + .custom:before {
    content: "\f00c";
    font-family: 'FontAwesome';
    color: #bbb;
    height: 20px;
  border-radius: 50%;

}

.radio input + .custom:after {
  border-radius: 50%;
}

.checkbox input:checked .custom {
  background-color: blue;
  border-color: blue;
}

#right-side {
    /* position: fixed; */
    /* top: 0px; */
    /* right: 0px; */
    /* bottom: 0px; */
    /* width: 200px; */
    /* background-color: green; */
    }
  html {
        scroll-behavior: smooth;
      }

      #faqnav {
  width: 100%;
}
#faqnav{
  padding: 0 30px 0 12px;
}
#faqnav {
  display: block;
  padding: 10px 0;
  position: relative;
  color: #999;
  -webkit-transition: all 0.25s linear;
  -moz-transition: all 0.25s linear;
  -ms-transition: all 0.25s linear;
  -o-transition: all 0.25s linear;
  transition: all 0.25s linear;
}
#faqnav {
  color: #2880f8;
}
#faqnav:before {
  content: "";
  width: 3px;
  height: 25px;
  display: inline-block;
  line-height: 45px;
  position: absolute;
  background: #999;
  left: -10px;
}
#faqnav:before {
  background: #2880f8;
}
#faqnav:before {
}

</style>

@endsection

@section('script')
    <script>
  $(document).ready(function(){
    
    $('.plan_priceCheck').on("change",function () 
{
  // alert(1)
    var str ="$ ";
    $('.plan_priceCheck:checked').each(function()
	{
        str+= $(this).val()+",";
    });
    $('.plan_money').text(str.substring(0, str.length - 1));
});


$(window).scroll(function() {
  if ($(window).scrollTop() > 100) {
    // alert(1)
    $("#right-side > div").css("position", "fixed");
    $("#right-side > div").css("width", "35%");
    $("#right-side > div").css("top", "10px");
  } else if ($(window).scrollTop() <= 0) {
    $("#right-side > div").css("position", "");
    $("#right-side > div").css("top", "");
    $("#right-side > div").css("width", "");

  }
  if (
    $("#right-side > div").offset().top + $("#right-side > div").height() >
    $("#backup").offset().top
  ) {

    $("#right-side > div").css("position", "sticky");
  }

  });
  });

  

</script>
@endsection
