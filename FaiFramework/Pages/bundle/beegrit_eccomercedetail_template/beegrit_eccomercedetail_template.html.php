<div class="content p-0 mt-0 mb-0">

<div class="ps-md-5" style="">

<!-- Page title -->
<style>
/* Please ? this if you like it! */
.sidebarEffectSub {
color: #fff;
background: #009688;
}

.navbar .navbar-nav .nav-link {
color: #fff;
}

.section-fluid-main {
position: relative;
display: block;
width: 100%;
overflow: hidden;
}

[type="radio"]:checked,
[ type="radio"]:not(:checked) {
position: absolute;
visibility: hidden;
}

.color-btn:checked+label,
.color-btn:not(:checked)+label {
position: relative;
height: 40px;
transition: all 200ms linear;
border-radius: 4px;
width: 40px;
overflow: hidden;
border: none;
cursor: pointer;
color: #ffeba7;
margin-right: 10px;
box-shadow: 0 12px 35px 0 rgba(16, 39, 112, .25);
z-index: 10;
background-position: center;
background-size: cover;
border: 3px solid transparent;
}

.color-btn:checked+label {
border-color: #434343;
transform: scale(1.1);
}

label.first-color {

background-image: url('https://assets.codepen.io/1462889/mat1.jpg');
}

label.color-2 {
background-image: url('https://assets.codepen.io/1462889/mat2.jpg');
}

label.color-3 {
background-image: url('https://assets.codepen.io/1462889/mat3.jpg');
}

label.color-4 {
background-image: url('https://assets.codepen.io/1462889/mat4.jpg');
}

label.color-5 {
background-image: url('https://assets.codepen.io/1462889/mat5.jpg');
}

label.color-6 {
background-image: url('https://assets.codepen.io/1462889/mat6.jpg');
}

.img-wrap {
position: absolute;
top: 100px;
left: 0;

height: 410px;
display: inline-block;
z-index: 9;
transition: all 550ms linear;
transition-delay: 100ms;
background-position: center top;
background-size: 100%;
background-repeat: no-repeat;
background-image: url('https://assets.codepen.io/1462889/ch1.png');
opacity: 0;
}

.color-btn:checked~.img-wrap.chair-1 {
opacity: 1;
animation: shake 0.7s cubic-bezier(.36, .07, .19, .97) both;
}

.img-wrap.chair-2 {
background-image: url('https://assets.codepen.io/1462889/ch2.png');
}

.for-color-2:checked~.img-wrap.chair-2 {
opacity: 1;
animation: shake 0.7s cubic-bezier(.36, .07, .19, .97) both;
}

.img-wrap.chair-3 {
background-image: url('https://assets.codepen.io/1462889/ch3.png');
}

.for-color-3:checked~.img-wrap.chair-3 {
opacity: 1;
animation: shake 0.7s cubic-bezier(.36, .07, .19, .97) both;
}

.img-wrap.chair-4 {
background-image: url('https://assets.codepen.io/1462889/ch4.png');
}

.for-color-4:checked~.img-wrap.chair-4 {
opacity: 1;
animation: shake 0.7s cubic-bezier(.36, .07, .19, .97) both;
}

.img-wrap.chair-5 {
background-image: url('https://assets.codepen.io/1462889/ch5.png');
}

.for-color-5:checked~.img-wrap.chair-5 {
opacity: 1;
animation: shake 0.7s cubic-bezier(.36, .07, .19, .97) both;
}

.img-wrap.chair-6 {
background-image: url('https://assets.codepen.io/1462889/ch6.png');
}

.for-color-6:checked~.img-wrap.chair-6 {
opacity: 1;
animation: shake 0.7s cubic-bezier(.36, .07, .19, .97) both;
}

@keyframes shake {

10%,
90% {
transform: translate3d(-1px, 0, 0) rotate(-1deg);
}

20%,
80% {
transform: translate3d(2px, 0, 0) rotate(2deg);
}

30%,
50%,
70% {
transform: translate3d(-3px, 0, 0) rotate(-3deg);
}

40%,
60% {
transform: translate3d(3px, 0, 0) rotate(3deg);
}
}


.back-color {

width: 100%;
height: 100%;
display: block;
z-index: 1;
background-image: linear-gradient(196deg, #f1a9a9, #e66767);
transition: all 250ms linear;
transition-delay: 300ms;
}

.back-color.chair-2 {
background-image: linear-gradient(196deg, #4c4c4c, #262626);
opacity: 0;
}

.for-color-2:checked~.back-color.chair-2 {
opacity: 1;
}

.back-color.chair-3 {
background-image: linear-gradient(196deg, #8a9fb2, #5f7991);
opacity: 0;
}

.for-color-3:checked~.back-color.chair-3 {
opacity: 1;
}

.back-color.chair-4 {
background-image: linear-gradient(196deg, #97afc3, #6789a7);
opacity: 0;
}

.for-color-4:checked~.back-color.chair-4 {
opacity: 1;
}

.back-color.chair-5 {
background-image: linear-gradient(196deg, #afa6a0, #8c7f76);
opacity: 0;
}

.for-color-5:checked~.back-color.chair-5 {
opacity: 1;
}

.back-color.chair-6 {
background-image: linear-gradient(196deg, #aaadac, #838786);
opacity: 0;
}

.for-color-6:checked~.back-color.chair-6 {
opacity: 1;
}

.info-wrap {
position: relative;

z-index: 10;
display: block;
text-align: left;
}

.title-up {
font-family: 'Poppins', sans-serif;
font-weight: 700;
text-transform: uppercase;
letter-spacing: 1px;
font-size: 13px;
line-height: 1.2;
color: #fff;
margin-top: 0;
margin-bottom: 10px;
}

h2 {
font-family: 'Poppins', sans-serif;
font-weight: 800;
font-size: 34px;
line-height: 1.2;
color: #fff;
margin-top: 0;
margin-bottom: 10px;
}

h4 {
font-family: 'Poppins', sans-serif;
font-weight: 500;
font-size: 26px;
line-height: 1.2;
color: #fff;
margin-top: 0;
margin-bottom: 30px;
}

h4 span {
text-decoration: line-through;
font-size: 20px;
opacity: 0.6;
padding-left: 15px;
}

h5 {
font-family: 'Poppins', sans-serif;
font-weight: 600;
font-size: 18px;
line-height: 1.2;
color: #fff;
margin-top: 0;
margin-bottom: 20px;
}

.desc-btn:checked+label,
.desc-btn:not(:checked)+label {
position: relative;
transition: all 200ms linear;
display: inline-block;
border: none;
cursor: pointer;
color: #ffeba7;
font-family: 'Poppins', sans-serif;
font-weight: 600;
font-size: 18px;
line-height: 1.2;
color: #fff;
margin-right: 25px;
opacity: 0.5;
}

.desc-btn:checked+label {
opacity: 1;
}

.desc-btn:not(:checked)+label:hover {
opacity: 0.8;
}

.desc-sec {
padding-top: 20px;
padding-bottom: 30px;
transition: all 250ms linear;
opacity: 0;
overflow: hidden;
pointer-events: none;
transform: translateY(20px);
}

.desc-sec.accor-2 {
position: absolute;
top: 25px;
left: 0;
width: 100%;
z-index: 2;
}

#desc-1:checked~.desc-sec.accor-1 {
opacity: 1;
pointer-events: auto;
transform: translateY(0);
}

#desc-2:checked~.desc-sec.accor-2 {
opacity: 1;
pointer-events: auto;
transform: translateY(0);
}

.section-inline {
position: relative;
display: inline-block;
margin-right: 20px;
}

.section-inline p span {
font-size: 30px;
line-height: 1.1;
}

.btn {
position: relative;
font-family: 'Poppins', sans-serif;
font-weight: 500;
font-size: 14px;
line-height: 2;
height: 48px;
border-radius: 4px;
width: 210px;
letter-spacing: 1px;
display: -webkit-inline-flex;
display: -ms-inline-flexbox;
display: inline-flex;
-webkit-align-items: center;
-moz-align-items: center;
-ms-align-items: center;
align-items: center;
-webkit-justify-content: center;
-moz-justify-content: center;
-ms-justify-content: center;
justify-content: center;
border: none;
cursor: pointer;
overflow: hidden;
background-color: white;
color: #0aaa9b;
box-shadow: 0 6px 15px 0 rgba(16, 39, 112, .15);
transition: all 250ms linear;
text-decoration: none;
margin-top: 50px;
}

.icon {
padding-right: 7px;
font-size: 20px;
}

.btn:before {
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
content: '';
z-index: -1;
background-color: #944852;
transition: background-color 250ms 300ms ease;
}

.btn:hover {
box-shadow: 0 12px 35px 0 rgba(0, 150, 136, 0.89);
background-color: #0c554e;
color: #fff;
}

.for-color-2:checked~.info-wrap .btn:before {
background-color: #1a1a1a;
}

.for-color-3:checked~.info-wrap .btn:before {
background-color: #40566e;
}

.for-color-4:checked~.info-wrap .btn:before {
background-color: #5e89b2;
}

.for-color-5:checked~.info-wrap .btn:before {
background-color: #8c7f76;
}

.for-color-6:checked~.info-wrap .btn:before {
background-color: #5d6160;
}

.clearfix {
width: 100%;
}

.clearfix::after {
display: block;
clear: both;
content: "";
}

@media screen and (max-width: 991px) {
.section {
margin: 0 auto;
text-align: center;
max-width: calc(100% - 40px);
width: 370px;
}

label.first-color {
margin-left: 0;
}

.info-wrap {
margin-left: 0;
width: 370px;
margin: 0 auto;
text-align: center;
}

.img-wrap {
width: 375px;
height: 308px;
left: 50%;
margin-left: -190px;
}

.mob-margin {}

.qty-label {
display: flex;
justify-content: center;
}

.desc-btn:checked+label,
.desc-btn:not(:checked)+label {
margin-right: 15px;
margin-left: 15px;
}

.color-btn:checked+label,
.color-btn:not(:checked)+label {
height: 40px;
width: 40px;
margin: 5px auto;
text-align: center;
}

.section-inline {
margin: 0 5px;
}
}

@media screen and (max-width: 875px) {
.section {
width: 280px;
margin-top: 0;
padding-top: 0;
}

.info-wrap {
width: 280px;
}

.color-btn:checked+label,
.color-btn:not(:checked)+label {
height: 30px;
width: 30px;
}

.section-inline p span {
font-size: 24px;
line-height: 1.1;
}

.section-inline p {
font-size: 14px;
}

#imgFull {
padding-bottom: 0;
}
}

@keyframes shake {
0% {
transform: translate(1px, 1px) rotate(0deg);
}

10% {
transform: translate(-1px, -2px) rotate(-1deg);
}

20% {
transform: translate(-3px, 0px) rotate(1deg);
}

30% {
transform: translate(3px, 2px) rotate(0deg);
}

40% {
transform: translate(1px, -1px) rotate(1deg);
}

50% {
transform: translate(-1px, 2px) rotate(-1deg);
}

60% {
transform: translate(-3px, 1px) rotate(0deg);
}

70% {
transform: translate(3px, 1px) rotate(-1deg);
}

80% {
transform: translate(-1px, -1px) rotate(1deg);
}

90% {
transform: translate(1px, 2px) rotate(0deg);
}

100% {
transform: translate(1px, -2px) rotate(-1deg);
}
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


<!-- partial:index.partial.html -->

<div class="section-fluid-main row" style="background-image: linear-gradient(196deg,#0bbbab,#009688);transition: all 250ms linear;transition-delay: 0s;transition-delay: 300ms;margin:0">
<div class="section col-md-6" id="imgFull" style="transition: all 550ms linear;transition-delay: 0s;transition-delay: 100ms;padding-bottom: 0;">
<div style="width:100%"><svg id="Capa_1" enable-background="new 0 0 512.005 512.005" height="100" viewBox="0 0 512.005 512.005" width="100" xmlns="http://www.w3.org/2000/svg" style="fill:#009688;filter: drop-shadow(0 5px 15px rgba(0, 150, 136, 0.20))">
 <g>
     <path d="m512.004 192.508c0-10.448-8.501-18.949-18.949-18.949h-47.216c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h47.216c2.177 0 3.949 1.771 3.949 3.949v259.951l-103.457-127.207c-3.614-4.443-8.972-6.992-14.7-6.992h-87.397c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h87.396c1.194 0 2.31.531 3.063 1.457l106.828 131.351h-368.172c-1.194 0-2.311-.531-3.064-1.458l-101.59-124.91c-1.42-1.747-.824-3.51-.502-4.187.322-.678 1.315-2.253 3.566-2.253h235.448c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-131.801v-57.471c1.064.029 2.131.047 3.202.047h88.14c6.291 0 11.912-3.755 14.319-9.567 2.407-5.813 1.089-12.442-3.36-16.891l-12.683-12.683c17.591-19.995 27.565-45.138 28.461-71.862h24.729c1.055 0 2.047.411 2.792 1.156l21.044 21.044c-1.673 4.111-2.604 8.601-2.604 13.306 0 19.527 15.886 35.413 35.413 35.413 18.44 0 33.627-14.171 35.26-32.193h51.477c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-53.346c-4.866-13.751-17.993-23.632-33.39-23.632-9.329 0-17.822 3.632-24.154 9.55l-19.093-19.094c-3.579-3.579-8.337-5.55-13.399-5.55h-25.201c-1.839-19.271-8.462-37.674-19.464-53.761-2.339-3.419-7.006-4.295-10.425-1.957s-4.295 7.006-1.957 10.425c11.377 16.635 17.391 36.12 17.391 56.346 0 26.697-10.397 51.797-29.275 70.675-2.929 2.929-2.929 7.678 0 10.606l17.817 17.817c.126.126.236.236.108.544-.127.308-.282.308-.46.308h-88.14c-55.112 0-99.949-44.837-99.95-99.949 0-26.671 10.403-51.763 29.295-70.655s43.984-29.296 70.655-29.296c21.175 0 41.41 6.543 58.517 18.919 3.357 2.429 8.046 1.676 10.473-1.68 2.428-3.356 1.676-8.045-1.68-10.473-19.681-14.24-42.957-21.767-67.31-21.767-30.678 0-59.537 11.964-81.262 33.689-21.724 21.726-33.688 50.586-33.688 81.263 0 57.19 41.984 104.752 96.748 113.503v58.87h-88.647c-7.383 0-13.94 4.142-17.112 10.81-3.171 6.667-2.248 14.367 2.411 20.095l101.59 124.911c3.614 4.444 8.973 6.993 14.701 6.993h383.939c4.031.05 7.565-3.467 7.499-7.504v-281.057zm-189.928-27.581c11.255 0 20.413 9.157 20.413 20.413s-9.157 20.413-20.413 20.413-20.413-9.157-20.413-20.413 9.157-20.413 20.413-20.413z">
     </path>
     <path d="m276.722 406.47 25.889 34.017c3.289 4.322 8.495 6.902 13.926 6.902h101.018c4.784 0 9.075-2.663 11.2-6.949s1.645-9.314-1.252-13.122l-25.889-34.017c-3.289-4.322-8.495-6.902-13.926-6.902h-101.019c-4.784 0-9.076 2.663-11.2 6.95-2.124 4.288-1.644 9.315 1.253 13.121zm110.966-5.07c.776 0 1.52.369 1.989.986l22.834 30.003h-95.974c-.776 0-1.52-.369-1.989-.986l-22.834-30.003z">
     </path>
     <path d="m202.618 439.887c0 4.142 3.358 7.5 7.5 7.5h45.887c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-45.887c-4.142 0-7.5 3.358-7.5 7.5z">
     </path>
     <path d="m239.259 422.511c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-19.477c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5z">
     </path>
     <path d="m178.918 115.292c0-6.01-2.341-11.661-6.59-15.909-4.25-4.25-9.9-6.591-15.91-6.591s-11.661 2.341-15.91 6.591l-14.685 14.685-14.683-14.686c-4.25-4.25-9.9-6.59-15.91-6.59s-11.661 2.341-15.91 6.59c-4.25 4.25-6.59 9.9-6.59 15.91s2.34 11.66 6.59 15.91l14.684 14.685-14.684 14.684c-4.25 4.25-6.59 9.9-6.59 15.91s2.341 11.661 6.59 15.909c4.25 4.25 9.9 6.591 15.91 6.591s11.661-2.341 15.91-6.59l14.684-14.685 14.685 14.685c4.25 4.25 9.9 6.59 15.91 6.59s11.66-2.34 15.91-6.59 6.59-9.9 6.59-15.91-2.34-11.66-6.59-15.91l-14.685-14.685 14.685-14.685c4.249-4.249 6.589-9.899 6.589-15.909zm-17.197 5.303-19.988 19.988c-2.929 2.929-2.929 7.678 0 10.606l19.988 19.988c1.417 1.417 2.197 3.3 2.197 5.303s-.78 3.887-2.197 5.303-3.3 2.197-5.303 2.197-3.887-.78-5.303-2.197l-19.988-19.988c-1.406-1.407-3.314-2.197-5.303-2.197s-3.897.79-5.303 2.197l-19.988 19.988c-1.416 1.416-3.299 2.196-5.303 2.196s-3.887-.78-5.303-2.197c-1.417-1.416-2.197-3.299-2.197-5.303 0-2.003.78-3.887 2.197-5.303l19.987-19.988c2.929-2.929 2.929-7.678 0-10.606l-19.987-19.988c-1.417-1.417-2.197-3.3-2.197-5.303s.78-3.887 2.197-5.303c1.416-1.417 3.299-2.197 5.303-2.197s3.887.78 5.303 2.197l19.987 19.988c1.406 1.407 3.314 2.197 5.303 2.197s3.897-.79 5.303-2.197l19.988-19.988c1.417-1.417 3.299-2.197 5.303-2.197s3.886.78 5.303 2.198c1.417 1.416 2.197 3.299 2.197 5.303.001 2.003-.779 3.886-2.196 5.303z">
     </path>
     <path d="m419.83 159.372c16.281 0 29.527-13.246 29.527-29.527s-13.246-29.527-29.527-29.527-29.527 13.246-29.527 29.527 13.246 29.527 29.527 29.527zm0-44.054c8.01 0 14.527 6.517 14.527 14.527s-6.517 14.527-14.527 14.527-14.527-6.517-14.527-14.527 6.517-14.527 14.527-14.527z">
     </path>
     <path d="m344.229 104.248c1.464 1.464 3.384 2.197 5.303 2.197s3.839-.732 5.303-2.197l4.058-4.058 4.058 4.058c1.464 1.465 3.384 2.197 5.303 2.197s3.839-.732 5.303-2.197c2.929-2.929 2.929-7.677 0-10.606l-4.058-4.058 4.058-4.058c2.929-2.929 2.929-7.678 0-10.606-2.929-2.929-7.678-2.929-10.606 0l-4.058 4.058-4.058-4.058c-2.929-2.929-7.678-2.929-10.606 0-2.929 2.929-2.929 7.677 0 10.606l4.058 4.058-4.058 4.058c-2.93 2.929-2.93 7.678 0 10.606z">
     </path>
     <path d="m28.317 295.193c1.464 1.464 3.384 2.197 5.303 2.197s3.839-.732 5.303-2.197l7.065-7.065 7.065 7.065c1.464 1.464 3.384 2.197 5.303 2.197s3.839-.732 5.303-2.197c2.929-2.929 2.929-7.678 0-10.606l-7.065-7.065 7.065-7.065c2.929-2.929 2.929-7.678 0-10.606-2.929-2.929-7.678-2.929-10.606 0l-7.065 7.065-7.065-7.065c-2.929-2.929-7.678-2.929-10.606 0-2.929 2.929-2.929 7.678 0 10.606l7.065 7.065-7.065 7.065c-2.93 2.928-2.93 7.677 0 10.606z">
     </path>
 </g>
</svg></div>
</div>
<div class="section col-md-6" style="">
<div class="mob-margin">


<p class="title-up">WUI Official Store</p>
<h2 class="mb-2 pb-0">Terjemahan Syarah Durusul Lughah Jilid 2</h2>
<h4 class="mb-2 pb-0">Rp 36.000 <!--<span>$237</span>--></h4>
<div class="badge badge-sm badge-success">Potongan Tahun Rintis 50%</div>
<p class="title-up pt-0 mt-1 small">Donasi ke Baitul Mal Rp 1.000</p>

</div>
<div class="mb-3 varian">
<label class="form-label text-white">Varian Warna</label>
<div class="form-selectgroup">
 <span class="me-1" onclick="select_warna()">
     <input class="color-btn me-1" value="4HUdNyAInmU2vDHDdZTMzyZjcMIZhSXmJkrhgw555cb4S94UR6IjxxAUpJG8cNdTZQmIYMMTC0AgAN7TpG7Rqd8pjz33DYG58yUtrAdGKwVyZbGYkwI63Bvzrkshjn088DIP49sA6hjttBZKpCcc3RkZdtXRRmDZHcgbNnrj8KbCx1Fa2FadZFaZbRmZbrjzyRmZbzyRmgw" type="radio" id="color-Up3BDXO0HB3DccvIjIkLVPG1AbL3zzH03v6RfAx6XgCG5C1z4pSAYr1qBUhBNyhvsG5HAP1Czcv48ItJPjRSWnMwzYhwNTJ8LZyx4z4M5dOrdP8PRy3G7TI1hJBRXV1kcyGJIHOzGBOmX8x90jQXKsKBH2DWMdcDICHqvGrZTEY8YWFa2FajIFadPMddPrZVPMddPVPMdfA" name="color-btn" />
     <label class="color-Up3BDXO0HB3DccvIjIkLVPG1AbL3zzH03v6RfAx6XgCG5C1z4pSAYr1qBUhBNyhvsG5HAP1Czcv48ItJPjRSWnMwzYhwNTJ8LZyx4z4M5dOrdP8PRy3G7TI1hJBRXV1kcyGJIHOzGBOmX8x90jQXKsKBH2DWMdcDICHqvGrZTEY8YWFa2FajIFadPMddPrZVPMddPVPMdfA"" for=" color-Up3BDXO0HB3DccvIjIkLVPG1AbL3zzH03v6RfAx6XgCG5C1z4pSAYr1qBUhBNyhvsG5HAP1Czcv48ItJPjRSWnMwzYhwNTJ8LZyx4z4M5dOrdP8PRy3G7TI1hJBRXV1kcyGJIHOzGBOmX8x90jQXKsKBH2DWMdcDICHqvGrZTEY8YWFa2FajIFadPMddPrZVPMddPVPMdfA" style="background:#282b30"></label>

 </span>
 <span class="me-1" onclick="select_warna()">
     <input class="color-btn me-1" value="ymDx8n70xSsSVbNGrfCZv4jwO50091nI2wv2NkpjqWOBJ3Ny4ERZUm7DU9Ib5qXy6tMVC6P8HSW0YmSgmGbqPE4QfxhcV7tknkA627Ag2htrDdEzq4qnM7KYcUxP4kShmQSk9LsIVVwrScM17vwBLXstqZIApxRrfmN7LNgLwEhAwGFa2FaP8FaDdpxDdgLv4pxDdv4pxNk" type="radio" id="color-IAVYLtLLwJp6HtJASbLxQzjCn0ssAzSfScQDMTQs5dXPbzIMKw4pcyTH1nwZ4YhhTTwTQ9XdfwHjw8JvOGmz3BOxbjZv1GZ1YRWD79KVc5BOdMSxy5Z5sIDK8UPpAWkCXVKRLJVx0UVSSk6xN28wQX5Gk52DHQmksH4wtn0s2fy2MmFa2FaXdFadMHQdM0sQzHQdMQzHQMT" name="color-btn" />
     <label class="color-IAVYLtLLwJp6HtJASbLxQzjCn0ssAzSfScQDMTQs5dXPbzIMKw4pcyTH1nwZ4YhhTTwTQ9XdfwHjw8JvOGmz3BOxbjZv1GZ1YRWD79KVc5BOdMSxy5Z5sIDK8UPpAWkCXVKRLJVx0UVSSk6xN28wQX5Gk52DHQmksH4wtn0s2fy2MmFa2FaXdFadMHQdM0sQzHQdMQzHQMT"" for=" color-IAVYLtLLwJp6HtJASbLxQzjCn0ssAzSfScQDMTQs5dXPbzIMKw4pcyTH1nwZ4YhhTTwTQ9XdfwHjw8JvOGmz3BOxbjZv1GZ1YRWD79KVc5BOdMSxy5Z5sIDK8UPpAWkCXVKRLJVx0UVSSk6xN28wQX5Gk52DHQmksH4wtn0s2fy2MmFa2FaXdFadMHQdM0sQzHQdMQzHQMT" style="background:#f79c99"></label>

 </span>
</div>
<div class="mb-3 varian">
 <script>
     function select_warna(a) {
         var a = ($('input[name=color-btn]:checked').val());
         $.ajax({
             url: "https://localhost/beegrit.com/ajax/7SWnP0fSvhnIHdhKJ9YJ66OVzgs3IArU2gxhA1SLBsqdqwgYOrc35KtWmC4jJBDXpLqGnbSBhw274DmAj9p5Nm19wnOQRzE3kJVZqhRDCzB5DK4zGWtfMg91ts6t6OR5hLBOOfL9fkv8rjt0bVXTGN8b72LLO1BnGcI8s4Wq6z6cTTFa2Fac3195KwnE3DXt0DXfS6cs3OV4DFaDKO1DKWq66O1DK66O1A1/MzTc1BL7ctOxJ1JAzSSvZzYmqOBOLvjxI8IHk5Kw8s8yNz2pczfnhQP0Nd638d4XXS6sgmqrJq0TT1g1mNOywybGrCEMpcYqh22kCQwIr34Nk3N3wE0zWVHBfLJRECLtM4yjxfsZTnCMgHUmE1DXLzQT52YkvZGGgvwRCscSjHA4SHFa2FaA4h22khQP0JqFak3vZk3cSZzvZk3ZzvZk5",
             type: "post",
             data: {
                 n: a,
             },
             cache: false,
             dataType: "html",
             success: function(res) {
                 $('#imgFull').html(res);


             },
             error: function(error) {
                 //maka cari di localstorage

             }
         });

     }
 </script>

</div>
<br>

<div class="mb-3 cart">


 <div class="clearfix"></div>


 <div class="clearfix"></div>
 <div class="info-wrap">
     <div class="add-to-cart ">
         <div class="qty-label" style="color: #fff;font-weight: bold;">
             <span style="display: flex;align-content: center;align-items: center;margin-right: 25px;">Qty</span>
             <div class="input-number" style="width: 90px;">
                 <input type="number" value="1" id="set_qty">
                 <span class="qty-up" style="color: #555;">+</span>
                 <span class="qty-down" style="color: #555;">-</span>
             </div>
         </div>

     </div>
     <div href="#" onclick="cart()" class="btn"><i class="uil uil-shopping-cart "></i> Add To Cart</div>
 </div>
 <script>
     function cart() {

         var a = ($('input[name=color-btn]:checked').val());
         var b = ($('input[name=varian-btn]:checked').val());
         var q = ($('#set_qty').val());
         $.ajax({
             url: "https://localhost/beegrit.com/ajax/BdKqwAvG0gPAWDL2w7yQ2tG1sJ2jU8b8jOTfY7X7HvUJmW4NAZP3vAZ8gcUcEmzsTEh5wTv1I8GK8fNCsALdsIdv8WpPZ3yDOXO0tbyr9b0DV1vqtrsNE8nHOpfOXhxDrhzdJSk1WMPILq8cDfI0X5Y4dIVq3dxHfCLhOGyAp9sn2yFa2FaP3dvvA8WyDO0vAsnTEzsZ8O0yDOXdvvA8W8W2jtr8fyDV1V1FaV13dV1yA2t3dV12t3dY7/yXD9Ic3bATPQUbTg9cvXELJYtVNG2dALV0HIAGb1EbmOGyyYyf8DWsgxCqyNrTXOwHw7B5qXkImvTMjPWAWyZhLWtbAps4hTg4SNvcmLyKLVJL6jUwNDrO5bCL7KQpv9ygPW4Z3nvz8IKwh9ZtVnwUqGHrOdbqYhxw8ypw03qAdt8TFa2Fadtg4SNWsgxkIFaJLbqJL03ELbqJLELbqAG",
             type: "post",
             data: {
                 c: a,
                 w: a,
                 q: q,
             },
             cache: false,
             dataType: "html",
             success: function(res) {



             },
             error: function(error) {
                 //maka cari di localstorage

             }
         });
     }
 </script>


</div>
</div>
</div>
<!-- partial -->
<div>
<!--<div class="bg-white mt-3 p-3 ps-md-5"> 
<h3>Fitur</h3>
<p>The chair construction is made of ash tree. Upholstery and wood color at customer's request.</p>
</div>-->

<div class="bg-white mt-3 p-3 ps-md-5">
<h3>Spesifikasi</h3>
<div class="row" style="border-bottom:1px dashed gray;font-size: 14px;text-align: justify;margin-left: 0;">
 <div class="col-3" style="margin: 0;padding: 0;">
     Berat
 </div>
 <div class="col-7">
     :
     <b>
         250 gr
     </b>

 </div>
</div>
<div class="row" style="border-bottom:1px dashed gray;font-size: 14px;text-align: justify;margin-left: 0;">
 <div class="col-3" style="margin: 0;padding: 0;">
     Keadaan
 </div>
 <div class="col-7">
     :
     <b>
         pribadi </b>

 </div>
</div>

<div class="row" style="border-bottom:1px dashed gray;font-size: 14px;text-align: justify;margin-left: 0;">
 <div class="col-3" style="margin: 0;padding: 0;">
     Penulis </div>
 <div class="col-7">
     :
     <b>
         DR. Abdurrahim </b>

 </div>
</div>
</div>

<div class="bg-white mt-3 p-3 ps-md-5">
<h3>Deskripsi</h3>


<p c="">Kitab Durusul Lughah Jilid 1-4 ini merupakan kitab belajar bahasa Arab yang dikeluarkan oleh Universitas Islam Madinah, Kerajaan Saudi Arabia Durusul Lughah adalah salah satu kitab pembelajaran Muhadatsah atau percakapan. Yang berbeda dari Buku Durusul Lughah dibandingkan buku pembelajaran Bahasa Arab lainnya adalah penyusunannya yang sistematis dengan pengenalan kaidah bahasa secara bertahap yang langsung diterapkan pada bacaan dan latihan intensif dalam setiap Bab Pelajaran.

 Kitab Durusul Lughoh ini terdiri dari 4 jilid dengan materi pembahasannya secara sistematis dan dari dasar sekali. Insya Allah memudahkan bagi Anda yang sudah mahir ataupun bagi Anda yang pemula yang ingin belajar bahasa Arab. Semoga Allah Ta’ala menambahkan ilmu dan semangat kita semua dalam mempelajari bahasa Arab.

 Kitab Durusul Lughoh ini terdiri dari 4 jilid ini Kitab pelajaran bahasa arab dasar yang banyak digunakan berbagai kalangan, baik formal maupun non formal dalam jenjang akademik maupun pesantren. Selamat belajar. Semoga bermanfaat.</p>
</div>

<div class="bg-white mt-3 p-3 ps-md-5">
<h3>Profil Penjual</h3>
<div class="user-box">
 <span class="avatar mt-1">
     <span class="avatar avatar-sm" style="">WO</span></span>
 <div class="u-text" onc="">
     <h4 style="font-size: 12px;font-weight: 550;color: #555;">
         WUI Official Store</h4>
     <div class="text-muted" style="color:rgba(35, 46, 60, 0.7) !important">
         WUI ID:</div>
 </div>
</div>
<div class="row m-0 p-2">

 <div class="col-6">
     <h6 class="m-0" style="font-weight: 500;color: #555;">
         Rating
     </h6>
     <h6 class="m-0">
         0</h6>
 </div>
 <div class="col-6">
     <h6 class="m-0" style="font-weight: 500;color: #555;">
         Total Penjualan
     </h6>
     <h6 class="m-0">
         0 terjual
     </h6>
 </div>
</div>
</div>
<div class="bg-white mt-3 p-3 ps-md-5">
<h3>Galeri Produk</h3>
<div class="row">

 <div class="col-md-5 col-md-push-2 text-center">
     <div id="product-main-img" class="slick-initialized slick-slider">


         <div class="slick-list draggable">
             <div class="slick-track" style="opacity: 1; width: 0px;"></div>
         </div>
     </div>
 </div>

 <div class="col-md-2  col-md-pull-5">
     <div id="product-imgs" class="slick-initialized slick-slider slick-vertical">
         <div class="slick-list draggable" style="padding: 0px;">
             <div class="slick-track" style="opacity: 1;"></div>
         </div>
     </div>
 </div>
 <!-- /Product thumb imgs -->

 <!-- Product details -->



</div>
</div>

<div class="bg-white mt-3 p-3  ps-md-5">
<h3>Penilaian ( <span>0.0</span>)</h3>
<div class="rating-stars">
 <i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>

</div>
<ul class="rating">
 <li>
     <div class="rating-stars">
         <i class="fa fa-star"></i>
         <i class="fa fa-star"></i>
         <i class="fa fa-star"></i>
         <i class="fa fa-star"></i>
         <i class="fa fa-star"></i>

     </div>
     <div class="rating-progress">
         <div style="width: 0%;"></div>
     </div>
     <span class="sum">0</span>
 </li>
 <li>
     <div class="rating-stars">
         <i class="fa fa-star"></i>
         <i class="fa fa-star"></i>
         <i class="fa fa-star"></i>
         <i class="fa fa-star"></i>
         <i class="fa fa-star-o"></i>

     </div>
     <div class="rating-progress">
         <div style="width: 0%;"></div>
     </div>
     <span class="sum">0</span>
 </li>
 <li>
     <div class="rating-stars">
         <i class="fa fa-star"></i>
         <i class="fa fa-star"></i>
         <i class="fa fa-star"></i>
         <i class="fa fa-star-o"></i>
         <i class="fa fa-star-o"></i>

     </div>
     <div class="rating-progress">
         <div style="width: 0%;"></div>
     </div>
     <span class="sum">0</span>
 </li>
 <li>
     <div class="rating-stars">
         <i class="fa fa-star"></i>
         <i class="fa fa-star"></i>
         <i class="fa fa-star-o"></i>
         <i class="fa fa-star-o"></i>
         <i class="fa fa-star-o"></i>

     </div>
     <div class="rating-progress">
         <div style="width: 0%;"></div>
     </div>
     <span class="sum">0</span>
 </li>
 <li>
     <div class="rating-stars">
         <i class="fa fa-star"></i>
         <i class="fa fa-star-o"></i>
         <i class="fa fa-star-o"></i>
         <i class="fa fa-star-o"></i>
         <i class="fa fa-star-o"></i>

     </div>
     <div class="rating-progress">
         <div style="width: 0%;"></div>
     </div>
     <span class="sum">0</span>
 </li>

</ul>
</div>


</div>
</div>
</div>';
    return $return;
}

 public static function beegrit_habistboardcontent_template(){ 
   
    $return["css"] = "";
    $return["js"] = "";
    $return["html"] = '<div class="habist p-0">
<div class="header" style="border-bottom: 0;">


<div class="user-info p-5 ">
<img alt="Profile picture of Alexander Arnold" height="50" style="border-radius:10px" src="https://storage.googleapis.com/a1aa/image/vo3t1Je6hQycUS4Mw3N86CJlDDjiGXITWeekduag7Rs6zTWnA.jpg" width="50" />
<div class="details">
<h4>
Board Hamasah
<!-- <button class="btn btn-default btn-sm">Share Board</button> -->
</h4>
<p>
<style>

</style>
<div class="avatars">
<a href="#" class="avatars__item avat"><img class="avatar" src="https://randomuser.me/api/portraits/women/65.jpg" alt=""></a>
<a href="#" class="avatars__item"><img class="avatar" src="https://randomuser.me/api/portraits/men/25.jpg" alt=""></a>
<a href="#" class="avatars__item"><img class="avatar" src="https://randomuser.me/api/portraits/women/25.jpg" alt=""></a>
<a href="#" class="avatars__item"><img class="avatar" src="https://randomuser.me/api/portraits/men/55.jpg" alt=""></a>
<a href="#" class="avatars__item"><img class="avatar" src="https://via.placeholder.com/300/09f/fff.png" alt=""></a>
</div>
</p>
<p>
as a Administrator
</p>
</div>
</div>
</div>
<div class="tabs pb-3" style="border-bottom:1px solid var(--dashui-border-color);  margin-bottom: 20px;">

<input type="radio" id="radio-1" name="tabs" checked onclick="opentab('overview')" />
<label class="tab" for="radio-1">Overview<span class="notification">2</span></label>
<input type="radio" id="radio-2" name="tabs" onclick="opentab('role')" />
<label class="tab" for="radio-2">Role</label>
<input type="radio" id="radio-3" name="tabs" onclick="opentab('anggota')" />
<label class="tab" for="radio-3">Anggota</label>
<input type="radio" id="radio-6" name="tabs" onclick="opentab('list_amalan')" />
<label class="tab" for="radio-6">List Amalan</label>
<input type="radio" id="radio-4" name="tabs" onclick="opentab('muktabaah')" />
<label class="tab" for="radio-4">Muktabaah Yaumiyah</label>
<input type="radio" id="radio-5" name="tabs" onclick="opentab('leaderboard')" value="Leaderboard" />
<label class="tab" for="radio-5">Leaderboard</label>
<input type="radio" id="radio-7" name="tabs" onclick="opentab('setting')" value="Setting" />
<label class="tab" for="radio-7">Setting</label>
<span class="glider"></span>
</div>
<script>
function opentab(tab) {
$('.tab-pane').removeClass('show active');
$('#' + tab).addClass('show active');
}
</script>

<div class="main p-5 pt-0 " style="padding-top: 0px !important;" id="main-board_amalan">
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">Konten Overview</div>
<div class="tab-pane fade" id="role" role="tabpanel" aria-labelledby="role-tab">Konten Role</div>
<div class="tab-pane fade" id="anggota" role="tabpanel" aria-labelledby="anggota-tab"><button class="btn btn-primary" style="width: 100%;" data-toggle="modal" data-target="#exampleModal">Tambah</button>
<div class="row">

<div class="">

 <div class="card" id="profileCard">
     <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Profile Picture" class="noSelect">
     <h2 class="noSelect">John Doe</h2>
     <div class="social-icons">
         <a href="#"><i class="fab fa-twitter"></i></a>
         <a href="#"><i class="fab fa-instagram"></i></a>
         <a href="#"><i class="fab fa-github"></i></a>
     </div>
 </div>
</div>
<div class="">
 <div class="card" id="profileCard">
     <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Profile Picture" class="noSelect">
     <h2 class="noSelect">John Doe</h2>
     <div class="social-icons">
         <a href="#"><i class="fab fa-twitter"></i></a>
         <a href="#"><i class="fab fa-instagram"></i></a>
         <a href="#"><i class="fab fa-github"></i></a>
     </div>
 </div>
</div>
<div class="">
 <div class="card" id="profileCard">
     <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Profile Picture" class="noSelect">
     <h2 class="noSelect">John Doe</h2>
     <div class="social-icons">
         <a href="#"><i class="fab fa-twitter"></i></a>
         <a href="#"><i class="fab fa-instagram"></i></a>
         <a href="#"><i class="fab fa-github"></i></a>
     </div>
 </div>
</div>
<div class="">
 <div class="card" id="profileCard">
     <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Profile Picture" class="noSelect">
     <h2 class="noSelect">John Doe</h2>
     <div class="social-icons">
         <a href="#"><i class="fab fa-twitter"></i></a>
         <a href="#"><i class="fab fa-instagram"></i></a>
         <a href="#"><i class="fab fa-github"></i></a>
     </div>
 </div>
</div>

<div class="info-box" id="infoBox">
 <h2 class="noSelect">About Me</h2>
 <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, quibusdam delectus? Officia optio eveniet molestias explicabo culpa quos delectus ratione laudantium. Laborum obcaecati totam quasi animi illum veritatis laboriosam veniam?
     Quis impedit eveniet, asperiores atque neque debitis aliquid quisquam, odit itaque reprehenderit quidem! Exercitationem aperiam dolore laborum aliquam, vitae incidunt animi mollitia amet. Impedit, qui! Provident, dicta molestiae. Exercitationem, voluptates.</p>

 <div class="pills">
     <span class="pill">JavaScript</span>
     <span class="pill">Python</span>
     <span class="pill">Java</span>
     <span class="pill">C#</span>
     <span class="pill">HTML</span>
     <span class="pill">CSS</span>
     <span class="pill">SQL</span>
 </div>
</div>
</div>
</div>
<div class="tab-pane fade" id="list_amalan" role="tabpanel" aria-labelledby="muktabaah-tab">

<div class="toggle-container">
<label class="switch">
 <input type="checkbox" id="alarmToggle" onchange="toggleAlarmSettings()">
 <span class="slider"></span>
</label>
<label for="alarmToggle">Penghidupan Alarm</label>


<div id="alarmSettings" class="form-section">
 <label for="alarmTime">Jam Alarm:</label>
 <input type="time" class="form-control" id="alarmTime" name="alarmTime"><br><br>

 <label for="targetIdeal">Target Ideal:</label>
 <input type="text" class="form-control" id="targetIdeal" name="targetIdeal" placeholder="Masukkan Target Ideal">
</div>
</div>

</div>
<div class="tab-pane fade" id="muktabaah" role="tabpanel" aria-labelledby="muktabaah-tab">Konten Muktabaah Yaumiyah</div>
<div class="tab-pane fade" id="leaderboard" role="tabpanel" aria-labelledby="leaderboard-tab">Konten Leaderboard</div>
<div class="tab-pane fade" id="setting" role="tabpanel" aria-labelledby="setting-tab">
<div class="card">
<div class="info">
 <img alt="Profile picture of Jerome Bellingham" height="60" src="https://storage.googleapis.com/a1aa/image/VaI0l8gyyY4xPdpcDylFAaV8c0eFcQT2mezXdaH5Ulk75JrTA.jpg" width="60" />
 <div class="details">
     <h4>
         Jerome Bellingham
     </h4>
     <p>
         Joined Since : 12 March 2023
     </p>
     <div class="badge">
         MEMBER
     </div>
 </div>
</div>
<h3>
 Basic Informational
</h3>
<div class="details">
 <div class="item">
     <i class="fas fa-male">
     </i>
     <p>
         Gender
     </p>
     <p class="value">
         Male
     </p>
 </div>
 <div class="item">
     <i class="fas fa-birthday-cake">
     </i>
     <p>
         Birthday
     </p>
     <p class="value">
         12 August 2001
     </p>
 </div>
 <div class="item">
     <i class="fas fa-phone">
     </i>
     <p>
         Phone Number
     </p>
     <p class="value">
         +62 837 356 343 23
     </p>
 </div>
</div>
</div>
</div>
</div>



</head>

<body>



<script>
function toggleAlarm(icon) {
// Toggle kelas "active" untuk ikon
icon.classList.toggle("active");

// Tampilkan atau sembunyikan form waktu alarm
const timeInput = icon.nextElementSibling.nextElementSibling;
timeInput.style.display = timeInput.style.display === "none" ? "inline-block" : "none";
}
</script>

<style>
.toggle-container {

align-items: center;
margin-bottom: 20px;
width: 100%;
background: #e6eef9;
padding: 10px;
border-radius: 10px;
}


.switch {
position: relative;
display: inline-block;
width: 60px;
height: 34px;
margin-right: 10px;
}

.switch input {
opacity: 0;
width: 0;
height: 0;
}

.slider {
position: absolute;
cursor: pointer;
top: 0;
left: 0;
right: 0;
bottom: 0;
background-color: #ccc;
transition: .4s;
border-radius: 34px;
}

.slider:before {
position: absolute;
content: "";
height: 26px;
width: 26px;
left: 4px;
bottom: 4px;
background-color: white;
transition: .4s;
border-radius: 50%;
}

input:checked+.slider {
background-color: #2196F3;
}

input:checked+.slider:before {
transform: translateX(26px);
}

.form-section {
display: none;
margin-top: 20px;
}
</style>
</head>

<body>


<script>
function toggleAlarmSettings() {
 const alarmSettings = document.getElementById("alarmSettings");
 const isChecked = document.getElementById("alarmToggle").checked;

 // Tampilkan atau sembunyikan pengaturan tambahan berdasarkan toggle
 if (isChecked) {
     alarmSettings.style.display = "block";
 } else {
     alarmSettings.style.display = "none";
 }
}
</script>

</body>






</div>
</div>';
    return $return;
}

 public static function beegrit_habistboardlist_template(){ 
   
    $return["css"] = "";
    $return["js"] = "";
    $return["html"] = 'xx asdadadsadas<li onclick="load_content_board('<IDBOARD></IDBOARD>')">
<img alt="Profile picture of Bessie Cooper" height="40" src="https://storage.googleapis.com/a1aa/image/pmOVZNqjSWYeUqs2OvTrzTVfyEnn6TTOKBmxR0f7xYY5zTWnA.jpg" width="40" />
<div class="info">
<h4>
<NAMA></NAMA>
<span class="badge badge-danger"></span>
</h4>
<p>

</p>
</div>
<div class="actions">
<i class="fas fa-chevron-right">
</i>
</div>
</li>