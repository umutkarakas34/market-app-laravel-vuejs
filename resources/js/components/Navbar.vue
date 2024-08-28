<template>
    <nav class="navbar">
      <div class="navbar-left">
        <router-link to="/">Ürünler</router-link>
        <router-link v-if="isLoggedIn" to="/orders">Siparişler</router-link>
      </div>
      <div class="navbar-right">
        <div v-if="!isLoggedIn">
          <router-link to="/login">Giriş Yap</router-link>
          <router-link to="/register">Kayıt Ol</router-link>
        </div>
        <div v-else>
          <span>Hoş Geldiniz, {{ userName }}!</span>
          <button @click="logout">Çıkış Yap</button>
        </div>
      </div>
    </nav>
  </template>
  
  <script>
  export default {
    data() {
      return {
        userName: "",
      };
    },
    computed: {
      isLoggedIn() {
        return !!localStorage.getItem("auth_token");
      }
    },
    mounted() {
      if (this.isLoggedIn) {
        this.getUserInfo();
      }
    },
    methods: {
      getUserInfo() {
        const token = localStorage.getItem("auth_token");
        if (token) {
          axios
            .get("http://127.0.0.1:8000/api/user", {
              headers: {
                Authorization: `Bearer ${token}`,
              },
            })
            .then((response) => {
              this.userName = response.data.name;
            })
            .catch((error) => {
              console.error("Kullanıcı bilgileri alınamadı:", error);
            });
        }
      },
      logout() {
        localStorage.removeItem("auth_token");
        this.$router.push("/login").then(() => {
          window.location.reload(); // Çıkış yaptıktan sonra sayfayı yenileyerek navbar'ı güncelle
        });
      },
    },
  };
  </script>
  
  <style scoped>
  .navbar {
      display: flex;
      justify-content: space-between;
      padding: 20px;
      background-color: #333;
      color: white;
  }
  
  .navbar-left a,
  .navbar-right a {
      color: white;
      text-decoration: none;
      margin-left: 20px;
  }
  
  .navbar-right span {
      color: white;
      margin-left: 20px;
  }
  
  .navbar-right button {
      margin-left: 10px;
      background-color: #007bff;
      color: white;
      border: none;
      padding: 10px;
      border-radius: 5px;
      cursor: pointer;
  }
  
  .navbar-right button:hover {
      background-color: #0056b3;
  }
  </style>
  