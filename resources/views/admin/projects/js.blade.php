@section('scripts')
<script src="{{ asset('js/select.js') }}"> </script>
<script>
	function projectImage(id){
		    $('iframe#image').attr('src', '/filemanager/dialog.php?type=1&field_id=' + id);
            console.log(id);
	}

	function deletePic(id){
		$('#project_image_'+id).remove();
	}
</script>
@endsection