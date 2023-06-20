const button = document.getElementsByClassName('btn')

Array.prototype.forEach.call(button, b => b.addEventListener('click', addElement))
document.querySelector('#applicant_btn').addEventListener('click', () => document.querySelector('#buttons_container').scrollIntoView({behavior: 'smooth'}))
document.querySelector('#employer_btn').addEventListener('click', () => document.querySelector('#buttons_container').scrollIntoView({behavior: 'smooth'}))


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