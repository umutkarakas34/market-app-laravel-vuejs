<template>
    <footer class="footer">
      <div class="footer-content">
        <p>&copy; 2024 Tüm Hakları Saklıdır. | Web Sitesi</p>
        <div class="social-links">
          <a href="#"><i class="fab fa-facebook"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </footer>
  </template>
  
  <style scoped>
  .footer {
    background-color: #333;
    color: white;
    padding: 20px 0;
    text-align: center;
  }
  
  .footer-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }
  
  .footer-content p {
    margin: 0;
  }
  
  .social-links {
    margin-top: 10px;
  }
  
  .social-links a {
    color: white;
    margin: 0 10px;
    font-size: 20px;
    display: inline-block;
  }
  
  .social-links a:hover {
    color: #ddd;
  }
  </style>
  