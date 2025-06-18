<?php
include __DIR__ . '/includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Lexend&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <style>
    body {
      font-family: 'Lexend', sans-serif;
      background: linear-gradient(to bottom right, #a855f7, #f472b6, #38bdf8);
      animation: bg-fade 10s infinite alternate ease-in-out;
      padding-bottom: 80px;
    }
    @keyframes bg-fade {
      0% { background-position: left; }
      100% { background-position: right; }
    }
    .card {
      transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
      border: none;
      background: #ffffff;
    }
    .card:hover {
      transform: scale(1.06);
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    h5, p {
      transition: color 0.3s ease;
    }
    .logout-btn {
      background-color: #6f42c1;
      color: white;
      border: none;
    }
    .logout-btn:hover {
      background-color: #5a379f;
    }
    .bottom-navbar {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      background: rgba(225, 173, 230, 0.9); /* light sky blue */
      box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
      display: flex;
      justify-content: space-around;
      align-items: center;
      padding: 0.5rem 1rem;
      z-index: 1050;
      border-top-left-radius: 1rem;
      border-top-right-radius: 1rem;
      transition: background 0.3s ease;
    }
    .bottom-navbar a {
      color: #6f42c1;
      font-weight: 500;
      text-decoration: none;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 2px;
      transition: transform 0.3s ease, color 0.3s ease;
    }
    .bottom-navbar a:hover {
      color: #5a379f;
      transform: scale(1.1);
    }
  </style>
</head>

<body class="min-vh-100 p-4">

  <div class="container">
    <header class="d-flex justify-content-between align-items-center mb-5">
      <h1 id="welcomeMessage" class="fw-bold text-white">👋 Welcome to Your Dashboard</h1>
      <button class="btn logout-btn d-flex align-items-center gap-2" onclick="window.location.href='./pages/logout.php'">
        <i data-lucide="log-out"></i> Logout 🚪
      </button>
    </header>

    <div class="row g-4">
      <!-- Category Card -->
      <div class="col-md-6 col-lg-4">
        <a href="./pages/category.php" class="text-decoration-none">
          <div class="card text-center shadow rounded-4 p-4">
            <i data-lucide="layers" class="text-primary mb-3" style="width: 32px; height: 32px;"></i>
            <h5 class="text-primary">📁 Categories</h5>
            <p class="text-muted">Organize your product sections easily.</p>
          </div>
        </a>
      </div>

      <!-- Product Card -->
      <div class="col-md-6 col-lg-4">
        <a href="./pages/product.php" class="text-decoration-none">
          <div class="card text-center shadow rounded-4 p-4">
            <i data-lucide="package" class="text-danger mb-3" style="width: 32px; height: 32px;"></i>
            <h5 class="text-danger">📦 Products</h5>
            <p class="text-muted">Browse and manage all your items.</p>
          </div>
        </a>
      </div>

      <!-- Placeholder Card -->
      <div class="col-md-6 col-lg-4">
        <div class="card text-center shadow rounded-4 p-4 opacity-75">
          <i data-lucide="clock" class="text-secondary mb-3" style="width: 32px; height: 32px;"></i>
          <h5 class="text-secondary">⏳ Coming Soon</h5>
          <p class="text-muted">Exciting features are in the works!</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Bottom Navigation Bar -->
  <nav class="bottom-navbar">
    <a href="./pages/category.php">
      <i data-lucide="layers"></i>
      <span>Categories</span>
    </a>
    <a href="./pages/product.php">
      <i data-lucide="package"></i>
      <span>Products</span>
    </a>
    <a href="#">
      <i data-lucide="clock"></i>
      <span>Coming Soon</span>
    </a>
  </nav>

  <span id="welcomeMessage"></span>

<script>
  const userName = "<?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?>";
  document.getElementById("welcomeMessage").textContent = `👋 Welcome, ${userName}!`;
  lucide.createIcons();
</script>

</body>

</html>
