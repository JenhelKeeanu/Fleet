
$("#affName").on("input",function(){
	$("#affUser").val($(this).val()+"_"+$("#affBranch").val());
})
$("#addQuotPlate").on("change",function(){
	var brand=" "
	var model=" "
	brand=$(this).find(':selected').attr('data-brand')
	model=$(this).find(':selected').attr('data-model')
	$("#addQuotBrand").val(brand)
	$("#addQuotModel").val(model)
})
$("#affBranch").on("input",function(){
	$("#affUser").val($("#affName").val()+"_"+$(this).val());
})
$(".btn_addQuotation").on("click",function(){
	var id=$(this).val();
	var ct=$(this).data("ct");
	var cb=$(this).data("cb");
	var pt=$(this).data("pt");
	$("#addQuotVRR").val(id)
	$("#addQuotPlate").val(pt)
	$("#addQuotBrand").val(cb)
	$("#addQuotModel").val(pt)
	$('.modal-backDrop').css('display','block')
	$('.modal_add_quotation').css('display','block')
})
$(".modal-backDrop").on("click",function(){
	$('.modal-backDrop').css('display','none')
	$("#ADDQUOTATIONFORM").trigger("reset");
	$('.modal_add_quotation').css('display','none')
})
$("#modal_close_quotation").on("click",function(){
	$("#ADDQUOTATIONFORM").trigger("reset");
	$('.modal-backDrop').css('display','none')
	$('.modal_add_quotation').css('display','none')
})
$("#btn_Add_Vrr").on("click",function(){
	$('#modal_Add_Vrr').css('display','block')
})
$(".add_Vrr_close").on("click",function(){
	$('#modal_Add_Vrr').css('display','none')
})
$("#addVrrPlate").on("change",function(){
	var brand=$(this).find(':selected').attr('data-brand')
	var model=$(this).find(':selected').attr('data-model')
	$("#addVrrBrand").val(brand)
	$("#addVrrModel").val(model)
})
$("#reportSelectReport").on('change', function(){
	if($(this).val()=="vehicleVrr"){
		$("#reportSelectVehicle").css("display", "block")
	}else{
		$("#reportSelectVehicle").css("display", "none")
	}
})
$("#generate_report").on('click',function(){
	var reportType=$("#reportSelectReport").val();
	var Months=$("#reportSelectMonths").val();
	var Year=$("#reportSelectYear").val();
	var vehicle=$("#reportSelectVehicle").val();
	var xmlhttp = new XMLHttpRequest();
	if(reportType==0||Months==0||Year==0){

	}
	else{
		if(reportType=="vehicleVrr"&&vehicle!=0){
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					$("#txtHint").empty()
					$("#txtHint").append(this.responseText)
				}
			};
			xmlhttp.open("GET", "getReport.php?reportType=" + reportType+ "&Months=" + Months+ "&Year=" + Year+ "&vehicle=" + vehicle+ "&type=generate", true);
			xmlhttp.send();
		}
	}
})
$("#print_report").on('click',function(){
	var reportType=$("#reportSelectReport").val();
	var Months=$("#reportSelectMonths").val();
	var Year=$("#reportSelectYear").val();
	var vehicle=$("#reportSelectVehicle").val();
	var xmlhttp = new XMLHttpRequest();
	if(reportType==0||Months==0||Year==0){

	}
	else{
		if(reportType=="vehicleVrr"&&vehicle!=0){
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					// $("#txtHint").append(this.responseText)
				// document.getElementById("txtHint").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET", "getReport.php?reportType=" + reportType+ "&Months=" + Months+ "&Year=" + Year+ "&vehicle=" + vehicle+ "&type=print", true);
			xmlhttp.send();
			
			window.open('printReport.php', '_blank');

		}
	}
	// window.location.href = 'printReport.php';
})

function Back2b() {
	console.log(window.history)
	window.history.back();
  }
//Panahon ng Hapon pa to magcode
function functsearch(){
	var userAccount = "<?php echo $_SESSION['Accounttype']; ?>";
	var s = document.getElementById("searchby").value;
	if(userAccount=="Manager") window.location.href = "manager.php?vehicle="+s;
	else if(userAccount=="Secretary") window.location.href = "manager.php?vehicle="+s;
	else if(userAccount=="Dispatcher") window.location.href = "dispatcher.php?vehicle="+s;
	else if(userAccount=="Quality Controller") window.location.href = "qualityControl.php?vehicle="+s;
}
function searchuser(){
	var s = document.getElementById("usersearch").value;
	window.location.href = "manager.php?users="+s;
}
function searchvrr(){
	var vrrAccount = "<?php echo $_SESSION['Accounttype'] ?>";
	var s = document.getElementById("vrrsearch").value;
	if(vrrAccount == "Manager") window.location.href = "manager.php?vrr="+s;
	else if(vrrAccount=="Secretary") window.location.href = "manager.php?vrr="+s;
	else if(vrrAccount=="Dispatcher") window.location.href = "dispatcher.php?vrr="+s;
	else if(vrrAccount=="Quality Controller") window.location.href = "qualityControl.php?vrr="+s;
}
function searchaffil(){
	var s = document.getElementById("affilsearch").value;
	window.location.href = "manager.php?affil="+s;
}
function functvrr(){
	var vrrAction = "<?php echo $_SESSION['Accounttype'] ?>";
	var s = document.getElementById("vrrAccount").value;
	if(vrrAction == "Manager") window.location.href = "manager.php?action="+s;
	else if(vrrAction=="Secretary") window.location.href = "manager.php?action="+s;
	else if(vrrAction=="Dispatcher") window.location.href = "dispatcher.php?action="+s;
	else if(vrrAction=="Quality Controller") window.location.href = "qualityControl.php?action="+s;
}
function plateno(){
	var affilModal = document.getElementById("modalShow");
	affilModal.style.display = "block";

}
function modal(){
	var actionModal = document.getElementById("actionShow");
	actionModal.style.display = "block";
	var close = document.getElementById("actionClose");
	close.onclick = function(){
		actionModal.style.display = "none";
		var pageSet = <?php echo $_SESSION['vrrNo']; ?>;
		var vrrAccount = "<?php echo $_SESSION['Accounttype'] ?>";
		if(vrrAction == "Manager") window.location.href = "manager.php?vrrDetails="+pageSet;
		else if(vrrAction=="Secretary") window.location.href = "manager.php?vrrDetails="+s;
		else if(vrrAction=="Dispatcher") window.location.href = "dispatcher.php?vrrDetails="+pagSet;
		else if(vrrAction=="Quality Controller") window.location.href = "dispatcher.php?vrrDetails="+pagSet;
	}
}
function note(){
	var noteModal = document.getElementById("modalShow");
	noteModal.style.display = "block";
	// var close = document.getElementsByClassName("close")[0];
	// close.onclick = function(){
	// 	noteModal.style.display = "none";
	// 	var pageSet = <?php echo $_SESSION['vrrNo']; ?>;
	// 	var vrrAccount = "<?php echo $_SESSION['Accounttype'] ?>";
	// 	if(vrrAction == "Manager") window.location.href = "manager.php?vrrDetails="+pageSet;
	// 	else if(vrrAction=="Secretary") window.location.href = "manager.php?vrrDetails="+s;
	// 	else if(vrrAction=="Dispatcher") window.location.href = "dispatcher.php?vrrDetails="+pagSet;
	// 	else if(vrrAction=="Quality Controller") window.location.href = "dispatcher.php?vrrDetails="+pagSet;
	// }
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