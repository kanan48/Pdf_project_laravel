@extends('layouts.main')

@push ('title')
<title>UploadCsv</title>
@endpush 

@section('main-section')
<div class="maincontainer">
@include('layouts.left')
    <div class="right">	

        <h2>Upload Csv</h2>
        
        <!--div starts here--->			    					 
            <div class="add">
                <div class="addpage">Upload Csv</div> 
                <form method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <!-- table starts -->
                    <input type="hidden" name="edited" />
                    <table class="table3" border="1">
                        <tr>
                            <td>Upload Csv</td>
                            <td>
                                <input type="file" name="file" />
                            </td>
                        </tr>
                        <tr>
                            <td>Options*</td>
                            <td>
                                sku<input type="checkbox" name="sku" /><br />
                                qty.<input type="checkbox" name="qty" /><br />
                                Order Id<input type="checkbox" name="Oid" /><br />
                                Order Notes<input type="checkbox" name="Order" /><br />
                                Invoice no.<input type="checkbox" name="Invoice" />
                            </td>
                        </tr>
                    </table>
                    <!-- table3 ends -->
                
                    <input type="submit" value="open-pdf" class="save" name="pdf" />
                    <input type="submit" value="save-img" class="save" name="img" />
                </form>
                
            </div>
            <!-- div ends here -->
        </div>
    <!--right div ends--->
    </div>
    <!----middlecontainer ends -->
@endsection