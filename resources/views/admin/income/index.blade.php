@extends('admin.layouts.app')

@section('content') 

<div class="container-fluid">
  <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">All Income</h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ list</span>
            </div>
        </div>
        
    </div>
    <!-- breadcrumb -->
   
    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
            <div class="card">
                <div class="card-header pb-0">
                    <p class="tx-12 tx-gray-500 mb-2">Listing of All Income...</p>
                </div>
                <div class="card-body">

                    <!-- Listing all data in user tables -->
                    <div class="table-responsive border-top userlist-table">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0" id="datatable">
                            <thead>
                                <tr>
												
												<th class="wd-lg-20p"><span>Channel Name</span></th>
												<th class="wd-lg-20p"><span>Insurance Company</span></th>
												<th class="wd-lg-20p"><span>Policy Holder Name</span></th>
												<th class="wd-lg-20p"><span>Transaction Type</span></th>
												<th class="wd-lg-20p"><span>Sub Product</span></th>
												<th class="wd-lg-20p"><span>GWP/Premium</span></th>
												<th class="wd-lg-20p"><span>Commission Status</span></th>
												<th class="wd-lg-20p"><span>Created</span></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!-- COL END -->
    </div>

</div>

<!-- model end -->



@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="ttps://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                    url: "{{ route('income.index') }}",   
                    },
                 
                    dom: 'Blfrtip',
                                columns: [
                                {data: 'channel_name', name: 'channel_name'},
                                {data: 'company', name: 'company'},
                                {data: 'lead', name: 'lead'},
                                {data: 'mis_transaction_type', name: 'mis_transaction_type'},
                                {data: 'subProduct', name: 'subProduct'},
                                {data: 'gross_premium', name: 'gross_premium'},
                                {data: 'renew_status', name: 'renew_status'},
                                {data: 'created_at', name: 'created_at'},
                                ]
                            });

    });
</script>
@endsection
