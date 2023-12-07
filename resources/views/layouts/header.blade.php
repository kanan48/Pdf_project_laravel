<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  </head>
  <body>
   <!---maincontainer starts--->
   <div class="main">
				<!-- logo-->
				<img  class="logo" src="{{asset('assets/images/logo.jpeg')}}"/>	
				<!-- logo ends-->
        <a href="{{Route('logout')}}"><input type="button" value="logout" class="logout"></a>
			</div>		  	
			<!--innercontainer starts-->	      
				<div class="inner">
					<!--date-->
					<div class="date"><?php echo date('d-m-y') ?></div>
					<!-- date ends -->
				</div>
			<!--innercontainer ends-->
        <!---maincontainer ends--->