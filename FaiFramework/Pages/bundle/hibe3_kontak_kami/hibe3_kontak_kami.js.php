<script>
function normalizePhoneNumber(phone) {
    // Hapus semua karakter non-digit
    let digits = phone.replace(/\D/g, '');
    
    // Jika diawali dengan 0, ganti dengan 62
    if (digits.startsWith('0')) {
        digits = '62' + digits.substring(1);
    }
    // Jika diawali dengan +62, hapus +
    else if (digits.startsWith('62')) {
        digits = digits;
    }
    // Jika diawali dengan 8 (tanpa kode negara), tambahkan 62
    else if (digits.startsWith('8')) {
        digits = '62' + digits;
    }
    // Jika tidak ada kondisi di atas, asumsikan sudah benar atau tidak valid
    
    // Kembalikan nomor yang sudah dinormalisasi
    return digits;
}
 function sendWa() {
            nama_lengkap=document.getElementById("nama_lengkap").value;
            alamat_email=document.getElementById("alamat_email").value;
            wa_no=document.getElementById("wa_no").value;
            subject_pesan=document.getElementById("subject_pesan").value;
            message_pesan=document.getElementById("message_pesan").value;
            phone=document.getElementById("phone").value;
    
            text = "Assalamualaikum%0A";
			text += "Nama Lengkap: " + nama_lengkap + "%0A";
			text += "Alamat Email: " + alamat_email + "%0A";
			text += "Nomor WhatsApp: " + wa_no + "%0A";
			text += "Subject Pesan: " + subject_pesan + "%0A";
			text += "Pesan: " + message_pesan;
            // document.getElementById("text").value=text;
            document.getElementById("submit").href="https://wa.me/"+normalizePhoneNumber(phone)+"?text="+text;
        }
</script>