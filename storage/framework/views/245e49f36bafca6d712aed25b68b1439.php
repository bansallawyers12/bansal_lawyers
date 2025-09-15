
<?php $__env->startSection('title', 'Block Slot'); ?>

<?php $__env->startSection('content'); ?>

<!-- Main Content -->
<div class="main-content">
        <section class="section">
                <div class="section-body">
                        <div class="server-error">
                                <?php echo $__env->make('../Elements/flash-message', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                        <div class="custom-error-msg">
                        </div>
                        <div class="row">
                                 <!--<div class="col-3 col-md-3 col-lg-3">
                                        
                        </div>-->
                                <div class="col-12 col-md-12 col-lg-12">
                                        <div class="card">
                                                <div class="card-header">
                                                        <h4>Block Slot</h4>
                                                        <!--<div class="card-header-action">
                                                                <a href="" class="btn btn-primary">Create Not Available Appointment Dates</a>
                                                        </div>-->
                                                </div>
                                                <div class="card-body">
                                                        <div class="table-responsive common_table">
                                                                <table class="table text_wrap">
                                                                <thead>
                                                                        <tr>
                                        <th>Person</th>
                                        <th>Block Slot</th>
                                                                                <th></th>
                                                                        </tr>
                                                                </thead>
                                                                <?php if($totalData !== 0): ?>
                                                                <?php $i=0; ?>
                                                                <tbody class="tdata">
                                                                <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <tr id="id_<?php echo e($list->id); ?>">
                                        <td><?php
                                        if(isset($list->person_id)){
                                            if($list->person_id == 1){
                                                $title = 'Ajay';
                                                /*if($list->service_type == 1){ //Paid
                                                    $title = 'Ajay - Paid';
                                                } elseif ($list->service_type == 2 ) { //Free
                                                    $title = 'Ajay - Free';
                                                }*/
                                            } else if( $list->person_id == 2 ){
                                                $title = 'Shubam';
                                            } else if( $list->person_id == 3 ){
                                                $title = 'Tourist';
                                            } else if( $list->person_id == 4 ){
                                                $title = 'Education';
                                            }
                                            //$title .=  "<br/>Daily Timings- ".date('H:i',strtotime($list->start_time))."-".date('H:i',strtotime($list->end_time));
                                            //$title .=  "<br/>Weekend- ".$list->weekend;
                                            echo  $title;
                                        }?></td>

                                                                                <td>
                                            <?php if(isset($list->disabledSlots) && !empty($list->disabledSlots) && count($list->disabledSlots) > 0): ?>
                                                <?php $__currentLoopData = $list->disabledSlots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slotVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <?php echo e(date("d/m/Y",strtotime($slotVal->disabledates))); ?>

                                                    -
                                                    <?php if(isset($slotVal->block_all) && $slotVal->block_all == 1): ?>
                                                        Full Day Blocked
                                                    <?php else: ?>
                                                        <?php echo e($slotVal->slots); ?>

                                                    <?php endif; ?>
                                                </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                N/A
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                                                                        <div class="dropdown d-inline">
                                                                                                <button class="btn btn-primary dropdown-toggle" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                                                                <div class="dropdown-menu">
                                                                                                        <a class="dropdown-item has-icon" href="<?php echo e(route('admin.feature.appointmentdisabledate.edit', base64_encode(convert_uuencode($list->id)))); ?>"><i class="far fa-edit"></i> Edit</a>
                                                    <a class="dropdown-item has-icon" href="javascript:;" onClick="deleteSlotAction(<?php echo e($list->id); ?>, 'book_service_disable_slots')"><i class="fas fa-trash"></i> Delete</a>
                                                </div>
                                                                                        </div>
                                                                                </td>
                                                                        </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </tbody>
                                                                <?php else: ?>
                                                                <tbody>
                                                                        <tr>
                                                                                <td style="text-align:center;" colspan="7">
                                                                                        No Record found
                                                                                </td>
                                                                        </tr>
                                                                </tbody>
                                                                <?php endif; ?>
                                                        </table>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </section>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
jQuery(document).ready(function($){
        $('.cb-element').change(function () {
        if ($('.cb-element:checked').length == $('.cb-element').length){
            $('#checkbox-all').prop('checked',true);
        } else {
            $('#checkbox-all').prop('checked',false);
        }
    });
});

function deleteSlotAction( id, table ) {
    var conf = confirm('Are you sure, you want to delete the slot.');
    if(conf){
        if(id == '') {
            alert('Please select ID to delete the record.');
            return false;
        } else {
            $('.popuploader').show();
            $(".server-error").html(''); //remove server error.
            $(".custom-error-msg").html(''); //remove custom error.
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
                        $("#quid_"+id).remove();
                        //show success msg
                        var html = successMessage(obj.message);
                        $(".custom-error-msg").html(html);

                        //show count
                        var old_count = $(".count").text();
                        var new_count = old_count - 1;
                        $(".count").text(new_count);
                    } else {
                        //show error msg
                        var html = errorMessage(obj.message);
                        $(".custom-error-msg").html(html);
                    }
                },
                error:function(resp) {
                    $('.popuploader').hide();
                    //show error msg
                    var html = errorMessage('Something went wrong. Please try again.');
                    $(".custom-error-msg").html(html);
                }
            });
        }
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/Admin/feature/appointmentdisabledate/index.blade.php ENDPATH**/ ?>