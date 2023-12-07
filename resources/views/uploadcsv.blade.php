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
                    <form id="generateForm" action="{{route('generate.pdf')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <!-- table starts -->
                        <table class="table3" border="1">
                            <tr>
                                <td>Upload Csv</td>
                                <td>
                                    <input type="file" name="csv_file" accept=".csv">
                                </td>
                            </tr>
                        </table>
                        <!-- table3 ends -->
                    
                        {{-- <input type="submit" value="open-pdf" class="save" name="pdf" /> --}}
                        <input type="submit" value="image" class="save" name="image"/>
                    </form>
                </div>
                <!-- div ends here -->
        </div>
        <!--right div ends--->
    </div>
    <!----middlecontainer ends -->
@endsection