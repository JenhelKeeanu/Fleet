function functsearch(){
			var s = document.getElementById("searchby").value;
			var userAccount = <?php echo $_SESSION['Accounttype']; ?>;
			window.location.href = "manager.php?vehicle="+s;
		}
		function searchuser(){
			var s = document.getElementById("usersearch").value;
			window.location.href = "manager.php?users="+s;
		}
		function searchvrr(){
			var s = document.getElementById("vrrsearch").value;
			window.location.href = "manager.php?vrr="+s;
		}
		function searchaffil(){
			var s = document.getElementById("affilsearch").value;
			window.location.href = "manager.php?affil="+s;
		}
		function functvrr(){
			var s = document.getElementById("vrrAccount").value;
			window.location.href = "manager.php?action="+s;
		}
		var affilModal = document.getElementById("modalShow");
		var affilShowmodal = document.getElementById("showModal");
		var affilSpan = document.getElementsByClassName("close")[0];
		affilShowmodal.onclick = function() {	
		  	affilModal.style.display = "block";
		}
		affilSpan.onclick = function() {
			affilModal.style.display = "none";
		}
		window.onclick = function(event) {
			if (event.target == modal) {
	    	modal.style.display = "none";
	 	 	}
		}	
		function PMS(){
			var PMS = <?php echo $_SESSION['PMS']; ?>;
			if(PMS>0) alert("You have "+PMS+" car/s due for PMS!");	
		}
		function modal(){
			var actionModal = document.getElementById("actionShow");
			actionModal.style.display = "block";
			var close = document.getElementById("actionClose");
			close.onclick = function(){
				actionModal.style.display = "none";
				var pageSet = <?php echo $_SESSION['vrrNo']; ?>;
				window.location.href = "manager.php?vrrDetails="+pageSet;
			}
		}