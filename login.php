<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Financial Guardian</title>

  <?php include('./header.php'); ?>
  <?php include('./db_connect.php'); ?>
  <?php 
  session_start();
  if(isset($_SESSION['login_id']))
    header("location:index.php?page=home");
  ?>

</head>
<style>
  body {
    width: 100%;
    height: calc(100%);
    background: white;
  }

  main#main {
    width: 100%;
    height: calc(100%);
    background: white;
  }

  #login-right {
    position: absolute;
    right: 0;
    width: 50%;
    height: calc(100%);
    background: white;
    display: flex;
    align-items: center;
  }

  #login-right .card {
    margin: auto;
    z-index: 1
  }

  .logo {
    margin: auto;
    font-size: 8rem;
    background: white;
    padding: .5em 0.7em;
    border-radius: 50% 50%;
    color: #000200b3;
    z-index: 10;
  }

  div#login-right::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: calc(100%);
    height: calc(100%);
    background: #000000e0;
  }

  /* New CSS for logo */
  #login-left {
    position: absolute;
    left: 0;
    width: 50%; /* Adjust the width as needed */
    height: calc(100%);
    background: white; /* Adjust the background color as needed */
    display: flex;
    align-items: center;
    justify-content: center;
  }

  #login-left img {
    max-width: 100%; /* Ensure the image does not exceed its container */
    max-height: 100%;
    width: 	500px; /* Adjust the width to make the logo bigger */
    height: auto; /* Maintain aspect ratio */
  }
</style>

<body>
  <main id="main" class="bg-white">
    <!-- New div for logo -->
    <div id="login-left">
      <img src="fgs.png" >
    </div>

    <div id="login-right">
      <div class="card col-md-8">
        <div class="card-body">
          <form id="login-form">
            <div class="form-group">
              <label for="username" class="control-label">Email</label>
              <input type="text" id="username" name="username" class="form-control">
            </div>
            <div class="form-group">
              <label for="password" class="control-label">Password</label>
              <input type="password" id="password" name="password" class="form-control">
            </div>
            <center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
          </form>
        </div>
      </div>
    </div>
  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
</body>

<script>
  $('#login-form').submit(function(e) {
    e.preventDefault()
    $('#login-form button[type="button"]').attr('disabled', true).html('Logging in...');
    if ($(this).find('.alert-danger').length > 0)
      $(this).find('.alert-danger').remove();
    $.ajax({
      url: 'ajax.php?action=login',
      method: 'POST',
      data: $(this).serialize(),
      error: err => {
        console.log(err)
        $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
      },
      success: function(resp) {
        if (resp == 1) {
          location.href = 'index.php?page=home';
        } else if (resp == 2) {
          location.href = 'voting.php';
        } else {
          $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
          $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
        }
      }
    })
  })
</script>

</html>
