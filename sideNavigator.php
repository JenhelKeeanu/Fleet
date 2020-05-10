<div class="sidenav">
<img src="hert.jpg" height="70px" width="100%">	
  <button class="dropdown-btn">VRR Database 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="dispatcher.php?data=1"><i class="fa fa-caret-right" style="font-size:24px"></i> Available Vehicles</a>
    <a href="dispatcher.php?data=2"><i class="fa fa-caret-right" style="font-size:24px"></i> VRR Database</a>
  </div>
  <!-- <a href="#about">Available Vehicles</a>
  <a href="#services">VRR Database</a> -->
  <a href="dispatcher.php?user=1">User Information</a>
  <a href="dispatcher.php?out=1">Log-out</a>
  
  <!-- <a href="#contact">Search</a> -->
</div>



<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>

</nav>