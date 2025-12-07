export default class BundleProcessing {
        async router(page, type, array_website, code = '') {
            const array = [
                'BE3-EC-D1',
                'BE3-EC-D2',
                'BE3-EC-D3',
                'BE3-W-VB1',
                'BE3-W-VB2',
                'BE3-E-BOX',
                'BE3-LIST-PANEL-WORKSPACE',
                'BE3-LIST-ROLE-WORKSPACE',
                'BE3-LOGO',
                'BE3-NAMAWEBAPPS',
                'BE3-ASHION-HOME-PRODUK_GROUP_KLASIFIKASI',
                'BE3-ASHION-CONTACT_US',
                'BE3-ASHION-HOME-DISKON',
                'BE3-ASHION-HOME-PROFILE-TOKO',
                'BE3-LINK-LOGOUT',
                'BE3-LINK-LOGIN',
                'BE3-LINK-REGISTER',
                'BE3-LINK-CART'
            ];

            if (type === 'content') {
                switch (code) {
                    case 'BE3-LINK-LOGOUT':
                        return "INI LINK LOGOUT";
                    case 'BE3-LOGO':
                        return this.logo(page, array_website);
                    case 'BE3-LINK-CART':
                        return await this.link_cart(page, array_website);
                    case 'BE3-LINK-LOGIN':
                        return await this.login(page, array_website);
                    case 'BE3-LINK-REGISTER':
                        return await this.daftar(page, array_website);
                    case 'BE3-BASE-URL':
                        return await this.base_url(page, array_website);
                    case 'BE3-LIST-PANEL-WORKSPACE':
                        return await this.list_panel_workspace(page, array_website);
                    case 'BE3-LIST-ROLE-WORKSPACE':
                        return await this.list_role_workspace(page, array_website);
                    case 'BE3-E-BOX':
                        return this.ecommerce_dasboard_box(page, array_website);
                    case 'BE3-EC-D1':
                        return this.ecommerce_dasboard_bundles_1(page, array_website);
                    case 'BE3-EC-D2':
                        return this.ecommerce_dasboard_bundles_2(page, array_website);
                    case 'BE3-EC-D3':
                        return this.ecommerce_dasboard_bundles_3(page, array_website);
                    case 'BE3-W-VB1':
                        return this.visitor_bundles_1(page, array_website);
                    case 'BE3-W-VB2':
                        return this.visitor_bundles_2(page, array_website);
                    case 'BE3-ASHION-HOME-PRODUK_GROUP_KLASIFIKASI':
                        return this.ashion_home_produk_group_klasifikasi(page, array_website);
                    case 'BE3-ASHION-HOME-DISKON':
                        return ""; // or implement later: this.ashion_home_diskon(page, array_website);
                    case 'BE3-ASHION-CONTACT_US':
                        return this.ashion_contact_us(page, array_website);
                    case 'BE3-ASHION-HOME-PROFILE-TOKO':
                        return this.ashion_home_profil(page, array_website);
                    default:
                        return "";
                }
            } else if (type === 'array') {
                return array;
            }

            return null;
        }

        // Stub implementations — real logic should be filled here
        async logo(page, data) {
            return "<div>Logo 2</div>";
        }
        async link_cart(page, data) {
            return "<div>Cart</div>";
        }
        async login(page, data) {
            return "<div>Login</div>";
        }
        async daftar(page, data) {
            return "<div>Register</div>";
        }
        async base_url(page, data) {
            return "<div>Base URL</div>";
        }
        async list_panel_workspace(page, data) {
            return "<div>Panel Workspace</div>";
        }
        async list_role_workspace(page, data) {
            return "<div>Role Workspace</div>";
        }
        async ecommerce_dasboard_box(page, data) {
            return "<div>Ecommerce Box</div>";
        }
        async ecommerce_dasboard_bundles_1(page, data) {
            return "<div>Bundle 1</div>";
        }
        async ecommerce_dasboard_bundles_2(page, data) {
            return "<div>Bundle 2</div>";
        }
        async ecommerce_dasboard_bundles_3(page, data) {
            return "<div>Bundle 3</div>";
        }
        async visitor_bundles_1(page, data) {
            return "<div>Visitor 1</div>";
        }
        async visitor_bundles_2(page, data) {
            return "<div>Visitor 2</div>";
        }
        async ashion_home_produk_group_klasifikasi(page, data) {
            return "<div>Produk Group</div>";
        }
        async ashion_home_diskon(page, data) {
            return "<div>Diskon</div>";
        }
        async ashion_contact_us(page, data) {
            return "<div>Contact Us</div>";
        }
        async ashion_home_profil(page, data) {
            return "<div>Profil Toko</div>";
        }
    }
 