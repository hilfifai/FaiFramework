<li>
<!--<span class="icon_search search-switch"></span>-->
<form action="#">

<div class="search-be3">
<!--            <select id="searchType" name="searchType">-->
<!--<option value="1">Search in books</option>-->
<!--<option value="2">Search in videos</option>-->
<!--</select>-->

<input type="text" name="searchInput" placeholder="Search...">
<button><i class="fa-solid fa-magnifying-glass"></i></button>
</form>
</div>


<style>
.search-be3{

border: 1px solid rgb(255, 255, 255);
border-radius: 15px;

align-items: center;
padding: 5px;
background: white;  border: 1px solid rgba(0, 0, 0, 0.35);
}
.search-be3 select {
padding: 0;
border: none;
outline: none;
cursor: pointer;
background: transparent;
}
.search-be3 input{

padding: 0;
border: none;
outline:none;
margin-left: 10px;

}
.search-be3 button{
padding: 0;
border: none;
outline:none;
font-size: 25px;
margin: auto;
margin-right: 0;
color: rgb(139, 139, 139);
background: white;

}
@media only screen and (max-width: 600px) {
.search-be3 {
width: 100%;
flex-wrap: wrap;
}
.search-be3 select {
width: 100%;
}
}
</style>
</li>