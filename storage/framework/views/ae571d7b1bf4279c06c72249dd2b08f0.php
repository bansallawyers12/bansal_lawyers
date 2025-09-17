
<?php $__env->startSection('title', 'Contact Details'); ?>

<?php $__env->startSection('content'); ?>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Contact Details</h4>
                    <div class="btn-group">
                        <a href="<?php echo e(route('admin.contacts.index')); ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                        <button type="button" class="btn btn-primary" onclick="sendToBansalEmail()">
                            <i class="fas fa-envelope"></i> Send to Bansal Email
                        </button>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-edit"></i> Change Status
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" onclick="updateStatus('read')">Mark as Read</a>
                                <a class="dropdown-item" href="#" onclick="updateStatus('resolved')">Mark as Resolved</a>
                                <a class="dropdown-item" href="#" onclick="updateStatus('archived')">Archive</a>
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger" onclick="deleteContact()">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Contact Information -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Contact Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Name:</strong><br><?php echo e($contact->name); ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Email:</strong><br>
                                                <a href="mailto:<?php echo e($contact->contact_email); ?>"><?php echo e($contact->contact_email); ?></a>
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <p><strong>Subject:</strong><br><?php echo e($contact->subject); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Message -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Message</h5>
                                </div>
                                <div class="card-body">
                                    <div class="message-content">
                                        <?php echo nl2br(e($contact->message)); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <!-- Status Information -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Status Information</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Current Status:</strong><br>
                                        <span class="badge badge-<?php echo e($contact->status == 'unread' ? 'danger' : ($contact->status == 'resolved' ? 'success' : ($contact->status == 'archived' ? 'secondary' : 'info'))); ?> badge-lg">
                                            <?php echo e(ucfirst($contact->status ?? 'unread')); ?>

                                        </span>
                                    </p>
                                    
                                    <p><strong>Submitted:</strong><br>
                                        <?php echo e($contact->created_at->format('d/m/Y H:i:s')); ?><br>
                                        <small class="text-muted"><?php echo e($contact->created_at->diffForHumans()); ?></small>
                                    </p>
                                    
                                    <?php if($contact->forwarded_to): ?>
                                    <p><strong>Forwarded To:</strong><br>
                                        <?php echo e($contact->forwarded_to); ?><br>
                                        <small class="text-muted"><?php echo e($contact->forwarded_at->format('d/m/Y H:i:s')); ?></small>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Quick Actions -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Quick Actions</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="mailto:<?php echo e($contact->contact_email); ?>?subject=Re: <?php echo e($contact->subject); ?>" 
                                           class="btn btn-primary btn-block">
                                            <i class="fas fa-reply"></i> Reply via Email Client
                                        </a>
                                        
                                        <button type="button" class="btn btn-info btn-block" onclick="sendToBansalEmail()">
                                            <i class="fas fa-envelope"></i> Send to Bansal Email
                                        </button>
                                        
                                        <button type="button" class="btn btn-info btn-block" onclick="copyToClipboard('<?php echo e($contact->contact_email); ?>')">
                                            <i class="fas fa-copy"></i> Copy Email Address
                                        </button>
                                        
                                        <button type="button" class="btn btn-secondary btn-block" onclick="copyContactDetails()">
                                            <i class="fas fa-clipboard"></i> Copy All Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Contact Summary -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Summary</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Contact ID:</strong> #<?php echo e($contact->id); ?></p>
                                    <p><strong>Message Length:</strong> <?php echo e(strlen($contact->message)); ?> characters</p>
                                    <p><strong>Word Count:</strong> <?php echo e(str_word_count($contact->message)); ?> words</p>
                                </div>
                            </div>
                        </div>
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

function updateStatus(status) {
    const contactId = <?php echo e($contact->id); ?>;
    
    fetch(`/admin/contacts/${contactId}/status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        alert('Error updating status: ' + error.message);
    });
}

function deleteContact() {
    if (confirm('Are you sure you want to delete this contact? This action cannot be undone.')) {
        const contactId = <?php echo e($contact->id); ?>;
        
        fetch(`/admin/contacts/${contactId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Contact deleted successfully!');
                window.location.href = '<?php echo e(route("admin.contacts.index")); ?>';
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            alert('Error deleting contact: ' + error.message);
        });
    }
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show temporary success message
        const btn = event.target.closest('button');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
        btn.classList.add('btn-success');
        btn.classList.remove('btn-info');
        
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.classList.remove('btn-success');
            btn.classList.add('btn-info');
        }, 2000);
    }).catch(function(err) {
        alert('Failed to copy to clipboard: ' + err);
    });
}

function copyContactDetails() {
    const contactDetails = `
Contact Details:
Name: <?php echo e($contact->name); ?>

Email: <?php echo e($contact->contact_email); ?>

Subject: <?php echo e($contact->subject); ?>

Submitted: <?php echo e($contact->created_at->format('d/m/Y H:i:s')); ?>


Message:
<?php echo e($contact->message); ?>

    `.trim();
    
    copyToClipboard(contactDetails);
}

function sendToBansalEmail() {
    if (confirm('Send this contact query to info@bansalemail.com for further processing?')) {
        const contactId = <?php echo e($contact->id); ?>;
        
        fetch(`/admin/contacts/${contactId}/send-to-bansal-email`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('Contact query sent to info@bansalemail.com successfully!');
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error sending to Bansal email. Please try again.');
        });
    }
}
</script>

<style>
.message-content {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 5px;
    border-left: 4px solid #007bff;
    line-height: 1.6;
}

.badge-lg {
    font-size: 0.9em;
    padding: 0.5em 0.75em;
}

.d-grid {
    display: grid;
}

.gap-2 {
    gap: 0.5rem;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/admin/contacts/show.blade.php ENDPATH**/ ?>