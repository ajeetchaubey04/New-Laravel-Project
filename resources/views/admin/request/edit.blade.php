<!-- Start Edit Request Modal -->
<div class="modal fade" id="edit-ajax-modal" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Request</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('admin.request.update') }}" enctype="multipart/form-data"
                autocomplete="off">
                @csrf
                @method('put')
                <input type="hidden" name="id" value="{{ base64_encode($request->id) }}">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Name</label>
                                <input type="text" class="form-control input-default name" name="name" required
                                    placeholder="Name" value="{{ old('name', $request->name) }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Email</label>
                                <input type="email" class="form-control input-default email" name="email" required
                                    placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                                    value="{{ old('email', $request->email) }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Phone</label>
                                <input type="text" class="form-control input-default phone" name="phone" required
                                    placeholder="Phone" maxlength="10" value="{{ old('phone', $request->phone) }}"
                                    pattern="[0-9]{10}"
                                    title="Please enter valid 10 Digit Mobile No. E.g. 9103180340"
                                    onkeypress="return /[0-9]/i.test(event.key)">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Alternate Phone</label>
                                <input type="text" class="form-control input-default alternate_phone"
                                    name="alternate_phone" required placeholder="Alternate Phone" maxlength="10"
                                    value="{{ old('alternate_phone', $request->alternate_phone) }}"
                                    onkeypress="return /[0-9]/i.test(event.key)">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Occupation</label>
                                <input type="text" class="form-control input-default occupation" name="occupation"
                                    required placeholder="Occupation"
                                    value="{{ old('occupation', $request->occupation) }}"
                                    onkeypress="return /[a-zA-Z]/i.test(event.key)">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Adhar Number</label>
                                <input type="text" class="form-control input-default adhar_card_no"
                                    name="adhar_card_no" required placeholder="Adhar Number"
                                    onkeypress="return /[0-9]/i.test(event.key)" maxlength="12"
                                    pattern="[0-9]{12}"
                                    title="Please enter valid Adhar number. E.g. 3912 2781 2501"
                                    value="{{ old('adhar_card_no', $request->adhar_card_no) }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Pan Number</label>
                                <input type="text" class="form-control input-default pan_card_no" name="pan_card_no"
                                    required placeholder="Pan Number" maxlength="10" oninput="this.value = this.value.toUpperCase()" 
                                    pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}" title="Please enter valid PAN number. E.g. AAAAA9999A"
                                    value="{{ old('pan_card_no', $request->pan_card_no) }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Price</label>
                                <input type="text" class="form-control input-default price" name="price" required
                                    placeholder="Price" onkeypress="return /[0-9]/i.test(event.key)" maxlength="10"
                                    value="{{ old('price', $request->price) }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Down Payment</label>
                                <input type="text" class="form-control input-default down_payment"
                                    name="down_payment" required placeholder="Down Payment"
                                    onkeypress="return /[0-9]/i.test(event.key)" maxlength="10"
                                    value="{{ old('down_payment', $request->down_payment) }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Emi Months</label>
                                <input type="text" class="form-control input-default emi_months" name="emi_months"
                                    required placeholder="Emi Months" onkeypress="return /[0-9]/i.test(event.key)"
                                    maxlength="2" value="{{ old('emi_months', $request->emi_months) }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Bank</label>
                                <select class="multi-select edit-ajax-select" required name="bank_id"
                                data-live-search="true" data-width="100%">
                                @foreach ($banks as $bank)
                                    <option {{ old('bank_id', $request->bank_id) == $bank->id ? 'selected' : '' }}
                                        value="{{ $bank->id }}">{{ $bank->title }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Finance Type</label>
                                <select class="multi-select edit-ajax-select" id="edit-ajax-select" required
                                    name="finance_type_id" data-live-search="true" data-width="100%">
                                    @foreach ($finance_types as $finance_type)
                                        <option
                                            {{ old('finance_type_id', $request->finance_type_id) == $finance_type->id ? 'selected' : '' }}
                                            value="{{ $finance_type->id }}">{{ $finance_type->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input  type="file" class="custom-file-input"
                                        name="request_adhar_front_img" accept="image/*">
                                    <label class="custom-file-label">Adhar Front</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input  type="file" class="custom-file-input"
                                        name="request_adhar_back_img" accept="image/*">
                                    <label class="custom-file-label">Adhar Back</label>
                                </div>
                            </div>
                        </div> --}}

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- End Edit Request Modal -->
