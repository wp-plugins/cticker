(function() {
	tinyMCE.DOM.addClass('cticker_mcebutton', 'ctickerclass');
	tinymce.PluginManager.add('cticker_mcebutton', function( editor, url ) {
		editor.addButton( 'cticker_mcebutton', {
			title: 'CTicker',
			image: url+'/cticker-mcebutton.png',
						onclick: function() {
								editor.windowManager.open( {
									title: 'CTicker Shortcode',
									onPostRender: function() {
																this.addClass('cticker-mcepopup');
															 },
	
									body: [
										{
											type: 'textbox',
											name: 'ctickerId',
											label: 'CTicker Id',
											value: 'ctickerid'
										},
										{
											type: 'textbox',
											name: 'ctickerSpeed',
											label: 'CTicker Speed',
											value: '20'
										},
										{
											type: 'listbox',
											name: 'postCount',
											label: 'Number of Post Show',
											'values': [
												{text: 'All', value: '-1'},
												{text: 'Latest 5', value: '5'},
												{text: 'Latest 10', value: '10'},
												{text: 'Latest 15', value: '15'},
												{text: 'Latest 20', value: '20'},
												{text: 'Latest 25', value: '25'},
												{text: 'Latest 30', value: '30'},
											]
										},
										{
											type: 'textbox',
											name: 'buttonName',
											label: 'Button Name',
											value: 'Latest Post'
										},
										{
											type: 'textbox',
											name: 'buttonBg',
											label: 'Button BG Color',
											value: '#00ADED'
										},
										{
											type: 'textbox',
											name: 'buttontextColor',
											label: 'Button Text Color',
											value: '#ffffff'
										},
										{
											type: 'textbox',
											name: 'ctickerbgColor',
											label: 'CTicker BG Color',
											value: '#ffffff'
										},
										{
											type: 'textbox',
											name: 'ctickertextColor',
											label: 'CTicker Text Color',
											value: '#000000'
										},
										{
											type: 'listbox',
											name: 'hoverEffect',
											label: 'Hover Pause',
											'values': [
												{text: 'Yes', value: 'true'},
												{text: 'No', value: 'false'},
											]
										},
										
									],
									onsubmit: function( e ) {
										editor.insertContent( '[cticker_list id="' + e.data.ctickerId + '" cticker_speed="' + e.data.ctickerSpeed + '" count="' + e.data.postCount + '" button_text="' + e.data.buttonName + '" background_color="' + e.data.buttonBg + '" button_textcolor="' + e.data.buttontextColor + '" right_bgcolor="' + e.data.ctickerbgColor + '" right_textcolor="' + e.data.ctickertextColor + '" hover="' + e.data.hoverEffect + '" ]');
									}
								});
							}
	});
	});
})();