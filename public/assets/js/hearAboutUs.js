const pop_up_question = document.getElementById('pop_up_question');
const openPopupBtn = document.getElementById('openPopup');
const popupContainer = document.getElementById('popupContainer');
const closeButton = document.getElementById('closeButton');
const submitButton = document.getElementById('submitButton');
const otherRadio = document.querySelector('input[name="answer"][value="other"]');
const radioButtons = document.querySelectorAll('input[name="answer"]');
const otherInput = document.querySelector('.other-input');
const otherTextArea = document.getElementById('otherText');
const acceptTerms = document.getElementById('acceptTerms');
var appearTermsError=false;

if(pop_up_question){
openPopupBtn.addEventListener('click', () => {
    goToanswer()
});
 

closeButton.addEventListener('click', () => {
  pop_up_question.style.display = 'none'; 
});
    
}

radioButtons.forEach((radioButton) => {
  radioButton.addEventListener('change', () => {
    otherInput.style.display = otherRadio.checked ? 'flex' : 'none';
    if(otherRadio.checked){
        otherRadio.value=otherTextArea.value;   
        otherTextArea.addEventListener('input',()=>{
        otherRadio.value=otherTextArea.value;   
        if(otherTextArea.value !=''){
             $('#answer_validation').html('');
        }
        });
       
        
    }
    if(radioButton.checked){
    $('#answer_validation').html('');
    }else{
    $('#answer_validation').html('Please select an answer.');
    }
  });
});

if(appearTermsError){
    $('#terms_error').html('Please accept the terms.');
}
acceptTerms.addEventListener('change', (()=>{
        if (appearTermsError){
            if(acceptTerms.checked){
    $('#terms_error').html('');
            }else{
    $('#terms_error').html('Please accept the terms.');
            }
             
         };
    
}));
function goToanswer(){ 
     if(acceptTerms.checked ){
  pop_up_question.style.display = 'flex'; 
            }else{
    appearTermsError=true;
    $('#terms_error').html('Please accept the terms.');
            }
}
 