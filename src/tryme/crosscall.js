/* jshint
browser: true,
jquery: true
*/
$(document).ready(function(){
	$("#test").click(function(){
        var url = $("#url").val();
        $("#content").text('Downloading ' + url);
		var sendData = {'url': url};
		$.post('../crosscall.php', sendData, function(data){
			$("#content").text(data);
		});
	});
});