
let countTimeElements = document.querySelectorAll('.count_time');
 let second = 1000
let minute = second * 60
let hour = minute * 60
let day = hour * 24
  
countTimeElements.forEach((countTimeElement) => { 
  let countdownDate = countTimeElement.dataset.set;
console.log(countdownDate) 
  let countDown = new Date(countdownDate).getTime();
 
  const myRacing = () => {
    let nowDate = new Date().getTime();
    let distance = countDown - nowDate;

      countTimeElement.querySelector('.timer #days').innerText = Math.floor(distance / day);
    countTimeElement.querySelector('.timer #hours').innerText = Math.floor((distance % day) / hour).toString().padStart(2, '0');
      countTimeElement.querySelector('.timer #minutes').innerText = Math.floor((distance % hour) / minute).toString().padStart(2, '0');
      countTimeElement.querySelector('.timer #seconds').innerText = Math.floor((distance % minute) / second).toString().padStart(2, '0');
    
        if (distance < 0){
        clearInterval(MyTimer);
        count_time.innerHTML = '';
        count_time.classList.add('d-none') 
    }
  };
 
  let myTimer = setInterval(myRacing, 1000);
});