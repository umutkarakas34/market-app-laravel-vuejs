<template>
    <div class="form-container">
        <h2>Giriş Yap</h2>
        <form @submit.prevent="login">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" v-model="email" required />
            </div>
            <div class="form-group">
                <label for="password">Şifre</label>
                <input type="password" v-model="password" required />
            </div>
            <button type="submit" class="btn">Giriş Yap</button>
        </form>
        <p>{{ message }}</p>
    </div>
</template>
<script>
export default {
  data() {
    return {
      email: "",
      password: "",
      message: "",
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post("http://127.0.0.1:8000/api/login", {
          email: this.email,
          password: this.password,
        });

        // Token'ı localStorage'a kaydet
        localStorage.setItem("auth_token", response.data.access_token);

        // Giriş yaptıktan sonra ana sayfaya yönlendir ve sayfayı yenile
        this.$router.push("/").then(() => {
          window.location.reload(); // Giriş yaptıktan sonra sayfayı yenileyerek navbar'ı güncelle
        });
      } catch (error) {
        this.message = "Giriş başarısız. Lütfen bilgilerinizi kontrol edin.";
      }
    },
  },
};
</script>
<style scoped>
.form-container {
    max-width: 400px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
}

label {
    display: block;
    font-size: 14px;
    margin-bottom: 5px;
}
input {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
    box-sizing: border-box; /* Bu satırı ekleyelim */
    margin-top: 5px; /* Bu satırı ekleyelim */
}

input:focus {
    outline: none;
    border-color: #007bff; /* Focus olduğunda daha belirgin bir sınır rengi */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Focus sırasında hafif bir gölge */
}

.form-group {
    margin-bottom: 20px; /* Boşlukları biraz daha genişletelim */
}

.btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 12px; /* Biraz daha genişletelim */
    width: 100%;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px; /* Font boyutunu biraz artırabiliriz */
}

.btn:hover {
    background-color: #0056b3;
}
</style>
