<form action="{{ route('package.update') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}">
    <div class="modal-body">
        <div class="mb-3 mt-3 formlabel">
            <label for="name" class="form-label"> Package Name</label>
            <input type="text" class="form-control" value="{{ $data->package_name }}" name="package_name">
        </div>
        <div class="mb-3 mt-3 formlabel">
            <label for="amount" class="form-label"> Package Amount</label>
            <input type="text" class="form-control" value="{{ $data->amount }}" name="amount">
        </div>
        <div class="mb-3 mt-3 formlabel">
            <label for="text" class="form-label"> Package Duration <sub style="color: #ee8049">(days)</sub></label>
            <input type="text" class="form-control" value="{{ $data->duration }}" name="duration">
        </div>
    </div>
    <div class="modal-footer formlabel mb-4">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
