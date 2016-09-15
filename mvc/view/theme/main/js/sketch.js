$(document).ready(function(){

	if($('.gmail-count').length){
		(function checkGmail(){
			$.ajax({
				url : "/ajax/gmail",
				type: "POST",
				success: function(dt){
					$('.gmail-count').html(dt);
				}
			});

			setTimeout(checkGmail, 60000);
		})();
	}
});