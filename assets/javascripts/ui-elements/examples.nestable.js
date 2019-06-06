

(function( $ ) {

	'use strict';
		
	/*
	Update Output
	*/
	var updateOutput = function (e) {
		var list = e.length ? e : $(e.target),
			output = list.data('output');

		if (window.JSON) {
			output.val(window.JSON.stringify(list.nestable('serialize')));
		} else {
			output.val('JSON browser support required for this demo.');
		}
	};

	/*
	Nestable 1
	*/
	$('#nestable').nestable({
		group: 1, 
		maxDepth: 0,
		noDragClass:'dd-nodrag',
		onDragStart: function (l, e) {
			return false;
		}
	}).on('change', updateOutput);
	//.nestable('collapseAll');

	/*
	Output Initial Serialised Data
	*/
	$(function() {
		updateOutput($('#nestable').data('output', $('#nestable-output')));
	});

}).apply(this, [ jQuery ]);