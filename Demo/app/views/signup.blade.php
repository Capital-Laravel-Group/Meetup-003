<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sign up</title>

    <!-- Bootstrap core CSS -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script src="/js/autofill.js" language="javascript"></script>

    <!-- Custom styles for this template -->
    <style type="text/css" media="screen">
    body {
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #eee;
    }

    .form-signin {
      max-width: 530px;
      padding: 15px;
      margin: 0 auto;
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
      margin-bottom: 10px;
    }
    .form-signin .checkbox {
      font-weight: normal;
    }
    .form-signin .form-control {
      position: relative;
      font-size: 16px;
      height: auto;
      padding: 10px;
      -webkit-box-sizing: border-box;
         -moz-box-sizing: border-box;
              box-sizing: border-box;
    }
    .form-signin .form-control:focus {
      z-index: 2;
    }
    .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-left-radius: 0;
      border-bottom-right-radius: 0;
    }
    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
    .btn-facebook {
      margin: 15px 0;
    }
    </style>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '639250652779203',
          status     : true,
          xfbml      : true
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/all.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>

    <div class="container">

      {{ Form::open(array('class' => 'form-signin', 'role' => 'form')) }}

        <h2 class="form-signin-heading">Please sign up for free cookies</h2>

        {{ HTML::ul($errors->all(), array('class' => 'text-danger')) }}

        <button type="button" class="btn btn-primary btn-facebook"><i class="fa fa-facebook"></i> Autofill with Facebook</button>

        {{ Form::email('email', Input::old('email'), ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email address']) }}

        {{ Form::text('name', Input::old('name'), ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Name']) }}

        <label class="checkbox">
          {{ Form::checkbox('accept', 'yes', Input::old('accept'), ['id' => 'accept']) }} I accept that fees may apply
        </label>

        {{ Form::submit('Sign up', ['id' => 'submit', 'class' => 'btn btn-lg btn-success btn-block']) }}

      {{ Form::close() }}

    </div> <!-- /container -->

  </body>
</html>
