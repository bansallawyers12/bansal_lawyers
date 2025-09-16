@extends('layouts.admin')
@section('title', 'Create Block Slot (New)')

@section('content')
<div class="main-content">
	<section class="section">
		<div class="section-body">
			<div class="server-error">@include('Elements.flash-message')</div>
			<div class="card">
				<div class="card-header">
					<h4>Create Block Slot (New)</h4>
					<div class="card-header-action">
						<a href="{{ route('admin.feature.bookingblocks.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
					</div>
				</div>
				<div class="card-body">
					<form method="post" action="{{ route('admin.feature.bookingblocks.store') }}">
						@csrf
						<div class="form-row">
							<div class="form-group col-md-3">
								<label>Person</label>
								<input type="text" class="form-control" value="Ajay" readonly>
								<input type="hidden" name="person_id" value="1">
							</div>
						</div>

						<div id="blocks_wrapper">
							<div class="row block_item">
								<div class="form-group col-md-3">
									<label>Date</label>
									<input type="text" class="form-control" name="date[0]" placeholder="DD/MM/YYYY" required>
								</div>
								<div class="form-group col-md-3 time-range">
									<label>Start Time</label>
									<input type="time" class="form-control" name="start_time[0]">
								</div>
								<div class="form-group col-md-3 time-range">
									<label>End Time</label>
									<input type="time" class="form-control" name="end_time[0]">
								</div>
								<div class="form-group col-md-3">
									<label>Full Day</label>
									<select name="full_day[0]" class="form-control full-day">
										<option value="0" selected>No</option>
										<option value="1">Yes</option>
									</select>
								</div>
							</div>
						</div>
						<div class="d-flex gap-2">
							<button type="button" id="add_more_create" class="btn btn-secondary mr-2">Add More</button>
							<button class="btn btn-primary" type="submit">Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection

@section('scripts')
<script {!! \App\Services\CspService::getNonceAttribute() !!}>
$(function(){
    var idx = 1;
    $('#blocks_wrapper').on('change', '.full-day', function(){
        var isFull = $(this).val() === '1';
        var row = $(this).closest('.block_item');
        row.find('.time-range input').prop('disabled', isFull);
        if(isFull){ row.find('.time-range input').val(''); }
    });

    $('#add_more_create').on('click', function(){
        var first = $('.block_item:first').clone();
        first.find('input, select').each(function(){
            var name = $(this).attr('name');
            name = name.replace('[0]', '['+idx+']');
            $(this).attr('name', name).val('');
        });
        $('#blocks_wrapper').append(first);
        idx++;
    });
});
</script>
@endsection


