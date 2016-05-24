var currentLevel = 0;

function disArray(arr) {

	var x;
	
	for (x = 0; x < arr.length; x++) {
	
		var y = Math.floor(Math.random() * arr.length);
		var z = Math.floor(Math.random() * arr.length);
		var w = arr[y];
		
		arr[y] = arr[z];
		arr[z] = w;
	
	}

}

function pintaFrase(frase) {

	var x = 0;
	var palabras = frase.split(" ");
	
	// disarray the words
	disArray(palabras);
	
	// clean the board
	$("#dropping_area").html("");
	
	// write all the words on the board
	for (x = 0; x < palabras.length; x++) {
		if (palabras[x].indexOf("|") > 0) {
			var p2 = palabras[x].split("|");
			$("#dropping_area").append('<div class="palabra modificable" data-original="' + p2[1] + '"><span contenteditable="true">' + p2[1] + '</span></div>');
		} else {
			$("#dropping_area").append('<div class="palabra"><span>' + palabras[x] + '</span></div>');
		}
	}
	
	// if the word that can be modified is blank, it is reset to the original value
	$(".palabra.modificable span").on("blur", function() {
		if ($.trim($(this).text()) == "") {
			$(this).text($(this).parent().data("original"));
		}
	});

}

$(document).ready(function() {

	// change page title
	document.title = settings.pageTitle;

	// check if local storage; if there is, load the last level played
	if (localStorage) {
		if (localStorage.nivel) {
			currentLevel = localStorage.nivel;
		} else {
			localStorage["nivel"] = 0;
		}
	} else {
		alert(settings.noLocalStorage);
	} 

	// all words will be sortable, but the ones that can be modified (as they created problems in initial versions)
	$("#dropping_area").sortable({ cancel:".palabra.modificable span" });

	// specify behaviour when clicking on the button
	$("#button_game").on("click", function() {
		
		var aux = "";
		
		// add all the words in the same order they are in the dropping area
		$("#dropping_area").find(".palabra").each(function() {
			
			if ($(this).hasClass("modificable")) {
				aux = aux + $(this).text() + "|" + $(this).data("original") + " ";
			} else {
				aux = aux + $(this).text() + " ";
			}
			
		});
		
		// we clean the blank space at the end of the sentence
		aux = $.trim(aux);
		
		if (sentences[currentLevel] == aux) {
		
			// if the sentence was correct, we display a success message and move to the next one (if any)
			alert(settings.successMessage);
			
			// we advance the level and save progress
			currentLevel++;
			
			if (currentLevel < sentences.length) {
			
				pintaFrase(sentences[currentLevel]);
			
			} else {
				
				alert(settings.gameOveMessage);
				
			}
			
			localStorage["nivel"] = currentLevel;
		
		} else {
		
			// if the sentence is incorrect, we display an "unsuccess" message
			alert(settings.unsuccessMessage);
		
		}
		
	});
	
	
	// if you have completed all the sentences, you go back to the beginning
	if (currentLevel >= sentences.length) {
		currentLevel = 0;
	}
	
	// start game!!
	pintaFrase(sentences[currentLevel]);
	
});