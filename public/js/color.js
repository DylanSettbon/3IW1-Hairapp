		var colorList = [ '637484', '808080', '696969', '778899', '708090', '2F4F4F',
'008080', '008B8B', '5F9EA0', '20B2AA', '1E90FF	', '6495ED', '4682B4', '4169E1', '483D8B',
'8A2BE2', '9400D3', '9932CC', '8B008B', '800080', '4B0082', '8B0000',
'FF0000', 'B22222', 'DC143C', 'CD5C5C', 'F08080',
'228B22', '008000', '006400', '3CB371', '2E8B57	', '20B2AA', '5F9EA0', '008B8B', '008080',
'BC8F8F', 'F4A460', 'DAA520', 'CD853F', 'D2691E', '8B4513', 'A0522D',
'A52A2A', '800000' ];
		var picker = $('#color-picker');

		for (var i = 0; i < colorList.length; i++ ) {
			picker.append('<li class="color-item" data-hex="' + '#' + colorList[i] + '" style="background-color:' + '#' + colorList[i] + ';"></li>');
		}


			picker.children('li').click(function() {
			event.stopPropagation();
				var codeHex = $(this).data('hex');

				$('.color-holder').css('background-color', codeHex);
				$('#pickcolor').val(codeHex);
			});
