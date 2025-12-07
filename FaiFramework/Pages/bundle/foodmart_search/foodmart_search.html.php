    <div class="search-bar2 row bg-light p-2 my-2 rounded-4">
        <div class="col-md-4 d-none d-md-block">
            <select class="form-select border-0 bg-transparent" name="search_kategori">
                <option value="">Kategori Toko</option>
                <KATEGORI></KATEGORI>
            </select>
        </div>
        <div class="col-10 col-md-6">


            <input type="text" name="keyword" id="search_produk_input" onkeyup="search_produk()" class="form-control border-0 bg-transparent" placeholder="Enter Keyword" />

        </div>
        <div class="col-2">
            <button type="button" onclick="search_produk()" class="btn rounded-0" style="margin: 0;padding: 5px;padding-left: 0px;padding-right: 0px;">

                <svg xmlns="{HTTP}://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
                </svg>
            </button>
        </div>
    </div>
<script>
    document.getElementById('search-form').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            this.submit();
        }
    });
</script>
