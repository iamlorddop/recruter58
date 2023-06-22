const button = document.getElementsByClassName('btn')
const scrollToButtons = document.querySelector('#buttons_container')
const popupBackground = document.querySelector('.popup-dark__bg')
const applicantPopup = document.querySelector('.applicant-popup')
const employerPopup = document.querySelector('.employer-popup')
const formApplicant = document.querySelector('.applicant-popup__form')
const formEmployer = document.querySelector('.employer-popup__form')

Array.prototype.forEach.call(button, b => b.addEventListener('click', addElement))
document.querySelector('#applicant_btn').addEventListener('click', () => scrollToButtons.scrollIntoView({behavior: 'smooth'}))
document.querySelector('#employer_btn').addEventListener('click', () => scrollToButtons.scrollIntoView({behavior: 'smooth'}))
document.querySelector('.applicant').addEventListener('click', () => {
   popupBackground.classList.add('active')
   applicantPopup.classList.add('popup-active')
})
document.querySelector('.applicant-popup__cross').addEventListener('click', () => {
   applicantPopup.classList.remove('popup-active')
   popupBackground.classList.remove('active')
})
document.querySelector('.employer').addEventListener('click', () => {
   popupBackground.classList.add('active')
   employerPopup.classList.add('popup-active')
})
document.querySelector('.employer-popup__cross').addEventListener('click', () => {
   employerPopup.classList.remove('popup-active')
   popupBackground.classList.remove('active')
})
formApplicant.addEventListener('submit', event => {
   event.preventDefault()
   console.log('Works!')
})
formEmployer.addEventListener('submit', event => {
   event.preventDefault()
   console.log('Works!')
})

function addElement(e) {
   let addDiv = document.createElement('div'),
   mValue = Math.max(this.clientWidth, this.clientHeight),
   rect = this.getBoundingClientRect()

   addDiv.style.width = addDiv.style.height = mValue + 'px'
   addDiv.style.left = e.clientX - rect.left - (mValue / 2) + 'px'
   addDiv.style.top = e.clientY - rect.top - (mValue / 2) + 'px'

   addDiv.classList.add('pulse')
   this.appendChild(addDiv)
}