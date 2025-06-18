<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login Form</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Lexend font -->
  <link href="https://fonts.googleapis.com/css2?family=Lexend&display=swap" rel="stylesheet" />

  <!-- FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="../assets/css/login.css">

  <!-- jQuery CDN added here -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>

  <canvas id="particles"></canvas>

  <form class="login-form" novalidate>
    <h3>Login</h3>
    
    <div class="mb-3 input-with-icon position-relative">
      <input
        type="email"
        class="form-control"
        id="email"
        placeholder="Email Address"
        required
        autocomplete="email"
      />
      <i class="fa fa-envelope form-icon"></i>
      <div id="emailError" class="validation-message">Please enter a valid email address.</div>
    </div>

    <div class="mb-4 input-group position-relative">
      <span class="input-group-text">
        <i class="fa fa-lock"></i>
      </span>
      <input
        type="password"
        class="form-control"
        id="password"
        placeholder="Password"
        required
        autocomplete="current-password"
      />
      <span class="input-group-text" id="togglePassword" title="Show/Hide Password" style="user-select:none; cursor:pointer;">
        <i class="fa fa-eye" id="eyeIcon"></i>
      </span>
      <div id="passwordError" class="validation-message">Password must be at least 6 characters.</div>
    </div>

    <input type="button" value="Login" onclick="insert()" />

    <a href="./register.php" class="register-link">Don't have an account? Register</a>
  </form>

  <!-- Bootstrap 5 JS + Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/login.js"></script>

  <script>

    // insert function for ajax login submit
    function insert() {
      // Clear previous validation states
      $('input').removeClass('is-invalid is-valid');
      $('.validation-message').removeClass('active');

      // Validate inputs
      let valid = true;

      if (!validateEmail()) {
        $('#email').addClass('is-invalid');
        $('#emailError').addClass('active');
        valid = false;
      } else {
        $('#email').addClass('is-valid');
      }

      if (!validatePassword()) {
        $('#password').addClass('is-invalid');
        $('#passwordError').addClass('active');
        valid = false;
      } else {
        $('#password').addClass('is-valid');
      }

      if (!valid) {
        alert('Please fix errors before submitting.');
        return;
      }

      const data = {
        email: $('#email').val().trim(),
        password: $('#password').val()
      };

      $.ajax({
        url: '../api/user/login.php',
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            // alert(response.message);
            alert('login successfuly!');
            window.location.href = '/product-crud/index.php';
          } else {
            alert(response.message || 'Login failed.');
          }
        },
        error: function() {
          alert('Server error. Please try again later.');
        }
      });
    }
  </script>
  
</body>
</html>
