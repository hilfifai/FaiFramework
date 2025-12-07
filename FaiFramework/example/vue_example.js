import { AuthModule } from '@/lib/js/auth';

// Initialize
const auth = new AuthModule();
auth.init({ baseUrl: 'https://api.example.com/' });

// Usage in component
methods: {
  async handleLogin() {
    try {
      await auth.login(this.email, this.password);
      this.$router.push('/dashboard');
    } catch (error) {
      this.error = error.message;
    }
  }
}
import { Database } from '@/lib/js/database';

// In component
const db = new Database();
const result = await db.renderContentWithData(content, page, dataRows, templateString);

import { ProductModule } from '@/lib/js/product';

// Initialize
const product = new ProductModule();
product.init({ baseUrl: 'https://api.example.com/' });

// Usage in component
methods: {
  showProductDetails(card, jsonData) {
    product.showProductDetails(card, jsonData);
  },
  async addToCart() {
    await product.addToCart();
  }
}