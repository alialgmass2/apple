// var doc = new jsPDF();
// var specialElementHandlers = {
//   '#editor': function (element, renderer) {
//     return true;
//   }
// }; 
function download(id) {
    //   var xhr = new XMLHttpRequest();
    //   xhr.open('GET', `https://edu.jawraa.com/user/dashboard/invoice/${id}`, true);
    //   xhr.onreadystatechange = function () {
    //     if (xhr.readyState === 4 && xhr.status === 200) {
    //       // Capture the HTML content of the page
    //       var pageContent = xhr.responseText;
    //       var tempContainer = document.createElement('div');
    //   tempContainer.innerHTML = pageContent;
    //   console.log(tempContainer)
    //       // Convert the captured content to a PDF using pdfmake
    //       var docDefinition = { content: tempContainer };
    //       pdfMake.createPdf(docDefinition).download('page.pdf');
    //     }
    //   };
    //   xhr.send();

    
    
    
     // Make an AJAX request to the desired page
      var xhr = new XMLHttpRequest();
      xhr.open('GET', `https://edu.jawraa.com/user/dashboard/invoice/${id}`, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Capture the HTML content of the page
          var pageContent = xhr.responseText;
          console.log(pageContent)
          // Convert the captured content to a PDF
          html2pdf().from(pageContent).save();
        }
      };
      xhr.send();

    // var element = document.getElementById('editor');
// html2pdf(element);   


// var element = document.getElementById('editor');
 
// // Create a hidden clone of the element for the PDF
// var clone = element.cloneNode(true); 
// clone.style.display = 'block';  
// clone.classList.remove('d-none');   
// // Generate the PDF using the cloned element
 
// // html2pdf(clone).from(clone).save(); 
//   html2pdf().set({
//     html2canvas: { scale: 2 }, // Adjust scale as needed
//     filename: 'Invoice.pdf',
//     jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
//   }).from(clone).save();
// // }

        }
    

    
    
//   $.ajax({
//     url: `https://edu.jawraa.com/user/dashboard/invoice/${id}`,
//     success: function (data) {
//       var tempContainer = document.createElement('div');
//       tempContainer.innerHTML = data;
//       console.log(tempContainer);

//     //   window.onload = function() {
//         // html2canvas(tempContainer, {
//         //   useCORS: true,
//         //   scrollX: 0,
//         //   scrollY: -window.scrollY,
//         //   windowWidth: document.documentElement.offsetWidth,
//         //   windowHeight: document.documentElement.offsetHeight,
//         //   scale: 2,
        
//         // })
//         // .then(function(canvas) {
//         //   var imgData = canvas.toDataURL('image/png');
//         //   console.log(imgData);

//         //   var link = document.createElement('a');
//         //   link.href = imgData;
//         //   link.download = 'sample-page.png';
//         //   link.click();
//         // })
//         // .catch(function(error) {
//         //   console.log('Error:', error);
//         // });
//     //   };
//     }
//   });
// }
// function download(id) {
//   $.ajax({
//     url: `https://edu.jawraa.com/user/dashboard/invoice/${id}`,
//     success: function (data) {
//       var tempContainer = document.createElement('div');
//       tempContainer.innerHTML = data;
//       console.log(tempContainer);

//       html2canvas(tempContainer, {
//         useCORS: true,
//         scrollX: 0,
//         scrollY: -window.scrollY,
//         windowWidth: document.documentElement.offsetWidth,
//         windowHeight: document.documentElement.offsetHeight,
//         scale: 2,
//         onclone: function(documentClone) {
//           // Adjust any additional settings or styles if needed
//         }
//       })
//       .then(function(canvas) {
//         var imgData = canvas.toDataURL('image/png');
//         console.log(imgData);

//         var doc = new jsPDF();
//         doc.addImage(imgData, 'PNG', 15, 15, 190, 0);
//         doc.save('sample-page.pdf');
//       });
//     }
//   });
// }