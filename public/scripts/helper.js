/**
 * Written by Plínio Andrade
 * <pandrade@fele.com>
 * <pliniofernando@hotmail.com>
 * This file contains helper functions for SubDrive Web System
 */
//Resizes the Headers of jTable regarding the number of characters.
function resize_headers(){
	var lengths = [];
	var i=0;
	var total=0;
	$('.jtable-column-header-text').map(function(){
		lengths[i] = $(this).text().length;
		total += lengths[i++];
	});
	var i=0;
	var test=0;
	$('.jtable-column-header').map(function(){		
		$(this).width(""+((lengths[i++]/total)*100).toString()+"%");														
	});		
}