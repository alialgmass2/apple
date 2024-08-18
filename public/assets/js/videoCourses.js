let video_Popup=document.getElementById('video_popup'); 
    let video_body =document.getElementById('video_body');
function appearVideo(url){
    video_Popup.classList.remove('d-none');  
    video_body.innerHTML=`
    <video    id="video_source" width="100%"  controls autoplay loop muted >
    <source src="${url}" type="video/mp4">               
    </video>
    `; 
}
function removeVideo(){
    video_Popup.classList.add('d-none');
    const videoElement = document.getElementById('video_source');
  if (videoElement) {  
    videoElement.pause();  
  }
}