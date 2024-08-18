const selectBox=document.getElementById('select-box');
const inputs=document.getElementsByName('test')
var labels = document.getElementsByTagName('LABEL');
const options=document.getElementsByClassName('options')[0]; 


inputs.forEach(element => {
    element.addEventListener('change',()=>{ 
        selectBox.value=element.label.innerHTML;
        // add hide to select 
            options.classList.add('hide');
            options.classList.remove('show')
    })
});

selectBox.addEventListener('click',()=>{ 
    // options.classList.add('show')
    if(options.classList.contains('show')){
        options.classList.add('hide');
        options.classList.remove('show')
    }else{
        options.classList.add('show');
        options.classList.remove('hide')
    }
})

for (var i = 0; i < labels.length; i++) {
    if (labels[i].htmlFor != '') {
         var elem = document.getElementById(labels[i].htmlFor);
         if (elem)
            elem.label = labels[i];         
    }
} 
 
function c(event){
    console.log(event);
}