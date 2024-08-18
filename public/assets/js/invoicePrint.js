function print(id){
     
      var existingPageURL = `https://edu.jawraa.com/user/dashboard/invoice/${id}`;
console.log(id)
      var printWindow = window.open(existingPageURL, "_blank");
      printWindow.addEventListener("load", function() {
        printWindow.print();
        console.log('oi')
        // printWindow.close();
      }); 
}