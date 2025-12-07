<style>


learderboard {
width: 90%;
margin: 50px;
height: 43rem;
background-color: #ffffff;
-webkit-box-shadow: 0px 5px 15px 8px #e4e7fb;
box-shadow: 0px 5px 15px 8px #e4e7fb;
display: flex;
flex-direction: column;
align-items: center;
border-radius: 0.5rem;
}

learderboard #header {
width: 100%;
display: flex;
align-items: center;
justify-content: space-between;
padding: 2.5rem 2rem;
}

learderboard .share {
width: 4.5rem;
height: 3rem;
background-color: #f55e77;
border: 0;
border-bottom: 0.2rem solid #c0506a;
border-radius: 2rem;
cursor: pointer;
}

learderboard .share:active {
border-bottom: 0;
}

learderboard .share i {
color: #fff;
font-size: 2rem;
}

learderboard h1 {
font-family: "Rubik", sans-serif;
font-size: 1.7rem;
color: #141a39;
text-transform: uppercase;
cursor: default;
}

learderboard #leaderboard {
width: 100%;
position: relative;
}

learderboard table {
width: 100%;
border-collapse: collapse;
table-layout: fixed;
color: #141a39;
cursor: default;
}

learderboard tr {
transition: all 0.2s ease-in-out;
border-radius: 0.2rem;
}

learderboard tr:not(:first-child):hover {
background-color: #fff;
transform: scale(1.1);
-webkit-box-shadow: 0px 5px 15px 8px #e4e7fb;
box-shadow: 0px 5px 15px 8px #e4e7fb;
}

learderboard tr:nth-child(odd) {
background-color: #f9f9f9;
}

learderboard tr:nth-child(1) {
color: #fff;
}

learderboard td {
height: 5rem;
font-family: "Rubik", sans-serif;
font-size: 1.4rem;
padding: 1rem 2rem;
position: relative;
}

learderboard .number {
width: 1rem;
font-size: 2.2rem;
font-weight: bold;
text-align: left;
}

learderboard .name {
text-align: left;
font-size: 1.2rem;
}

learderboard .points {
font-weight: bold;
font-size: 1.3rem;
display: flex;
justify-content: flex-end;
align-items: center;
}

learderboard .points:first-child {
width: 10rem;
}

learderboard .gold-medal {
height: 3rem;
margin-left: 1.5rem;
}

learderboard .ribbon {
width: 102%;
height: 5.5rem;
top: -0.5rem;
background-color: #5c5be5;
position: absolute;
left: -1rem;
-webkit-box-shadow: 0px 15px 11px -6px #7a7a7d;
box-shadow: 0px 15px 11px -6px #7a7a7d;
}

learderboard .ribbon::before {
content: "";
height: 1.5rem;
width: 1.5rem;
bottom: -0.8rem;
left: 0.35rem;
transform: rotate(45deg);
background-color: #5c5be5;
position: absolute;
z-index: -1;
}

learderboard .ribbon::after {
content: "";
height: 1.5rem;
width: 1.5rem;
bottom: -0.8rem;
right: 0.35rem;
transform: rotate(45deg);
background-color: #5c5be5;
position: absolute;
z-index: -1;
}

learderboard #buttons {
width: 100%;
margin-top: 3rem;
display: flex;
justify-content: center;
gap: 2rem;
}

learderboard .exit {
width: 11rem;
height: 3rem;
font-family: "Rubik", sans-serif;
font-size: 1.3rem;
text-transform: uppercase;
color: #7e7f86;
border: 0;
background-color: #fff;
border-radius: 2rem;
cursor: pointer;
}

learderboard .exit:hover {
border: 0.1rem solid #5c5be5;
}

learderboard .continue {
width: 11rem;
height: 3rem;
font-family: "Rubik", sans-serif;
font-size: 1.3rem;
color: #fff;
text-transform: uppercase;
background-color: #5c5be5;
border: 0;
border-bottom: 0.2rem solid #3838b8;
border-radius: 2rem;
cursor: pointer;
}

learderboard .continue:active {
border-bottom: 0;
}

learderboard @media (max-width: 740px) {
* {
font-size: 70%;
}
}

learderboard @media (max-width: 500px) {
* {
font-size: 55%;
}
}

learderboard @media (max-width: 390px) {
* {
font-size: 45%;
}
}
</style><learderboard>
<div id="header">
<h1>Ranking</h1>
<button class="share">
<i class="ph ph-share-network"></i>
</button>
<ul class="nav nav-lt-tab " id="pills-tab" role="tablist">
  <li class="nav-item">
<a class="nav-link" href="http://localhost/FrameworkServer/FaiServer/page/CajyQrxFqsRiF6wwBwzRMM4O5" "="">Muktabaah</a>
</li>
  <li class="nav-item">
<a class="nav-link" href="http://localhost/FrameworkServer/FaiServer/page/So5e7BrxNRk2KLHCCR8dHOQpl" "="">Board</a>
</li>
  <li class="nav-item">
<a class="nav-link" href="http://localhost/FrameworkServer/FaiServer/page/6Bdm6lhoRCxhliKVHg9d5TP3i" "="">Report</a>
</li>
  <li class="nav-item">
<a class="nav-link" href="http://localhost/FrameworkServer/FaiServer/page/cJQgZ1nTkJFLQF2K85uVZCTKa" "="">Leader Board</a>
</li>

</ul>
</div>
<div id="leaderboard">
<div class="ribbon"></div>
<table>
<tbody><tr>
<td class="number">1</td>
<td class="name">Lee Taeyong</td>
<td class="points">
258.244 <img class="gold-medal" src="https://github.com/malunaridev/Challenges-iCodeThis/blob/master/4-leaderboard/assets/gold-medal.png?raw=true" alt="gold medal">
</td>
</tr>
<tr>
<td class="number">2</td>
<td class="name">Mark Lee</td>
<td class="points">258.242</td>
</tr>
<tr>
<td class="number">3</td>
<td class="name">Xiao Dejun</td>
<td class="points">258.223</td>
</tr>
<tr>
<td class="number">4</td>
<td class="name">Qian Kun</td>
<td class="points">258.212</td>
</tr>
<tr>
<td class="number">5</td>
<td class="name">Johnny Suh</td>
<td class="points">258.208</td>
</tr>
</tbody></table>
<div id="buttons">
<button class="exit">Exit</button>
<button class="continue">Continue</button>
</div>
</div>
</learderboard>