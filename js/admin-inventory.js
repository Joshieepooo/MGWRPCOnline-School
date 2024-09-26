//search for inventoryTable

function searchTable() {
        var input, filter, table, tbody, tr, td, i, j, txtValue;
        input = document.getElementById("inventorySearchInput"); 
        filter = input.value.toUpperCase();
        table = document.getElementById("inventoryTable");
        tbody = table.getElementsByTagName("tbody");
        tr = tbody[0].getElementsByTagName("tr");


        for (i = 0; i < tr.length; i++) {
            var found = false;

            for (j = 0; j < tr[i].cells.length; j++) {
                td = tr[i].cells[j];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break; 
                    }
                }
            }

            if (found) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
    
    
//search for reservation
function searchTable2() {
        var input, filter, table, tbody, tr, td, i, j, txtValue;
        input = document.getElementById("reservationSearchInput"); 
        filter = input.value.toUpperCase();
        table = document.getElementById("reservationTable"); 
        tbody = table.getElementsByTagName("tbody");
        tr = tbody[0].getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            var found = false;
          
            for (j = 0; j < tr[i].cells.length; j++) {
                td = tr[i].cells[j];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break; 
                    }
                }
            }
            if (found) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
    
        function showPreview() {
            document.getElementById("preview").style.display = "block";
        }

        function hidePreview() {
            document.getElementById("preview").style.display = "none";
        }
 
function toggleClick() {
  const navContainer = document.getElementById("nav-container");
  if (navContainer.style.left === '-800px') {
    navContainer.style.left = '0';
  } else {
    navContainer.style.left = '-800px';
  }
}

// ADD POPUP
$(document).ready(function() {
    $('.add').click(function() {
        $('#addModal').modal('show');
    });
});
