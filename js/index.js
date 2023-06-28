const button = document.getElementsByClassName('btn')
const scrollToButtons = document.querySelector('#buttons_container')
const popupBackground = document.querySelector('.popup-dark__bg')
const applicantPopup = document.querySelector('.applicant-popup')
const employerPopup = document.querySelector('.employer-popup')
const formApplicant = document.querySelector('.applicant-popup__form')
const formEmployer = document.querySelector('.employer-popup__form')
const phoneInputs = document.querySelectorAll('._tel')
const applicantPopupCross = document.querySelector('.applicant-popup__cross')
const employerPopupCross = document.querySelector('.employer-popup__cross')

Array.prototype.forEach.call(button, b => b.addEventListener('click', addElement))
document.querySelector('#applicant_btn').addEventListener('click', () => scrollToButtons.scrollIntoView({behavior: 'smooth'}))
document.querySelector('#employer_btn').addEventListener('click', () => scrollToButtons.scrollIntoView({behavior: 'smooth'}))
document.querySelector('.applicant').addEventListener('click', () => {
   applicantPopupCross.classList.remove('cross-close')
   applicantPopup.classList.remove('popup-close')
   popupBackground.classList.add('active')
   applicantPopup.classList.add('popup-active')
})
document.querySelector('.employer').addEventListener('click', () => {
   employerPopupCross.classList.remove('cross-close')
   employerPopup.classList.remove('popup-close')
   popupBackground.classList.add('active')
   employerPopup.classList.add('popup-active')
})
applicantPopupCross.addEventListener('click', () => {
   applicantPopupCross.classList.add('cross-close')
   setTimeout(() => {
      applicantPopup.classList.add('popup-close')
   }, 250)
   setTimeout(() => {
      applicantPopup.classList.remove('popup-active')
      popupBackground.classList.remove('active')
   }, 400)
})
employerPopupCross.addEventListener('click', () => {
   employerPopupCross.classList.add('cross-close')
   setTimeout(() => {
      employerPopup.classList.add('popup-close')
   }, 250)
   setTimeout(() => {
      employerPopup.classList.remove('popup-active')
      popupBackground.classList.remove('active')
   }, 400)
})
popupBackground.addEventListener('click', () => {
   applicantPopupCross.classList.add('cross-close')
   employerPopupCross.classList.add('cross-close')
   setTimeout(() => {
      applicantPopup.classList.add('popup-close')
      employerPopup.classList.add('popup-close')
   }, 250)
   setTimeout(() => {
      employerPopup.classList.remove('popup-active')
      applicantPopup.classList.remove('popup-active')
      popupBackground.classList.remove('active')
   }, 400)
})
formApplicant.addEventListener('submit', formApplicantSend)
formEmployer.addEventListener('submit', formEmployerSend)

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

async function formApplicantSend(e) {
   e.preventDefault()

   let error = formValidate(formApplicant)

   let formData = new FormData(formApplicant)
   if (error === 0) {
      let response = await fetch('applicant.php', {
         method: 'POST',
         body: formData
      })
      if (response.ok) {
         let result = await response.json()
         console.log(result.message)
         formApplicant.classList.add('close-form')
         document.querySelector('.applicant-popup > .popup-form__send').classList.add('active-send') // console.log(result.message)
         formApplicant.reset()
      } else {
         console.log('Ошибка')
      }
   }
}

async function formEmployerSend(e) {
   e.preventDefault()

   let error = formValidate(formEmployer)

   let formData = new FormData(formEmployer)
   if (error === 0) {
      let response = await fetch('employer.php', {
         method: 'POST',
         body: formData
      })
      if (response.ok) {
         let result = await response.json()
         console.log(result.message)
         formEmployer.classList.add('close-form')
         document.querySelector('.employer-popup > .popup-form__send').classList.add('active-send') // console.log(result.message) 
         formApplicant.reset()
      } else {
         console.log('Ошибка')
      }
   }
}

function formValidate(form) {
   let error = 0
   let formReq = document.querySelectorAll('._req')

   for (let i = 0; i < formReq.length; i++) {
      const input = formReq[i]
      formRemoveError(input)

      if (input.classList.contains('_email')) {
         if(emailTest(input)) {
            formAddError(input)
            error++
         }
      } else if (input.classList.contains('_tel')) {
         if(telTest(input)) {
            formAddError(input)
            error++
         }
      } else if (input.getAttribute('type') === 'checkbox' && input.checked === false) {
         formAddError(input)
         error++
      } else {
         if (input.value === '') {
            formAddError(input)
            error++
         }
      }
   }
   return error
}

function formAddError(input) {
   input.parentElement.classList.add('_error')
   input.classList.add('_error')
}

function formRemoveError(input) {
   input.parentElement.classList.remove('_error')
   input.classList.remove('_error')
}

function emailTest(input) {
   return !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,8})+$/.test(input.value)
}

function telTest(input) {
   return !/(\d?)?(\d{3})?(\d{3})?(\d{2})?(\d{2})/.test(input.value)
}

phoneInputs.forEach(input => { 
   IMask(input, {
      mask: '+{7}(000)000-00-00'
   })
})