<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
  include_once("header.php");
  ?>
	<script src="js/region.js"></script>
	<link href="css/suncom.css" rel="stylesheet">
    <!-- Custom styles for this template -->
	<style>
	.show > .dropdown-menu {
	  display: block;
	}
	.multiselect-container
	{
		min-width:240px;
	}
	.multiselect-clear-filter:before {
		font-family: FontAwesome;
		content: "\f05c";
	}
	.input-group-addon:before
	{
		font-family: FontAwesome;
		content: "\f002";	
	}

	</style>
  </head>

  <body>

  <?php
  include_once("menu.php");
  ?>

    <div class="container">

      <!--<div class="starter-template">
        <h1>Bootstrap starter template</h1>
        <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
      </div>-->
	  <div class="row">
		<h5 class="text-left" style="padding-left:30px;"><u>Region</u></h5>
		<div class="col-md-12">
			<div class="col-md-12" id="region_view">
			<table id="view_region_details" class="display responsive" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Region Name</th>
						<th>Edit</th>
					</tr>
				</thead>          
			</table> 
			</div>
		</div>
	  </div>
	  
	  <div class="modal fade" id="region_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title">New Region</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				  <div class="form-group">
					<label class="control-label">Region</label>
					<div>										
						<select class="form-control input-lg select_box selectpicker" data-live-search="true" title="--Please Select Region--" name="region_name" id="region_name" style="font-size:11px;" >
						</select>
					</div>
				 </div>
			  </div>
			  <!--<div class="alert alert-danger" role="alert" id="delete_alert" style="margin:5px;padding:5px">
				  <p class="text-center" style="padding:0px;margin:0px;">Make sure store list is empty</p>
			  </div>-->
			  <div class="modal-footer">
				<button type="button" id="save_region_details" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>
		<script>
				$('#region_name').selectpicker();					
		</script>
    </div><!-- /.container -->
  </body>
  <?php
  include_once("footer.php");
  ?>
</html>
