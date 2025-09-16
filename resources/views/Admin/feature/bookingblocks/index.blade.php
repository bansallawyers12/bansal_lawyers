@extends('layouts.admin')
@section('title', 'Block Slot (New)')

@section('content')

<!-- Main Content -->
<div class="main-content">
		<section class="section">
				<div class="section-body">
						<div class="server-error">
								@include('Elements.flash-message')
						</div>
						<div class="custom-error-msg"></div>
						<div class="row">
								<div class="col-12 col-md-12 col-lg-12">
										<div class="card">
												<div class="card-header">
														<h4>Block Slot (New)</h4>
														<div class="card-header-action">
																<a href="{{ route('admin.feature.bookingblocks.create') }}" class="btn btn-primary">Create</a>
														</div>
												</div>
												<div class="card-body">
														<div class="table-responsive common_table">
																<table class="table text_wrap table-striped">
																<thead>
																		<tr>
																				<th>Person</th>
																				<th>Block Slot</th>
																				<th></th>
																		</tr>
																</thead>
																@if($totalData !== 0)
																<?php $i=0; ?>
																<tbody class="tdata">
																@foreach ($lists as $list)
																		<tr id="id_{{$list->id}}">
																				<td>
																						Ajay
																				</td>

																				<td>
																					@if(isset($list->disabledSlots) && !empty($list->disabledSlots) && count($list->disabledSlots) > 0)
																							@foreach($list->disabledSlots as $slotVal)
																							<li>
																								{{ date("d/m/Y",strtotime($slotVal->disabledates)) }} -
																								@if(isset($slotVal->block_all) && $slotVal->block_all == 1)
																									Full Day Blocked
																								@else
																									{{ $slotVal->slots }}
																								@endif
																							</li>
																						@endforeach
																				@else
																					N/A
																				@endif
																			</td>

																			<td>
																				<div class="dropdown d-inline">
																					<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
																					<div class="dropdown-menu">
																							<a class="dropdown-item has-icon" href="{{ route('admin.feature.bookingblocks.edit', $list->id) }}"><i class="far fa-edit"></i> Edit</a>
																							<a class="dropdown-item has-icon" href="javascript:;" onClick="deleteSlotAction({{$list->id}}, 'book_service_disable_slots')"><i class="fas fa-trash"></i> Delete</a>
																					</div>
																				</div>
																			</td>
																</tr>
																@endforeach
																</tbody>
															@else
															<tbody>
																	<tr>
																		<td style="text-align:center;" colspan="7">No Record found</td>
																	</tr>
																</tbody>
															@endif
														</table>
												</div>
									</div>
							</div>
						</div>
				</div>
		</section>
</div>

@endsection
@section('scripts')
<script {!! \App\Services\CspService::getNonceAttribute() !!}>
function deleteSlotAction( id, table ) {
    var conf = confirm('Are you sure, you want to delete the slot.');
    if(conf){
        if(id == '') {
            alert('Please select ID to delete the record.');
            return false;
        } else {
            $('.popuploader').show();
            $(".server-error").html('');
            $(".custom-error-msg").html('');
            $.ajax({
                type:'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:site_url+'/admin/delete_slot_action',
                data:{'id': id, 'table' : table},
                success:function(resp) {
                    $('.popuploader').hide();
                    var obj = $.parseJSON(resp);
                    if(obj.status == 1) {
                        $("#id_"+id).remove();
                        var html = successMessage(obj.message);
                        $(".custom-error-msg").html(html);
                    } else {
                        var html = errorMessage(obj.message);
                        $(".custom-error-msg").html(html);
                    }
                },
                error:function(resp) {
                    $('.popuploader').hide();
                    var html = errorMessage('Something went wrong. Please try again.');
                    $(".custom-error-msg").html(html);
                }
            });
        }
    }
}
</script>
@endsection


