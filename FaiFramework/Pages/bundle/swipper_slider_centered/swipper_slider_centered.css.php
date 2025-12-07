
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css'><style>


main {
  overflow: hidden;
}

a,
button {
  cursor: pointer;
  user-select: none;
  border: none;
  outline: none;
  background: none;
}

img {
  display: block;
  max-width: 100%;
  height: auto;
  object-fit: cover;
  image-rendering: -webkit-optimize-contrast;
  image-rendering: -moz-crisp-edges;
  image-rendering: crisp-edges;
}




.swiper {
  &-button-next::after,
  &-button-prev::after {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 800;
    padding: 1rem;
    width: 2rem;
    height: 2rem;
    opacity: 0.75;
    border-radius: 50%;
    color: var(--white-100);
    background: var(--black-300);
  }
}
</style>