<div class="card">
    <div class="card-body">
        <form id="customerForm" action="{{ route('customers.update', $customer->id) }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            {{-- <div class="card-body"> --}}
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label>Customer Name *</label>
                        <input value="{{ isset($customer) ? $customer->name : null }}" type="text"
                            class="form-control" name="name" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Phone *</label>
                        <input value="{{ isset($customer) ? $customer->phone : null }}" type="number"
                            class="form-control" name="phone" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Address</label>
                        <input class="form-control" name="address" placeholder="Enter Address"
                            value="{{ isset($customer) ? $customer->address : null }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Status *</label>
                        <select name="status" class="form-control">
                            <option value="1"
                                {{ isset($customer) && $customer->status == 1 ? 'selected' : '' }}>
                                Active</option>
                            <option value="0"
                                {{ isset($customer) && $customer->status == 0 ? 'selected' : '' }}>
                                Inactive</option>
                        </select>
                    </div>
                </div>
            {{-- </div> --}}
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
