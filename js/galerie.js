const slides = document.querySelectorAll('.slide')
const clearActives = () => {
    slides.forEach(slide =>
        slide.classList.remove('active'))
}

const setActive = (e) => {
    clearActives()
    e.target.classList.add('active')
}

slides.forEach(slide => {
    slide.addEventListener('click', setActive)
})