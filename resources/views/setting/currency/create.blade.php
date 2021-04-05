<form action="{{route('currencies.store')}}" method="post">
    @csrf

    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">@translate(Name) <span class="text-danger">*</span></label>
        <input placeholder="@translate(Ex) : United State" type="text" class="form-control" name="name" autofocus required>
    </div>

    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">@translate(Symbol) <span class="text-danger">*</span></label>
        <input placeholder="@translate(Ex) : $" type="text" class="form-control" name="symbol" required>
    </div>

    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">@translate(Code) <span class="text-danger">*</span></label>
        <input placeholder="@translate(Ex) : USD" type="text" class="form-control" name="code" required>
    </div>

    <div class="form-group">
        <label for="name" class="col-form-label text-md-right">@translate(Exchange Rate Ex: 1 USD = ? ) <span class="text-danger">*</span></label>
        <input min="1" step="0.01" placeholder="@translate(Ex): 1 USD = ?" type="number" class="form-control" name="rate" required>
    </div>

    <div class="float-right">
        <button class="btn btn-primary" type="submit">@translate(Save)</button>
    </div>

</form>
