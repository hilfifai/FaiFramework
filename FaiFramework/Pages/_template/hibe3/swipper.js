
import Swiper from "https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.esm.browser.min.js";

const swiper = new Swiper('.swiper', {
  loop: true,
  slidesPerView: 'auto',
  autoplay: {
    delay: 5000,
    disableOnInteraction: true
  },
  centeredSlides: true,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  }
});