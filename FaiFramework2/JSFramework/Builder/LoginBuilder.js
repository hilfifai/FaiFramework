import FaiModule from '../FaiModule.js';
export default class LoginBuilder extends FaiModule{
	
            constructor(config = {}) {
				super();
                this.config = {
                    container: document.body,
                    displayMode: 'modal', // 'modal' or 'full-page'
                    elements: ['login', 'register'],
                    isCanAsGuest: true,
                    isCanAsSSO: false,
                    verificationMethod: 'sms', // 'sms' or 'email'
                    ...config
                };
                
                this.currentView = null;
              
            }
            
            init() {
                // Create container for login elements
                this.container = document.createElement('div');
                this.container.id = 'login-builder-elements';
                this.config.container.appendChild(this.container);
                
                // Add CSS for backdrop if in modal mode
                if (this.config.displayMode === 'modal') {
                    const style = document.createElement('style');
                    style.textContent = `
                        .login-backdrop {
                            position: fixed;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background-color: rgba(0, 0, 0, 0.5);
                            z-index: 999998;
                            display: none;
                        }
                    `;
                    document.head.appendChild(style);
                    
                    this.backdrop = document.createElement('div');
                    this.backdrop.className = 'login-backdrop';
                    this.backdrop.onclick = () => this.hide();
                    document.body.appendChild(this.backdrop);
                }
                
                // Generate the requested elements
                this.generateElements();
            }
            
            generateElements() {
                this.container.innerHTML = '';
                
                if (this.config.elements.includes('login')) {
                    this.generateLogin();
                }
                
                if (this.config.elements.includes('register')) {
                    this.generateRegister();
                }
                
                if (this.config.isCanAsGuest) {
                    this.generateGuestForm();
                    this.generateGuestVerification();
                    this.generateGuestThankYou();
                }
            }
            
            generateLogin() {
                const loginContainer = document.createElement('section');
                loginContainer.className = `login-container ${this.config.displayMode === 'full-page' ? 'full-page' : ''}`;
                loginContainer.id = 'login-container';
                loginContainer.style.display = 'none';
                
                loginContainer.innerHTML = `
                    <div class="login-header">
                        <h1 class="login-title" style="text-align: center;width: 100%;">Welcome back</h1>
                        <svg aria-hidden="true" class="close-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="text-bold text-center">
                        <p>Login to speed up the checkout process, save your favorite item and view your order status</p>
                    </div>
                    <div class="login-form">
                        <label class="form-label mb-0 mt-0">
                            <span class="form-label-text">Email*</span>
                            <input type="text" name="email" id="emailLGN" class="form-input" placeholder="Enter your email">
                        </label>
                        <label class="form-label">
                            <span class="form-label-text">Password*</span>
                            <div class="password-container">
                                <input type="password" name="password" id="passwordLGN" class="form-input" placeholder="Enter password">
                            </div>
                            <span class="forgot-password">Forgot your password?</span>
                        </label>
                        <button class="login-btn" type="button">LOG IN</button>
                        ${this.config.isCanAsGuest ? `
                            <div class="or-container">
                                <div class="or-text" style="font-size: 11px;">Checkout without register ?</div>
                                <div class="or-line"></div>
                            </div>
                            <button class="guest-btn" type="button">Continue as guest</button>
                        ` : ''}
                        ${this.config.isCanAsSSO ? this.generateSSOButtons() : ''}
                        <div class="register-link">
                            <p>Doesn't have an account?</p>
                            <span class="register-now">Register now</span>
                        </div>
                    </div>
                `;
                
                // Add event listeners
                const closeBtn = loginContainer.querySelector('.close-icon');
                closeBtn.onclick = () => this.hide();
                
                const loginBtn = loginContainer.querySelector('.login-btn');
                loginBtn.onclick = () => this.handleLogin();
                
                if (this.config.isCanAsGuest) {
                    const guestBtn = loginContainer.querySelector('.guest-btn');
                    guestBtn.onclick = () => this.showGuestForm();
                }
                
                const registerLink = loginContainer.querySelector('.register-now');
                registerLink.onclick = () => this.showRegister();
                
                this.container.appendChild(loginContainer);
            }
            
            generateRegister() {
                const registerContainer = document.createElement('section');
                registerContainer.className = `login-container ${this.config.displayMode === 'full-page' ? 'full-page' : ''}`;
                registerContainer.id = 'register-modal';
                registerContainer.style.display = 'none';
                
                registerContainer.innerHTML = `
                    <div class="login-header">
                        <h1 class="login-title">Register</h1>
                        <span class="close-btn">&times;</span>
                    </div>
                    <div class="login-form">
                        <form autocomplete="off">
                            <label class="form-label mb-0 mt-0">
                                <span class="form-label-text">Your Name*</span>
                                <input type="text" name="name" placeholder="Enter your name" class="form-input" required />
                            </label>
                            <label class="form-label mb-0 mt-0">
                                <span class="form-label-text">Email*</span>
                                <input type="email" name="email" placeholder="Enter your email" class="form-input" required />
                            </label>
                            <label class="form-label mb-0 mt-0">
                                <span class="form-label-text">Phone*</span>
                                <div class="phone-input">
                                    <span>+62</span>
                                    <input type="number" name="phone" placeholder="Enter your phone" class="form-input" required />
                                </div>
                            </label>
                            <label class="form-label mb-0 mt-0">
                                <span class="form-label-text">Password*</span>
                                <input type="password" name="password" placeholder="Enter your password" class="form-input" required />
                                <p class="password-hint">
                                    <small>More than 8 characters</small>, <small>1 number</small>, <small>1 uppercase</small>, <small>1 lowercase</small>
                                </p>
                            </label>
                            <label class="form-label mb-0 mt-0">
                                <span class="form-label-text">Confirm Password*</span>
                                <input type="password" name="re-password" placeholder="Confirm your password" class="form-input" required />
                            </label>
                            <label class="form-label mb-0 mt-0">
                                <span class="form-label-text">Gender</span>
                                <select name="gender" class="form-input">
                                    <option value="" hidden>Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </label>
                            <label class="form-label mb-0 mt-0">
                                <span class="form-label-text">Birth Date*</span>
                                <input type="date" name="date" min="1965-01-01" required class="form-input" />
                            </label>
                            <label class="form-label mb-0 mt-0 checkbox">
                                <input type="checkbox" name="agree" required class="form-input" style="width: 15px; margin: 5px;" />
                                <span>I agree to receive information and offers.</span>
                            </label>
                            <button type="submit" class="login-btn">Register</button>
                        </form>
                        <div class="or-container">
                            <div class="or-text">OR</div>
                            <div class="or-line"></div>
                        </div>
                        ${this.config.isCanAsSSO ? this.generateSSOButtons() : ''}
                        <div class="register-link">
                            <p>Already have an account?</p>
                            <span class="register-now">Login now</span>
                        </div>
                    </div>
                `;
                
                // Add event listeners
                const closeBtn = registerContainer.querySelector('.close-btn');
                closeBtn.onclick = () => this.hide();
                
                const form = registerContainer.querySelector('form');
                form.onsubmit = (e) => {
                    e.preventDefault();
                    this.handleRegister();
                };
                
                const loginLink = registerContainer.querySelector('.register-now');
                loginLink.onclick = () => this.showLogin();
                
                this.container.appendChild(registerContainer);
            }
            
            generateGuestForm() {
                const guestContainer = document.createElement('section');
                guestContainer.className = `login-container ${this.config.displayMode === 'full-page' ? 'full-page' : ''}`;
                guestContainer.id = 'asgouest-form-container';
                guestContainer.style.display = 'none';
                
                guestContainer.innerHTML = `
                    <div class="login-header">
                        <h1 class="login-title">As Guest</h1>
                        <svg aria-hidden="true" class="close-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="login-form">
                        <label class="form-label mb-0 mt-0">
                            <span class="form-label-text">No Whatsapp*</span>
                            <input type="text" name="nowa" id="nowa" class="form-input" placeholder="Enter your No Whatsapp">
                        </label>
                        <button class="login-btn" type="button">SEND</button>
                    </div>
                `;
                
                // Add event listeners
                const closeBtn = guestContainer.querySelector('.close-icon');
                closeBtn.onclick = () => this.hide();
                
                const sendBtn = guestContainer.querySelector('.login-btn');
                sendBtn.onclick = () => this.handleGuestSubmit();
                
                this.container.appendChild(guestContainer);
            }
            
            generateGuestVerification() {
                const verificationContainer = document.createElement('section');
                verificationContainer.className = `login-container ${this.config.displayMode === 'full-page' ? 'full-page' : ''}`;
                verificationContainer.id = 'asgouest-verifikasi-container';
                verificationContainer.style.display = 'none';
                
                const verificationText = this.config.verificationMethod === 'sms' 
                    ? 'We have sent an OTP code to the number you have registered' 
                    : 'We have sent an OTP code to your email';
                
                verificationContainer.innerHTML = `
                    <div class="login-header">
                        <h1 class="login-title">As Guest</h1>
                        <svg aria-hidden="true" class="close-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="login-form">
                        ${verificationText}
                        <div id="number_verifikasi"></div>
                        <input type="hidden" id="veritikasi_id">
                        <button style="background: none; border: none; color: #007bff; cursor: pointer; margin: 10px 0;">Resend</button>
                        <div class="otp-container">
                            <input type="text" class="otp-input" pattern="\\d" maxlength="1">
                            <input type="text" class="otp-input" pattern="\\d" maxlength="1" disabled>
                            <input type="text" class="otp-input" pattern="\\d" maxlength="1" disabled>
                            <input type="text" class="otp-input" pattern="\\d" maxlength="1" disabled>
                            <input type="text" class="otp-input" pattern="\\d" maxlength="1" disabled>
                            <input type="text" class="otp-input" pattern="\\d" maxlength="1" disabled>
                        </div>
                        <input type="hidden" name="verificationCode" id="verificationCode" placeholder="Enter verification code" readonly>
                        <button class="login-btn" type="button">SEND</button>
                    </div>
                `;
                
                // Add event listeners
                const closeBtn = verificationContainer.querySelector('.close-icon');
                closeBtn.onclick = () => this.hide();
                
                const sendBtn = verificationContainer.querySelector('.login-btn');
                sendBtn.onclick = () => this.handleVerification();
                
                const resendBtn = verificationContainer.querySelector('button');
                resendBtn.onclick = () => this.handleResendCode();
                
                // Add OTP input handling
                this.setupOTPInputs(verificationContainer);
                
                this.container.appendChild(verificationContainer);
            }
            
            generateGuestThankYou() {
                const thankYouContainer = document.createElement('section');
                thankYouContainer.className = `login-container ${this.config.displayMode === 'full-page' ? 'full-page' : ''}`;
                thankYouContainer.id = 'asgouest-thank-container';
                thankYouContainer.style.display = 'none';
                
                thankYouContainer.innerHTML = `
                    <div class="login-header">
                        <h1 class="login-title">Success</h1>
                        <svg aria-hidden="true" class="close-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="login-form text-center">
                        Successful, Thank You.
                    </div>
                `;
                
                // Add event listeners
                const closeBtn = thankYouContainer.querySelector('.close-icon');
                closeBtn.onclick = () => this.hide();
                
                this.container.appendChild(thankYouContainer);
            }
            
            generateSSOButtons() {
                return `
                    <div class="or-container">
                        <div class="or-text">OR</div>
                        <div class="or-line"></div>
                    </div>
                    <div class="sso-container">
                        <div class="sso-btn" title="Login with Google">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" fill="#4285F4"/>
                            </svg>
                        </div>
                        <div class="sso-btn" title="Login with Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z" fill="#4267B2"/>
                            </svg>
                        </div>
                    </div>
                `;
            }
            
            setupOTPInputs(container) {
                const inputs = container.querySelectorAll('.otp-input');
                
                inputs.forEach((input, index) => {
                    input.addEventListener('input', () => {
                        if (input.value.length === 1 && index < inputs.length - 1) {
                            inputs[index + 1].removeAttribute('disabled');
                            inputs[index + 1].focus();
                        }
                        
                        this.updateVerificationCode(container);
                    });
                    
                    input.addEventListener('keydown', (e) => {
                        if (e.key === 'Backspace' && input.value === '' && index > 0) {
                            inputs[index - 1].focus();
                        }
                    });
                });
            }
            
            updateVerificationCode(container) {
                const inputs = container.querySelectorAll('.otp-input');
                const hiddenInput = container.querySelector('#verificationCode');
                let code = '';
                
                inputs.forEach(input => {
                    code += input.value;
                });
                
                hiddenInput.value = code;
            }
            
            showLogin() {
                this.hideAll();
                document.getElementById('login-container').style.display = 'block';
                this.currentView = 'login';
                
                if (this.config.displayMode === 'modal') {
                    this.backdrop.style.display = 'block';
                    document.body.classList.add('blurred');
                }
            }
            
            showRegister() {
                this.hideAll();
                document.getElementById('register-modal').style.display = 'block';
                this.currentView = 'register';
                
                if (this.config.displayMode === 'modal') {
                    this.backdrop.style.display = 'block';
                    document.body.classList.add('blurred');
                }
            }
            
            showGuestForm() {
                this.hideAll();
                document.getElementById('asgouest-form-container').style.display = 'block';
                this.currentView = 'guest-form';
                
                if (this.config.displayMode === 'modal') {
                    this.backdrop.style.display = 'block';
                    document.body.classList.add('blurred');
                }
            }
            
            showVerification(phone,id) {
                this.hideAll();
                
                document.getElementById('number_verifikasi').innerHTML=phone;
                document.getElementById('veritikasi_id').value=id;
                document.getElementById('asgouest-verifikasi-container').style.display = 'block';
                this.currentView = 'verification';
                
                if (this.config.displayMode === 'modal') {
                    this.backdrop.style.display = 'block';
                    document.body.classList.add('blurred');
                }
            }
            
            showThankYou() {
                this.hideAll();
                document.getElementById('asgouest-thank-container').style.display = 'block';
                this.currentView = 'thank-you';
                
                if (this.config.displayMode === 'modal') {
                    this.backdrop.style.display = 'block';
                    document.body.classList.add('blurred');
                }
            }
            
            hide() {
                this.hideAll();
                
                if (this.config.displayMode === 'modal') {
                    this.backdrop.style.display = 'none';
                    document.body.classList.remove('blurred');
                }
                
                this.currentView = null;
            }
            
            hideAll() {
                const allContainers = this.container.querySelectorAll('.login-container');
                allContainers.forEach(container => {
                    container.style.display = 'none';
                });
            }
            
            async handleLogin() {
                const email = document.getElementById('emailLGN').value;
                const password = document.getElementById('passwordLGN').value;
                
                // Here you would typically make an API call to authenticate
                console.log('Login attempt with:', { email, password });
                let fromTemplate = await this.getModule('template');
                await this.getModule('loginHub').get_login();
				await window.fai.checkTemplateLogin();
                let toTemplate = await this.getModule('template');
				
                // Simulate successful login
                this.hide(); 
				if(fromTemplate!=toTemplate){
					await window.fai.initializeApp();
				}
            }
            
            async handleRegister() {
                const form = document.querySelector('#register-modal form');
                const formData = new FormData(form);
                const data = Object.fromEntries(formData.entries());
                
                console.log('Registration attempt with:', data);
                await this.getModule('loginHub').save_register(data);
				await window.fai.checkTemplateLogin();
                let toTemplate = await this.getModule('template');
                
                this.hide();
            }
            
            async handleGuestSubmit() {
                const phone = document.getElementById('nowa').value;
                    
                     
                // Here you would typically send verification code
                console.log('Guest checkout with phone:', phone);
                let msg =  await this.getModule('loginHub').get_guest(phone);
                // Show verification screen
                if(msg.success){

                    this.showVerification(phone,msg.id_apps_user);
                }
            }
            
            async handleVerification() {
                const code = document.getElementById('verificationCode').value;
                const id = document.getElementById('veritikasi_id').value;
                
                // Here you would typically verify the code
                console.log('Verification attempt with code:', code);
                await this.getModule('loginHub').verifikasi_code(code,id);
                // Show thank you screen
               // this.showThankYou();
                
                // Auto-close after 2 seconds
               
            }
            
            async handleResendCode() {
                // Here you would typically resend the verification code
                console.log('Resending verification code');
                const id = document.getElementById('veritikasi_id').value;
                await this.getModule('loginHub').resend_wa(id);
                // Reset OTP inputs
                const inputs = document.querySelectorAll('.otp-input');
                inputs.forEach((input, index) => {
                    input.value = '';
                    if (index > 0) {
                        input.setAttribute('disabled', 'disabled');
                    }
                });
                
                document.getElementById('verificationCode').value = '';
            }
            
            // Public method to show the login interface
            show(config={}) {
				this.config = {
                    container: document.body,
                    displayMode: 'modal', // 'modal' or 'full-page'
                    elements: ['login', 'register'],
                    isCanAsGuest: true,
                    isCanAsSSO: false,
                    isDefaultLogin: true,
                    verificationMethod: 'sms', // 'sms' or 'email'
                    ...config
                };
				  this.init();
				  if(this.config.isDefaultLogin)
                this.showLogin();
            }
        

       
}
export class Login {
	async checkLoginStatus() {
            return new Promise((resolve, reject) => {
                const request = indexedDB.open("myAppDB", 1);

                request.onerror = () => reject("Database gagal dibuka");
                request.onsuccess = () => {
                    const db = request.result;
                    const tx = db.transaction("session", "readonly");
                    const store = tx.objectStore("session");
                    const getRequest = store.get("current");
                    getRequest.onsuccess = () => {
                        const session = getRequest.result;
                        console.log("LOGIN", session);
                        if (session && session.isLoggedIn) {
                            resolve(session); // Sudah login
                        } else {
                            resolve(false); // Belum login
                        }
                    };

                    getRequest.onerror = () => reject("Gagal membaca data session");
                };

                request.onupgradeneeded = (event) => {
                    const db = event.target.result;
                    if (!db.objectStoreNames.contains("session")) {
                        db.createObjectStore("session", {
                            keyPath: "id"
                        });
                    }
                };
            });
        }
		async open_register() {
            $("#login-container").hide();
            $("#asgouest-form-container").hide();
            $("#register-modal").show();
        }

        async open_login() {
            document.body.classList.add("blurred");
            $("#register-modal").hide();
            $("#login-container").show();
            $("#asgouest-form-container").hide();
        }

        async close_login() {
            document.body.classList.remove("blurred");
            $("#register-modal").hide();
            $("#login-container").hide();
            $("#asgouest-form-container").hide();
        }

        async close_all() {
            document.body.classList.remove("blurred");
            $("#toko-dropship-container").hide();
            $("#alamat-penerima-container").hide();
            $("#register-modal").hide();
            $("#login-container").hide();
            $("#asgouest-form-container").hide();
        }

        async open_guest() {
            $("#register-modal").hide();
            $("#asgouest-form-container").show();
            $("#login-container").hide();
        }

        async open_verifikasi() {

            $("#register-modal").hide();
            $("#asgouest-form-container").hide();
            $("#login-container").hide();

            $("#asgouest-verifikasi-container").show();
        }
}