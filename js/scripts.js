$(document).ready(function() {
	$("body").overscroll({showThumbs: false});
	
	$('#search').submit(function(e) {
		e.preventDefault();
		$.get('questions.php', {query: $('#search-text').val()}, function(data){
			var info = jQuery.parseJSON(data);
			
			if (info.error == 0){
				$('#clue').fadeOut(function() {
					$(this).text(info.question.question.trim()).fadeIn();
				});
				
				$('#counts').fadeOut(function() {
					$(this).text(String(info.position + 1) + ' of ' + String(info.count)).fadeIn();
				});
				
				$('#answer').fadeOut(function() {
					$(this).text(info.question.answer).fadeIn();
				});
				
				$('#next').removeAttr('disabled');
			}
			
			else if (info.error == 1){
				$('#clue').fadeOut(function() {
					$(this).text('Please try a different query, being sure to check your spelling.').fadeIn();
				});
				
				$('#counts').fadeOut(function() {
					$(this).text('No results found.').fadeIn();
				});
				
				$('#answer').fadeOut(function() {
					$(this).text('No answer line.').fadeIn();
				});
				
				$('#next').attr('disabled', 'disabled');
				$('#previous').attr('disabled', 'disabled');
			}
		});
	});
	
	$('#next').click(function() {
		$.get('questions.php', {next: 1}, function(data){
			var info = jQuery.parseJSON(data);
			
			if (info.error == 0){
				$('#clue').fadeOut(function() {
					$(this).text(info.question.question.trim()).fadeIn();
				});
				
				$('#counts').fadeOut(function() {
					$(this).text(String(info.position + 1) + ' of ' + String(info.count)).fadeIn();
				});
				
				$('#answer').fadeOut(function() {
					$(this).text(info.question.answer).fadeIn();
				});
				
				if (info.last != 1){
					$('#next').removeAttr('disabled');
				}
				
				else{
					$('#next').attr('disabled', 'disabled');
				}
				
				$('#previous').removeAttr('disabled');
			}
			
			else if (info.error == 2){
				$('#clue').fadeOut(function() {
					$(this).text('Your query or button click was invalid. Please try again.').fadeIn();
				});
				
				$('#counts').fadeOut(function() {
					$(this).text('No results found.').fadeIn();
				});
				
				$('#answer').fadeOut(function() {
					$(this).text('No answer line.').fadeIn();
				});
				
				$('#next').attr('disabled', 'disabled');
				$('#previous').attr('disabled', 'disabled');
			}
		});
	});
	
	$('#previous').click(function() {
		$.get('questions.php', {previous: 1}, function(data){
			var info = jQuery.parseJSON(data);
			
			if (info.error == 0){
				$('#clue').fadeOut(function() {
					$(this).text(info.question.question.trim()).fadeIn();
				});
				
				$('#counts').fadeOut(function() {
					$(this).text(String(info.position + 1) + ' of ' + String(info.count)).fadeIn();
				});
				
				$('#answer').fadeOut(function() {
					$(this).text(info.question.answer).fadeIn();
				});
				
				if (info.first != 1){
					$('#previous').removeAttr('disabled');
				}
				
				else{
					$('#previous').attr('disabled', 'disabled');
				}
				
				$('#next').removeAttr('disabled');
			}
			
			else if (info.error == 2){
				$('#clue').fadeOut(function() {
					$(this).text('Your query or button click was invalid. Please try again.').fadeIn();
				});
				
				$('#counts').fadeOut(function() {
					$(this).text('No results found.').fadeIn();
				});
				
				$('#answer').fadeOut(function() {
					$(this).text('No answer line.').fadeIn();
				});
				
				$('#next').attr('disabled', 'disabled');
				$('#previous').attr('disabled', 'disabled');
			}
		});
	});
});
