<style>
    
.profile-container {
    max-width: 800px;
    margin: 20px auto;
    padding: 24px;
}

.profile-header {
    text-align: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.profile-picture {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 15px;
    border: 3px solid #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.profile-header h1 {
    margin: 0 0 5px 0;
}

.profile-header p {
    margin: 0;
    color: #666;
    font-size: 16px;
}

.profile-header .btn {
    margin-top: 15px;
}

.profile-section {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.profile-section h3 {
    margin-top: 0;
    margin-bottom: 15px;
    border-bottom: 1px solid #f0f0f0;
    padding-bottom: 10px;
}

.info-row {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    font-size: 16px;
}
.info-row strong i {
    margin-right: 10px;
    color: #ff6600;
}

.address-card {
    border: 1px solid #e0e0e0;
    padding: 15px;
    border-radius: 6px;
    margin-bottom: 15px;
}
.address-card.default {
    border-left: 4px solid #ff6600;
}
.address-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}
.address-card p {
    margin: 0;
    color: #555;
    line-height: 1.6;
}
.default-badge {
    background-color: #ff6600;
    color: white;
    padding: 3px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
}

/* GAYA UNTUK MODE EDIT */
.hidden {
    display: none !important;
}

#edit-mode form small {
    display: block;
    margin-top: 5px;
    font-size: 13px;
    color: #777;
}

.address-form-card {
    border: 1px dashed #ccc;
    padding: 15px;
    border-radius: 6px;
    margin-bottom: 15px;
}

.form-check {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 10px;
}
.form-check input[type="radio"] {
    width: auto;
}

#add-address-btn {
    width: 100%;
    margin-top: 10px;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
}
</style>