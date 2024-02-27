var swiper = new Swiper(".images-container", {
  spaceBetween: 30,
  centeredSlides: true,
  autoplay: {
    delay: 1500,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  loop: true,
});


const dot = document.querySelector('.dot');
const operation = document.querySelector('.dot .operation');

dot.addEventListener('click',()=>{
  operation.classList.toggle('active');
});