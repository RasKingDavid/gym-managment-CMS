
<?php $settings = Utilities::getSettings();
      $services =  App\Service::all();
?>
<style>
    .auth-page, header .logo, .leftside, .leftside .widget .footer {
	/* background: #000000; */
	
    background: {{ $settings['theme_color'] }};
}

.login {
    background: {{ $settings['theme_color'] }} !important;
    color: #fff !important;
    /* border:1px solid #fff !important; */
}

.btn-info{
    background: {{ $settings['theme_color'] }} !important;
    color: #fff !important;
}


</style>