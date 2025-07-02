<div class="agileits_header">
<div class="w3l_offers">



<a href="index.php">Home</a> 



<a href="login.php"> Login</a>





</div>








<div class="w3l_offers">

</div>



<div class="w3l_header_right1" id = "log">


<h2><a href="register.php">Register</a></h2>




</div>








<div class="clearfix"> </div>
</div>
<!-- script-for sticky-nav -->
<script>
$(document).ready(function() {
var navoffeset=$(".agileits_header").offset().top;
$(window).load(function(){
var scrollpos=$(window).scrollTop(); 
if(scrollpos >=navoffeset){
$(".agileits_header").addClass("fixed");
}else{
$(".agileits_header").removeClass("fixed");
}
});

});
</script>
<style>
	#log{
		background-color:green; 
	}
</style>