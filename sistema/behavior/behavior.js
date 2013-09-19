// Behavior

function animationAjax(caption) {
	
	$caption = caption;
	$(document).ajaxStart(function() {
		$($caption).append($("<span>").text("Um momento"));
	});
	$(document).ajaxSend(function(){
	});
	$(document).ajaxSuccess(function(){
	});
	$(document).ajaxComplete(function(){
	});
	$(document).ajaxError(function(){
	});
	$(document).ajaxStop(function() {
		$(caption).empty();
	});
	
}
animationAjax("#message-content-right");

function IndexView($span) {
	
	$menu = $($span).attr("id");
	$("#html-content-right").empty();
	$("#html-content-right").load("_view.php?menu="+$menu);
	
}

function IndexUpdate($span) {
	
	$menu = $($span).attr("id");
	$("#html-content-right").empty();
	$("#html-content-right").load("_update.php?menu="+$menu);
	
}