<style>
    /* ----------------- Dropdown Styles ----------------- */
    .dropdown-container-be3 {
        display: inline-block;
        padding: 10px;
    }

    .dropdown-container-be3 .dropdown {
        position: relative;
    }

    .dropdown-container-be3 .dropdown[open] .with-down-arrow::after {
        content: "\e5c7";
    }

    .dropdown-container-be3 .dropdown[open] summary {
        background: #fff 10;
    }

    .dropdown-container-be3 .dropdown summary {
        list-style: none;
        display: inline-block;
        cursor: pointer;
        border-radius: 6px;
    }

    .dropdown-container-be3 .dropdown summary.avatar {
        border-radius: 50px;
    }

    .dropdown-container-be3 .dropdown summary.avatar img {
        width: 40px;
        height: 40px;
        border-radius: 50px;
        display: inline-block;
        margin: 0;
    }

    .dropdown-container-be3 .dropdown summary .with-down-arrow {
        display: inline-flex;
        padding: 5px;
        align-items: center;
        color: #fff;
        line-height: 1;
    }

    .dropdown-container-be3 .dropdown summary .with-down-arrow::after {
        content: "\e5c5";
        font-family: "Material Symbols Outlined";
        font-weight: normal;
        font-style: normal;
        font-size: 1.5rem;
        line-height: 1;
        letter-spacing: normal;
        text-transform: none;
        display: inline-block;
        white-space: nowrap;
        word-wrap: normal;
        direction: ltr;
        -webkit-font-smoothing: antialiased;
    }

    .dropdown-container-be3 .dropdown.left ul {
        left: 0;
    }

    .dropdown-container-be3 .dropdown.right ul {
        right: 0;
    }

    .dropdown-container-be3 .dropdown ul {
        padding: 0;
        margin: 0;
        box-shadow: 0 0 10px #000 30;
        min-width: max-content;
        position: absolute;
        top: 100%;
        border-radius: 10px;
        background-color: #fff;
        z-index: 2;
        min-width: 200px;
    }

    .dropdown-container-be3 .dropdown ul li {
        list-style-type: none;
        display: block;
        /* If you use divider & borders, it's best to use top borders */
        /*border-top: 1px solid #ccc;
	*/
    }

    .dropdown-container-be3 .dropdown ul li:first-of-type {
        border: none;
        background-color: #f2f2f2;
    }

    .dropdown-container-be3 .dropdown ul li p {
        padding: 10px 15px;
        margin: 0;
    }

    .dropdown-container-be3 .dropdown ul li a {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding: 10px 15px;
        text-decoration: none;
        line-height: 1;
        color: #333;
    }

    .dropdown-container-be3 .dropdown ul li a:hover {
        color: #ff34b2;
    }

    .dropdown-container-be3 .dropdown ul li:first-of-type {
        border-radius: 10px 10px 0 0;
    }

    .dropdown-container-be3 .dropdown ul li:last-of-type {
        border-radius: 0 0 10px 10px;
    }

    .dropdown-container-be3 .dropdown ul li.divider {
        border: none;
        border-bottom: 1px solid #333;
        /* * removes border from Li after the divider element * best used in combination with top borders on other LIs */
    }

    .dropdown-container-be3 .dropdown ul li.divider~li {
        border: none;
    }
</style>