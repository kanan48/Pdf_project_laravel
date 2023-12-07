@extends('layouts.main')

@push ('title')
<title></title>
@endpush 

@section('main-section')

			<div class="maincontainer">
		    @include('layouts/left')
			<!---right div starts-->
				<div class="right">			
					<h2>Change Password</h2>
					<!--div starts here--->			    					 
						<div class="add">
							<div class="addpage">Change Password</div> 
								<form method="post" action="{{Route('change.password')}}">
									@csrf
								<!-- table starts -->
								
									<table class="table3" border="1px solid" >												
										<tr>						 
											<td> Enter old password
											</td>
											<td>
												<input type="text" name="oldpass" >
											</td>
										</tr>				
										<tr>						 
											<td> Enter new password
											</td>
											<td>
												<input type="text" name="newpass" >
											</td>
										</tr>	
										<tr>						 
											<td> Confirm new password
											</td>
											<td>
												<input type="text" name="cnewpass" >
											</td>
										</tr>	
														
									</table>
									
								<!-- table3 ends -->
								
							<input type="submit" value="save" class="save" name="save"/>
							</form>
					 	</div>
					<!-- div ends here -->
				</div>
            <!--right div ends--->
			</div>
        <!----middlecontainer ends -->
@endsection