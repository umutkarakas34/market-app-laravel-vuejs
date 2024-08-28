<template>
    <div class="product-list">
        <h2>Ürünler</h2>

        <!-- Yükleniyor mesajı -->
        <p v-if="isLoading">Ürünler yükleniyor...</p>

        <!-- Ürünler geldiyse kartları göster -->
        <div v-else class="card-container">
            <div v-for="product in products" :key="product.id" class="card">
                <h3>{{ product.name }}</h3>
                <p>{{ product.price }} TL</p>
                <button @click="buyProduct(product)">Satın Al</button>
            </div>
        </div>

        <!-- Toast Mesajı -->
        <div v-if="showToast" class="toast-message">
            <p>{{ toastMessage }}</p>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            products: [],
            showToast: false,
            toastMessage: "",
            isLoading: false, // Yüklenme durumu takibi
        };
    },
    mounted() {
        this.getProducts();
    },
    methods: {
        async getProducts() {
            this.isLoading = true; // Yüklenme başladı

            try {
                const response = await axios.get("http://127.0.0.1:8000/api/products");
                this.products = response.data;
            } catch (error) {
                console.error("Ürünler alınırken hata oluştu:", error);
            } finally {
                this.isLoading = false; // Yüklenme tamamlandı
            }
        },
        async buyProduct(product) {
            const token = localStorage.getItem("auth_token");
            if (!token) {
                // Giriş yapılmadıysa toast mesajını göster
                this.showToastMessage("Lütfen giriş yapınız!", "error");
                return;
            }

            try {
                const response = await axios.post(
                    "http://127.0.0.1:8000/api/orders",
                    {
                        product_id: product.id,
                        quantity: 1,
                    },
                    {
                        headers: {
                            Authorization: `Bearer ${token}`,
                        },
                    }
                );
                // Başarılı satın alma sonrası toast mesajı göster
                this.showToastMessage(`${product.name} başarıyla satın alındı!`, "success");
            } catch (error) {
                console.error("Satın alma işlemi sırasında hata oluştu:", error);
            }
        },
        showToastMessage(message, type) {
            this.toastMessage = message;
            this.showToast = true;

            // 3 saniye sonra toast mesajını gizle
            setTimeout(() => {
                this.showToast = false;
            }, 3000);

            // Farklı tipler için renk değişimi yap
            const toastElement = document.querySelector('.toast-message');
            if (type === 'error') {
                toastElement.style.backgroundColor = '#dc3545'; // Kırmızı
            } else {
                toastElement.style.backgroundColor = '#28a745'; // Yeşil
            }
        },
    },
};
</script>

<style scoped>
/* Ürünler başlığını ortala */
.product-list h2 {
    text-align: center;
    margin-bottom: 20px;
}

/* Kart konteyner stili */
.card-container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
}

/* Kart stili */
.card {
    background-color: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    width: 200px;
    margin: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.card img {
    width: 100%;
    height: auto;
    border-radius: 8px;
}

.card h3 {
    margin: 10px 0;
    font-size: 18px;
}

.card p {
    font-size: 16px;
    color: #333;
}

.card button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
}

.card button:hover {
    background-color: #0056b3;
}

/* Toast Mesajı Stili */
.toast-message {
    position: fixed;
    bottom: 20px;
    left: 20px;
    background-color: #28a745; /* Başlangıçta yeşil */
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    z-index: 1000;
    transition: background-color 0.3s;
}
</style>
