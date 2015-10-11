$('#cmbSection').change(function(){
	var section_id = this.value;
	$.ajax({
		type: 'POST',
		async: false,
		url: 'fetch_data/select_playlist.php',
		data: 'section_id='+section_id,
		success: function(data){
			$('#cmbPlaylist').html(data);
		}
	});
});