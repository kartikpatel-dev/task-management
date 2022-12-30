<div class="modal fade" id="ajaxModelDelete" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
			    <h4 class="modal-title text-danger" id="modelHeading">Delete <span class="data-title"></span></h4>
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>

			<div class="modal-body" >
				<p>Are you sure delete this <span class="data-title"></span>?</p>
				<p id="deleteMsg"></p>
			</div>

			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<form action="" method="POST" class="frmAjaxDelete">
	                {{ csrf_field() }}
	                {{ method_field('DELETE') }}
	                <button type="submit" class="btn btn-danger" id="delete_data">Delete</button>
	            </form>
			</div>
		</div>
	</div>
</div>