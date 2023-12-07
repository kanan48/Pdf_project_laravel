@extends('layouts.main')

@push ('title')
    <title>Image Upload</title>
@endpush 

@section('main-section')
	<div class="maincontainer">
		@include('layouts/left')
		<!---right div starts-->
			<div class="right">			
				<h2>Upload Image Csv</h2>
				<!--div starts here--->			    					 
					<div class="add">
						<div class="addpage">Image Upload</div> 
						<form action="{{ route('uploadfile') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<!-- table starts -->
								<table class="table3" border="1px solid" >												
									<tr>						 
										<td>Uplaod image:
										</td>
										<td>
											<input type="file" name="csv_file" >
										</td>
									</tr>									
								</table>								
							<!-- table ends -->
							<input type="submit" value="Upload" class="save" name="save"/>
						</form>
					</div>
				<!-- div ends here -->
			</div>
		<!--right div ends--->
	</div>
@endsection