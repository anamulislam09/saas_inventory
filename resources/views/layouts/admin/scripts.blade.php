<!-- Sweet Alert -->
<script src="{{ asset('public/admin-assets') }}/plugins/sweetalert2/sweetalert2_from_cdn.js"></script>
<!-- jQuery -->
<script src="{{ asset('public/admin-assets') }}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('public/admin-assets') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>  $.widget.bridge('uibutton', $.ui.button) </script>
<!-- Bootstrap 4 -->
<script src="{{ asset('public/admin-assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Sparkline -->
<script src="{{ asset('public/admin-assets') }}/plugins/sparklines/sparkline.js"></script>
<!-- daterangepicker -->
<script src="{{ asset('public/admin-assets') }}/plugins/moment/moment.min.js"></script>
<script src="{{ asset('public/admin-assets') }}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('public/admin-assets') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{ asset('public/admin-assets') }}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('public/admin-assets') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/admin-assets') }}/dist/js/adminlte.js"></script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('public/admin-assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('public/admin-assets') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('public/admin-assets') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('public/admin-assets') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('public/admin-assets') }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('public/admin-assets') }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('public/admin-assets') }}/plugins/pdfmake/vfs_fonts.js"></script>

<!-- Select2 -->
<script src="{{ asset('public/admin-assets') }}/plugins/select2/js/select2.full.min.js"></script>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": false,
            "lengthChange": true,
            "autoWidth": true
        });
        $('.select2').select2();
    });

    $(document).ready(function(){
        notification();
        $(document).on('click', '.delete button', function(e) {
            e.preventDefault();
            let form = $(this).closest('form');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed){
                    form.submit();
                }
            });
        });
        setInterval(() =>{
            notification();
        },10000);
        $('.add-new').click(function(e) {
            e.preventDefault();
            window.location.replace($(this).attr('add-new'));
        });
    });


    function notification() {
        $.ajax({
                url: "{{ route('dashboard.pendings') }}",
                type: 'GET',
                dataType: 'JSON',
                success: function(res){
                    $('.pending_pmt_count').html(res.pending_collections);
                    $('.pending_orders_in_kit').html(res.pending_orders_in_kit);
                    $('.pending_order_count').html(res.pending_orders);
                    $('.pending_in_pos').html(res.pending_in_pos);
                }
            });
    }
    
    function nsSetItem(key,value) {
        localStorage.setItem(key, JSON.stringify(value));
    }
    function nsGetItem(key) {
        return JSON.parse(localStorage.getItem(key));
    }
    function nsFormatNumber(num) {
        return num.toLocaleString('en-US',{minimumFractionDigits:2,maximumFractionDigits:2});
    }
    function nsTBodyMessage(length,tbody_id){
        if(!length){
            $('#'+tbody_id).html('<tr><td style="text-align: center;" colspan="10"><b>No Data Found!</b></td></tr>');
        }
    }
    function nsTBodyLoading(tbody_id){
        $('#'+tbody_id).html('<tr><td style="text-align: center;" colspan="10"><b>Loading data...</b></td></tr>');
    }
    function nsMMYYYY(input_date){
        var parts = input_date.split('-');
        var year = parts[0];
        var month = parts[1];
        var myDate = new Date(year, month - 1);
        return myDate.toLocaleDateString('en-US', { year: 'numeric', month: 'long' }).replace(/ /,", ");
    }
    function nsYYYYMMDD(input_date){
        return (new Date(input_date)).toLocaleDateString('en-CA', { year: 'numeric', month: '2-digit', day: '2-digit' });
    }
    function nsTime12(input_date){
        return (new Date(input_date)).toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true })
    }
    function nsAjaxPost(url,data){
        return new Promise((resolve, reject) => {
        $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: url,
                data: data,
                type: 'POST',
                dataType: 'JSON',
                success: function(res){
                    resolve(res);
                },
                error: function(err) {
                    reject(err);
                }
            });
        });
    }
    function nsAjaxGet(url){
        return new Promise((resolve, reject) => {
        $.ajax({
                url: url,
                method: 'GET',
                dataType: 'JSON',
                success: function(res){
                    resolve(res);
                },
                error: function(err) {
                    reject(err);
                }
            });
        });
    }
    function nsBuildOptions(items, defaultText) {
        let options = `<option value="">${defaultText}</option>`;
        items.forEach(item => {
            options += `<option value="${item.id}">${item.title}</option>`;
        });
        return options;
    }
    function nsSetOption(params) {
        if (!params.hasOwnProperty('valueColumn')) params.valueColumn = 'id';
        let options = '';
        if(params.hasOwnProperty('selectedValue')){
            if(params.defaultText){
                options += `<option ${params.selectedValue==params.defaultValue?'selected':null} value="${params.defaultValue}">${params.defaultText}</option>`;
            }
            params.data.forEach(item => {
                options += `<option ${params.selectedValue==item[params.valueColumn]?'selected':null} value="${item[params.valueColumn]}">${item[params.displayColumn]}</option>`;
            });
        }else{
            options += `<option value="${params.defaultValue}">${params.defaultText}</option>`;
            params.data.forEach(item => {
                options += `<option value="${item[params.valueColumn]}">${item[params.displayColumn]}</option>`;
            });
        }
        if(params.selectElementId){
            $('#' + params.selectElementId).html(options);
        }else{
            return options;
        }
    }

</script>