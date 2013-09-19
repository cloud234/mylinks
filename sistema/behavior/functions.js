// View

function PreviewLink($publish) {
	
	$("#html-content-right").empty();
	$("#html-content-right").load("function/view.php?action=preview&data-page=1&input-publish="+$publish);
	
}

function PreviewLinkAll($publish) {
	
	$("#html-content-right").empty();
	$("#html-content-right").load("function/view.php?action=preview-all&data-page=1&input-publish="+$publish);
	
}

function CleanPreview($publish) {
	
	if ( confirm("Delete the table") == true ) {
		$("#html-content-right").empty();
		$("#html-content-right").load("function/view.php?action=delete&input-publish="+$publish);
	}
	
}

function PaginationPreview($span,$publish) {
	
	$page = $($span).attr("data");
	$("#html-content-right").empty();
	$("#html-content-right").load("function/view.php?action=preview&data-page="+$page+"&input-publish="+$publish);
	
}

function PaginationPreviewAll($span,$publish) {
	
	$page = $($span).attr("data");
	$("#html-content-right").empty();
	$("#html-content-right").load("function/view.php?action=preview-all&data-page="+$page+"&input-publish="+$publish);
	
}

function ClickMouse($mouse) {
	
	if ( !$(".html_input").length ) {
		$(".html_url").css("display","none");
		$(".html_host").css("display","none");
		$(".input_hidden").each(function(){
			$input = $(this).attr("value");
			$query = $input.split("&");
			$ola = $query.join("\n");
				$(this).parent().prepend($("<p>").css("text-align","center").attr("class","html_input").text($ola));
		});
	} else {
		$(".html_input").remove();
		$(".html_url").css("display","block");
		$(".html_host").css("display","block");
	}
	
}

// Update

function InsertInput() {
	
	$input_publish = $("#input-publish").val();
	$input_link = $("#input-link").val();
	if ( $input_publish !== "" ) {
		if ( $input_link !== "" ) {
			$match_input_link = $input_link.match("http");
			if ( $match_input_link == "http" ) {
				if ( confirm("Inserting the link") == true ) {
					$("#message-input").empty();
					$("#html-content-right").empty();
					$("#html-content-right").load("function/update.php?action=insert&input-publish="+$input_publish+"&input-link="+$input_link);
				}
			}
		} else {
			$("#message-input").empty();
			$("#message-input").append("<p>").css("text-align","center").css("color","#cc0000").text("Insert a link");
		}
	} else {
		$("#message-input").empty();
		$("#message-input").append("<p>").css("text-align","center").css("color","#cc0000").text("Insert a pubisher");
	}
	
}

function UpdateInput() {
	
	$input_publish = $("#input-publish").val();
	$input_link = $("#input-link").val();
	if ( $input_publish !== "" ) {
		if ( $input_link !== "" ) {
			$match_input_link = $input_link.match("http");
			if ( $match_input_link == "http" ) {
				if ( confirm("Update the link") == true ) {
					$("#message-input").empty();
					$("#html-content-right").empty();
					$("#html-content-right").load("function/update.php?action=update&input-publish="+$input_publish+"&input-link="+$input_link);
				}
			}
		} else {
			$("#message-input").empty();
			$("#message-input").append("<p>").css("text-align","center").css("color","#cc0000").text("Insert a link");
		}
	} else {
		$("#message-input").empty();
		$("#message-input").append("<p>").css("text-align","center").css("color","#cc0000").text("Insert a pubisher");
	}
	
}

function ClearInput() {
	
	$inputPublish = $("#input-publish").val('');
	$inputLink = $("#input-link").val('');
	
}

function DeleteLink($span) {
	
	if ( confirm("Delete the link") == true ) {
		$input_publish = $($span).attr('data-publish');
		$input_link = $($span).attr('data-link');
		$("#html-content-right").empty();
		$("#html-content-right").load("function/update.php?action=delete&input-publish="+$input_publish+"&input-link="+$input_link);
	}

}