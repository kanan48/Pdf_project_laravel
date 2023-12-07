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
                    <form method="post" id="uploadForm" action="" enctype="multipart/form-data">    
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
                    
                        <input type="submit" value="Pdf" class="save" name="pdf" onclick="setAction('pdf')"/>
                        <input type="submit" value="image" class="save" name="image" onclick="setAction('image')"/>
                    </form>
                   
                </div>
                <!-- div ends here -->
        </div>
        <!--right div ends--->
    </div>
    <!----middlecontainer ends -->
    <script>
        function setAction(actionType) {
            var form = document.getElementById('uploadForm');
    
            if (actionType === 'pdf') {
                form.action = "{{ route('pdf') }}";
            } else if (actionType === 'image') {
                form.action = "{{ route('generate.pdf') }}";
            }
        }
    </script>
@endsection