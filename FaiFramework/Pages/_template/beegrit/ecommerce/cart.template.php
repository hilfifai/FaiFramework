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
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' width='16' height='16'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 8.5l2.5 2.5l5.5 -5.5'/%3e%3c/svg%3e");
    }

    .form-selectgroup-input[type="radio"]:checked+.form-selectgroup-label .form-selectgroup-check {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3ccircle r='3' fill='%23ffffff' cx='8' cy='8' /%3e%3c/svg%3e");
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
</style>
<div class="container-fluid">
    <div class="section-title">
        <h3 class="title">
            Cart
        </h3>
    </div>
    <div class="row ">
        <div class="col-xxl-9 col-12">
            <TOKO></TOKO>
        </div>
        <div class="col-xxl-3 col-12">
            <div class="card mb-4 mt-4 mt-xxl-0" id="summary">
                <SUMMARY></SUMMARY>
                <BUTTON-CEKHOUT></BUTTON-CEKHOUT>
            </div>

        </div>
    </div>
</div> 