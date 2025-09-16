@extends('layouts.admin')
@section('title', 'Update Block Slot (New)')

@section('content')
<div class="main-content">
	<section class="section">
		<div class="section-body">
			<div class="server-error">@include('Elements.flash-message')</div>
			<div class="card">
				<div class="card-header">
					<h4>Update Block Slot (New)</h4>
					<div class="card-header-action">
						<a href="{{route('admin.feature.bookingblocks.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
					</div>
				</div>
				<div class="card-body">
					<form method="post" action="{{ route('admin.feature.bookingblocks.edit') }}">
						@csrf
						<input type="hidden" name="id" value="{{ $fetchedData->id }}">
						<div class="form-group">
							<label>Disabled Dates and Slots</label>
							<div id="disable_dates_wrapper">
								@php $existingCount = isset($disableSlotArr) ? count($disableSlotArr) : 0; @endphp
								@if(isset($disableSlotArr) && $existingCount > 0)
									@foreach($disableSlotArr as $i => $slot)
										@php
											$displayDate = $slot->disabledates ? date('d/m/Y', strtotime($slot->disabledates)) : '';
											$start=''; $end='';
											if(!empty($slot->slots)){
												$parts = explode('-', $slot->slots);
												$start = $parts[0] ?? '';
												$end = $parts[1] ?? '';
											}
										@endphp
										<div class="disable_item row">
											<div class="col-md-3 mb-2">
												<label>Date</label>
												<input type="text" class="form-control" name="date[{{$i}}]" value="{{ $displayDate }}" placeholder="DD/MM/YYYY">
											</div>
											<div class="col-md-3 mb-2 time-range">
												<label>Start Time</label>
												<input type="time" class="form-control" name="start_time[{{$i}}]" value="{{ $start }}" @if($slot->block_all==1) disabled @endif>
											</div>
											<div class="col-md-3 mb-2 time-range">
												<label>End Time</label>
												<input type="time" class="form-control" name="end_time[{{$i}}]" value="{{ $end }}" @if($slot->block_all==1) disabled @endif>
											</div>
											<div class="col-md-3 mb-2">
												<label>Full Day</label>
												<select name="full_day[{{$i}}]" class="form-control full-day">
													<option value="0" @if($slot->block_all!=1) selected @endif>No</option>
													<option value="1" @if($slot->block_all==1) selected @endif>Yes</option>
												</select>
											</div>
										</div>
									@endforeach
								@else
									<div class="disable_item row">
										<div class="col-md-3 mb-2">
											<label>Date</label>
											<input type="text" class="form-control" name="date[0]" placeholder="DD/MM/YYYY">
										</div>
										<div class="col-md-3 mb-2 time-range">
											<label>Start Time</label>
											<input type="time" class="form-control" name="start_time[0]">
										</div>
										<div class="col-md-3 mb-2 time-range">
											<label>End Time</label>
											<input type="time" class="form-control" name="end_time[0]">
										</div>
										<div class="col-md-3 mb-2">
											<label>Full Day</label>
											<select name="full_day[0]" class="form-control full-day"><option value="0" selected>No</option><option value="1">Yes</option></select>
										</div>
									</div>
								@endif
							</div>
							<button type="button" id="add_more" class="btn btn-secondary">Add More</button>
						</div>
						<button class="btn btn-primary" type="submit">Save</button>
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
    var idx = {{ isset($disableSlotArr) ? count($disableSlotArr) : 1 }};
    $('#add_more').on('click', function(){
        var row = $('.disable_item:first').clone();
        row.find('input, select').each(function(){
            var name = $(this).attr('name');
            name = name.replace('[0]', '['+idx+']');
            $(this).attr('name', name).val('');
        });
        $('#disable_dates_wrapper').append(row);
        idx++;
    });

    $(document).on('change', '.full-day', function(){
        var isFull = $(this).val() === '1';
        var row = $(this).closest('.disable_item');
        row.find('.time-range input').prop('disabled', isFull);
        if(isFull){ row.find('.time-range input').val(''); }
    });
});
</script>
@endsection


