document.addEventListener('DOMContentLoaded', function() {
	var form = document.querySelector('form');
	form.addEventListener('submit', function(e) {
		e.preventDefault();
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (xhr.readyState === 4 && xhr.status === 200) {
				alert(xhr.responseText);
			}
		};
		xhr.open('POST', '../php/.php', true);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send(new FormData(form));
	});
});