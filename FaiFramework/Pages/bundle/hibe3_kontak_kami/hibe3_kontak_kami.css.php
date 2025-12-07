<style>
    
.contact-page-container {
    max-width: 1100px;
    margin: 0 auto;
    padding: 24px;
}

.contact-header {
    text-align: center;
    margin-bottom: 40px;
}

.contact-header h1 {
    font-size: 36px;
    color: #333;
    margin-bottom: 10px;
}

.contact-intro {
    font-size: 18px;
    color: #666;
    max-width: 600px;
    margin: 0 auto;
}

.contact-main-content {
    display: flex;
    gap: 40px;
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.contact-info, .contact-form {
    flex: 1;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    margin-bottom: 25px;
}

.info-item i {
    flex-shrink: 0;
    font-size: 20px;
    color: #ff6600; /* Warna oranye primer */
    background-color: #fff0e6; /* Latar belakang oranye muda */
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.info-item div strong {
    display: block;
    font-size: 18px;
    color: #333;
    margin-bottom: 5px;
}

.info-item div p {
    margin: 0;
    color: #555;
    line-height: 1.6;
}

.social-links {
    margin-top: 30px;
    display: flex;
    gap: 15px;
}

.social-links a {
    color: #fff;
    background-color: #ff6600; /* Warna oranye primer */
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    transition: transform 0.3s ease, background-color 0.3s ease;
}

.social-links a:hover {
    transform: scale(1.1);
    background-color: #e65c00; /* Oranye lebih gelap */
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 8px;
    color: #444;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ced4da;
    border-radius: 6px;
    font-size: 16px;
    font-family: 'Poppins', sans-serif;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #ff6600; /* Garis batas oranye saat fokus */
    box-shadow: 0 0 0 3px rgba(255, 102, 0, 0.2); /* Efek glow oranye */
}

.map-section {
    margin-top: 50px;
    text-align: center;
}
.map-section h2 {
    margin-bottom: 20px;
}
.map-section iframe {
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

/* Penyesuaian untuk layar kecil (Mobile) */
@media (max-width: 768px) {
    .contact-main-content {
        flex-direction: column;
    }
}   
</style>