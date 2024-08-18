    document.getElementById("printButton").addEventListener("click", function() {
      var existingPageURL = "{{ route('admin.logout') }}";
      var printWindow = window.open(existingPageURL, "_blank");
      printWindow.onload = function() {
        printWindow.print();
        // printWindow.close();
      };
    });