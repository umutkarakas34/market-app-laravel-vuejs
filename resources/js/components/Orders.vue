<template>
    <div class="orders">
      <h2>Siparişlerim</h2>
      <!-- Yükleniyor mesajı -->
      <p v-if="isLoading">Siparişleriniz yükleniyor...</p>
  
      <!-- Siparişler geldiyse tabloyu göster -->
      <div v-if="!isLoading && orders.length">
        <table class="orders-table">
          <thead>
            <tr>
              <th>Ürün</th>
              <th>Miktar</th>
              <th>Tarih</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="order in orders" :key="order.id">
              <!-- Ürün adı -->
              <td>{{ order.product ? order.product.name : 'Ürün Bilgisi Yok' }}</td>
              <!-- Miktar -->
              <td>{{ order.quantity }}</td>
              <!-- Sipariş tarihi -->
              <td>{{ new Date(order.created_at).toLocaleDateString() }}</td>
            </tr>
          </tbody>
        </table>
      </div>
  
      <!-- Sipariş yoksa mesaj göster -->
      <p v-else-if="!isLoading && !orders.length">Henüz siparişiniz yok.</p>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    data() {
      return {
        orders: [],
        isLoading: false, // Verilerin yüklenme durumunu takip ediyoruz
      };
    },
    mounted() {
      this.getOrders();
    },
    methods: {
      async getOrders() {
        const token = localStorage.getItem("auth_token");
        if (!token) {
          this.$router.push("/login");
          return;
        }
  
        this.isLoading = true; // Yüklenme durumunu başlatıyoruz
  
        try {
          const response = await axios.get("http://127.0.0.1:8000/api/user/orders", {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });
          this.orders = response.data; // Veriyi orders dizisine ata
        } catch (error) {
          console.error("Siparişler alınırken hata oluştu:", error);
        } finally {
          this.isLoading = false; // Yüklenme durumu sona eriyor
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .orders {
    padding: 20px;
  }
  
  .orders h2 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
  }
  
  .orders-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
  }
  
  .orders-table thead {
    background-color: #007bff;
    color: white;
  }
  
  .orders-table th,
  .orders-table td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }
  
  .orders-table tbody tr:hover {
    background-color: #f1f1f1;
  }
  
  .orders-table tbody tr:nth-child(even) {
    background-color: #f8f9fa;
  }
  
  .orders-table th {
    font-size: 18px;
  }
  
  .orders-table td {
    font-size: 16px;
  }
  
  p {
    text-align: center;
    font-size: 18px;
    color: #666;
  }
  </style>
  