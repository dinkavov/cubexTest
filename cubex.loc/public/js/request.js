$(document).ready(function () {

	$('#managerChatForm').on('submit', function (e) {
		e.preventDefault();

		var form = $(this);
		var formData = $(this).serialize();
		var requestId = $('#messagesCard').attr('data-requestId');

		$.ajax({
			url: '/chat/send-message',
			type: 'post',
			data: formData + "&request_id=" + requestId,
			success: function (response) {
				form[0].reset();
				$('.chatScroll').append(managerOrUser(response.data['isManager'], response.data['message']));
			},
			error: function (err) {
				console.log(err);
			}
		});
	});

	function managerOrUser (isManager, message) {
		if (isManager == 1) {
			return '<div class="row">' +
				       '<div class="col-md-12">' +	
					       '<div class="float-right">' +
		                       '<a class="nav-link disabled" href="#"><b>Вы:</b> ' + message + '</a>' +
		                   '</div>' +
	                   '</div>' +
                   '</div>';
		}

		return '<div class="row">' +
				       '<div class="col-md-12">' +	
					       '<div class="float-right">' +
		                       '<a class="nav-link disabled" href="#"><b>Вы:</b> ' + message + '</a>' +
		                   '</div>' +
	                   '</div>' +
                   '</div>';
	}

});