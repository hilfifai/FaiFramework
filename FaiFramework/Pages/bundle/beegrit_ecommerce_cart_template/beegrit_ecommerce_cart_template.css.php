<style>
  .form-selectgroup {
    display: inline-flex;
    margin: 0 -.5rem -.5rem 0;
    flex-wrap: wrap;
  }

  .form-selectgroup .form-selectgroup-item {
    margin: 0 .5rem .5rem 0;
  }

  .form-selectgroup-vertical {
    flex-direction: column;
  }

  .form-selectgroup-item {
    display: block;
    position: relative;
  }

  .form-selectgroup-input {
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
    opacity: 0;
  }

  .form-selectgroup-label {
    position: relative;
    display: block;
    min-width: calc(1.4285714em + 0.875rem + 2px);
    margin: 0;
    padding: 0.4375rem 0.75rem;
    font-size: 0.875rem;
    line-height: 1.4285714;
    color: #656d77;
    background: #ffffff;
    text-align: center;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid #dadcde;
    border-radius: 3px;
    transition: border-color .3s, background .3s, color .3s;
  }

  .form-selectgroup-label .icon:only-child {
    margin: 0 -.25rem;
  }

  .form-selectgroup-label:hover {
    color: #232e3c;
  }

  .form-selectgroup-check {
    display: inline-block;
    width: 1rem;
    height: 1rem;
    border: 1px solid rgba(101, 109, 119, 0.24);
    vertical-align: middle;
  }

  .form-selectgroup-input[type="checkbox"]+.form-selectgroup-label .form-selectgroup-check {
    border-radius: 4px;
  }

  .form-selectgroup-input[type="radio"]+.form-selectgroup-label .form-selectgroup-check {
    border-radius: 50%;
  }

  .form-selectgroup-input:checked+.form-selectgroup-label .form-selectgroup-check {
    background-color: #009688;
    background-repeat: repeat;
    background-position: center;
    background-size: 1rem;
    border-color: rgba(101, 109, 119, 0.24);
  }

  .form-selectgroup-input[type="checkbox"]:checked+.form-selectgroup-label .form-selectgroup-check {
    }

    .form-selectgroup-input[type="radio"]:checked+.form-selectgroup-label .form-selectgroup-check {
      }

      .form-selectgroup-input:checked+.form-selectgroup-label {
        z-index: 1;
        color: #009688;
        background: #0096880d;
        border-color: #11aa97;
      }

      .form-selectgroup-input:focus+.form-selectgroup-label {
        z-index: 2;
        color: #009688;
        border-color: #11aa97;
        /* box-shadow: 0 0 0 0.25rem rgba(32, 107, 196, 0.25);*/
      }

      /**
Alternate version of form select group
*/
      .form-selectgroup-boxes .form-selectgroup-label {
        text-align: left;
        padding: 1rem 1rem;
        color: inherit;
      }

      .form-selectgroup-boxes .form-selectgroup-input:checked+.form-selectgroup-label {
        color: inherit;
      }

      .form-selectgroup-boxes .form-selectgroup-input:checked+.form-selectgroup-label .form-selectgroup-title {
        color: #009688;
      }

      .form-selectgroup-boxes .form-selectgroup-input:checked+.form-selectgroup-label .form-selectgroup-label-content {
        opacity: 1;
      }

      .form-selectgroup-boxes .form-selectgroup-label {
        text-align: left;
        padding: 1rem 1rem;
        color: inherit;
      }

      .form-selectgroup-boxes .form-selectgroup-input:checked+.form-selectgroup-label {
        color: inherit;
      }

      .form-selectgroup-boxes .form-selectgroup-input:checked+.form-selectgroup-label .form-selectgroup-title {
        color: #009688;
      }

      .form-selectgroup-boxes .form-selectgroup-input:checked+.form-selectgroup-label .form-selectgroup-label-content {
        opacity: 1;
      }

      /**
Select group
*/
      .form-selectgroup-pills {
        flex-wrap: wrap;
        align-items: flex-start;
      }

      .form-selectgroup-pills .form-selectgroup-item {
        flex-grow: 0;
      }

      .form-selectgroup-pills .form-selectgroup-label {
        border-radius: 50px;
      }
</style>
<style>
  .input-number input[type="number"] {

    border-radius: 10px;
  }

  .input-number .qty-up {

    border-radius: 0 10px 0 0;
  }

  .input-number .qty-down {

    border-radius: 0 0 10px 0;
  }
  /* Container Utama */
.discount__content {
    background: #fdfdfd;
    padding: 20px;
    border: 1px solid #eee;
    border-radius: 8px;
    margin-bottom: 20px;
}

/* Judul Voucher */
.discount__content h6 {
    color: #1c1c1c;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 15px;
    font-size: 14px;
    letter-spacing: 1px;
}

/* Form Wrapper - Menggunakan Relative Positioning */
.discount__content form {
    position: relative;
    width: 100%;
    margin-bottom: 15px;
}

/* Input Field */
.discount__content form input {
    width: 100%;
    height: 50px;
    font-size: 14px;
    color: #444;
    padding-left: 20px;
    padding-right: 100px; /* Memberi ruang untuk tombol di kanan */
    border: 1px solid #ddd;
    border-radius: 50px; /* Bentuk Pill/Oval */
    outline: none;
    transition: all 0.3s;
    background: #fff;
}

.discount__content form input:focus {
    border-color: #ca1515; /* Merah saat aktif */
}

/* Tombol Apply */
.discount__content form .site-btn {
    position: absolute;
    right: 4px;
    top: 4px;
    height: 42px; /* Sedikit lebih kecil dari input */
    border: none;
    background: #ca1515; /* Warna utama */
    color: #ffffff;
    padding: 0 25px;
    border-radius: 40px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.3s;
}

.discount__content form .site-btn:hover {
    background: #a31111;
}

/* --- Styling untuk Custom Tags (Voucher Aktif & List) --- */

/* Voucher yang sedang digunakan (Success Alert style) */
voucher_digunakan {
    display: block;
    margin-top: 10px;
    padding: 10px 15px;
    background-color: #d4edda; /* Hijau muda */
    color: #155724; /* Teks hijau tua */
    border: 1px solid #c3e6cb;
    border-radius: 5px;
    font-size: 13px;
}

/* List Voucher yang tersedia */
voucher_list {
    display: block;
    margin-top: 15px;
    border-top: 1px dashed #ddd;
    padding-top: 10px;
}

/* Contoh jika voucher list berisi item (div/li) */
voucher_list > div {
    padding: 8px 0;
    font-size: 13px;
    color: #666;
    border-bottom: 1px solid #f1f1f1;
}
</style>