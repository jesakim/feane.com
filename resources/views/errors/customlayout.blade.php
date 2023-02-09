<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>
<style>
body, html {
  height: 100%;
  margin: 0;
}

.bg {
  /* The image used */
  background-image: url("images/hero-bg.jpg");

  /* Full height */
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

.errorcode{
    position: absolute;
    z-index: 100;
    top: 150px;
    left: 50%;
    color: rgb(255, 255, 255);
    font-size: 150px;
    transform: translateX(-50%);
    margin: 0;
    padding: 0;
}

.errormsg{
    position: absolute;
    z-index: 100;
    top: 40px;
    left: 50%;
    color: rgb(255, 255, 255);
    font-size: 50px;
    transform: translateX(-50%);
    text-transform: uppercase;
}

.btn{
    position: absolute;
    z-index: 100;
    top: 10px;
    left: 40px;
    color: rgb(255, 255, 255);
    /* font-size: 50px; */
    padding: 10px;
    border-radius: 5px;
    background:rgb(255, 132, 0);
    transform: translateX(-50%);
    text-transform: uppercase;
}
</style>
</head>
<body>

<div class="bg"></div>
<a href="{{route('Home')}}" class="btn">back</a>
<p class="errormsg">@yield('message')</p>
<p class="errorcode">@yield('code')</p>


</body>
</html>
