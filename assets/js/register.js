// Particle background animation (unchanged)
    const canvas = document.getElementById('particles');
    const ctx = canvas.getContext('2d');
    let width, height;
    let particlesArray;

    class Particle {
      constructor() {
        this.x = Math.random() * width;
        this.y = Math.random() * height;
        this.size = Math.random() * 3 + 1;
        this.speedX = (Math.random() - 0.5) * 0.8;
        this.speedY = (Math.random() - 0.5) * 0.8;
        this.color = `rgba(106,17,203,${Math.random() * 0.6 + 0.2})`;
      }
      update() {
        this.x += this.speedX;
        this.y += this.speedY;

        if (this.x < 0 || this.x > width) this.speedX = -this.speedX;
        if (this.y < 0 || this.y > height) this.speedY = -this.speedY;
      }
      draw() {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
        ctx.fillStyle = this.color;
        ctx.shadowColor = this.color;
        ctx.shadowBlur = 15;
        ctx.fill();
      }
    }

    function initParticles() {
      particlesArray = [];
      const numberOfParticles = (width * height) / 6000;
      for (let i = 0; i < numberOfParticles; i++) {
        particlesArray.push(new Particle());
      }
    }

    function animate() {
      ctx.clearRect(0, 0, width, height);
      particlesArray.forEach(p => {
        p.update();
        p.draw();
      });
      requestAnimationFrame(animate);
    }

    function resize() {
      width = window.innerWidth;
      height = window.innerHeight;
      canvas.width = width;
      canvas.height = height;
      initParticles();
    }

    window.addEventListener('resize', resize);
    resize();
    animate();

    // Password show/hide toggle
    $('#togglePassword').on('click', function () {
      const passwordField = $('#password');
      const eyeIcon = $('#eyeIcon');
      if (passwordField.attr('type') === 'password') {
        passwordField.attr('type', 'text');
        eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash');
      } else {
        passwordField.attr('type', 'password');
        eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye');
      }
    });

    // Simple validation functions
    function validateName() {
      return $('#name').val().trim().length >= 3;
    }

    function validateEmail() {
      const email = $('#email').val().trim();
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    }

    function validatePassword() {
      return $('#password').val().length >= 6;
    }

    function validateConfirmPassword() {
      return $('#password').val() === $('#confirmPassword').val() && $('#confirmPassword').val() !== '';
    }
