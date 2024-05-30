@extends('layout.main')
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
        <li class="breadcrumb-item active" aria-current="page">Surat Keluar</li>
    </ol>
    <div class="card mb-4">
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body row">
            <input type="hidden" name="type" value="incoming">

            <div class="col-sm-12 col-12 col-md-6 col-lg-4 mb-3">
                <label for="reference_number" class="form-label">{{ __('model letter reference_number') }}</label>
                <input type="text" class="form-control input" id="reference_number" name="reference_number">
            </div>

            <div class="col-sm-12 col-12 col-md-6 col-lg-4 mb-3">
                <label for="from" class="form-label">{{ __('model.letter.from') }}</label>
                <input type="text" class="form-control" id="from" name="from">
            </div>

            <div class="col-sm-12 col-12 col-md-6 col-lg-4 mb-3">
                <label for="agenda_number" class="form-label">{{ __('model.letter.agenda_number') }}</label>
                <input type="text" class="form-control" id="agenda_number" name="agenda_number">
            </div>

            <div class="col-sm-12 col-12 col-md-6 col-lg-6 mb-3">
                <label for="letter_date" class="form-label">{{ __('model.letter.letter_date') }}</label>
                <input type="date" class="form-control" id="letter_date" name="letter_date">
            </div>

            <div class="col-sm-12 col-12 col-md-6 col-lg-6 mb-3">
                <label for="received_date" class="form-label">{{ __('model.letter.received_date') }}</label>
                <input type="date" class="form-control" id="received_date" name="received_date">
            </div>

            <div class="col-sm-12 col-12 col-md-12 col-lg-12 mb-3">
                <label for="description" class="form-label">{{ __('model.letter.description') }}</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>

            <div class="col-sm-12 col-12 col-md-6 col-lg-4 mb-3">
                <label for="classification_code" class="form-label">{{ __('model.letter.classification_code') }}</label>
                <select class="form-select" id="classification_code" name="classification_code">
                    <!-- Options should be added here -->
                </select>
            </div>

            <div class="col-sm-12 col-12 col-md-6 col-lg-4 mb-3">
                <label for="note" class="form-label">{{ __('model.letter.note') }}</label>
                <input type="text" class="form-control" id="note" name="note">
            </div>

            <div class="col-sm-12 col-12 col-md-6 col-lg-4 mb-3">
                <label for="attachments" class="form-label">{{ __('model.letter.attachment') }}</label>
                <input type="file" class="form-control @error('attachments') is-invalid @enderror" id="attachments" name="attachments[]" multiple>
                <span class="error invalid-feedback">{{ $errors->first('attachments') }}</span>
            </div>
        </div>

        <div class="card-footer pt-0">
            <button class="btn btn-primary" type="submit">{{ __('menu.general.save') }}</button>
        </div>
    </form>
</div>

@endsection