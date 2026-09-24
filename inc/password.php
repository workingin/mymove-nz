<?php
include('inc/header.php');
?>

<script src="validate.js"></script>


<style>
#strengthWrapper { 
 width:200px;
 height:35px;
 border-radius:3px;
}
</style>

				
					<div class="row">
						<div class="form-group col-md-6" style="padding: 0px 2px 0px 15px">								
							<input type="password" name="password" id="password" class="form-control" placeholder="Password..">		
						</div>		
						<div class="form-group col-md-4" style="padding: 1px 2px 3px 1px">	
							
						</div>
					</div>
					<div class="row hidden" id="strengthSection">
						<div class="form-group col-md-6">	
							<div id="strengthWrapper">
								<div class="form-control" id="strength"></div>
							</div>
						</div>
					</div>						
			