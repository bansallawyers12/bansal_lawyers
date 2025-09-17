<style>
/* Modern Flash Messages Design */
:root {
    --success-color: #10b981;
    --success-bg: #d1fae5;
    --success-border: #a7f3d0;
    --error-color: #ef4444;
    --error-bg: #fee2e2;
    --error-border: #fecaca;
    --warning-color: #f59e0b;
    --warning-bg: #fef3c7;
    --warning-border: #fde68a;
    --info-color: #3b82f6;
    --info-bg: #dbeafe;
    --info-border: #bfdbfe;
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --border-radius: 12px;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.modern-flash-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    max-width: 400px;
    width: 100%;
}

.modern-flash-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 16px 20px;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-lg);
    margin-bottom: 12px;
    position: relative;
    overflow: hidden;
    animation: slideInRight 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid;
    backdrop-filter: blur(10px);
}

.modern-flash-alert::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    border-radius: 2px 0 0 2px;
}

.modern-flash-alert.success {
    background: linear-gradient(135deg, var(--success-bg) 0%, rgba(209, 250, 229, 0.8) 100%);
    color: var(--success-color);
    border-color: var(--success-border);
}

.modern-flash-alert.success::before {
    background: linear-gradient(135deg, var(--success-color), #059669);
}

.modern-flash-alert.error {
    background: linear-gradient(135deg, var(--error-bg) 0%, rgba(254, 226, 226, 0.8) 100%);
    color: var(--error-color);
    border-color: var(--error-border);
}

.modern-flash-alert.error::before {
    background: linear-gradient(135deg, var(--error-color), #dc2626);
}

.modern-flash-alert.warning {
    background: linear-gradient(135deg, var(--warning-bg) 0%, rgba(254, 243, 199, 0.8) 100%);
    color: var(--warning-color);
    border-color: var(--warning-border);
}

.modern-flash-alert.warning::before {
    background: linear-gradient(135deg, var(--warning-color), #d97706);
}

.modern-flash-alert.info {
    background: linear-gradient(135deg, var(--info-bg) 0%, rgba(219, 234, 254, 0.8) 100%);
    color: var(--info-color);
    border-color: var(--info-border);
}

.modern-flash-alert.info::before {
    background: linear-gradient(135deg, var(--info-color), #2563eb);
}

.modern-flash-icon {
    flex-shrink: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 14px;
    font-weight: bold;
    margin-top: 2px;
}

.modern-flash-alert.success .modern-flash-icon {
    background: var(--success-color);
    color: white;
}

.modern-flash-alert.error .modern-flash-icon {
    background: var(--error-color);
    color: white;
}

.modern-flash-alert.warning .modern-flash-icon {
    background: var(--warning-color);
    color: white;
}

.modern-flash-alert.info .modern-flash-icon {
    background: var(--info-color);
    color: white;
}

.modern-flash-content {
    flex: 1;
    min-width: 0;
}

.modern-flash-title {
    font-weight: 600;
    font-size: 14px;
    margin: 0 0 4px 0;
    line-height: 1.4;
}

.modern-flash-message {
    font-size: 13px;
    line-height: 1.5;
    margin: 0;
    opacity: 0.9;
}

.modern-flash-close {
    position: absolute;
    top: 12px;
    right: 12px;
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
    color: inherit;
    opacity: 0.6;
    transition: var(--transition);
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
}

.modern-flash-close:hover {
    opacity: 1;
    background: rgba(0, 0, 0, 0.1);
}

.modern-flash-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 0 0 var(--border-radius) var(--border-radius);
    animation: progressBar 5s linear;
}

.modern-flash-alert.success .modern-flash-progress {
    background: var(--success-color);
}

.modern-flash-alert.error .modern-flash-progress {
    background: var(--error-color);
}

.modern-flash-alert.warning .modern-flash-progress {
    background: var(--warning-color);
}

.modern-flash-alert.info .modern-flash-progress {
    background: var(--info-color);
}

@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOutRight {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(100%);
        opacity: 0;
    }
}

@keyframes progressBar {
    from {
        width: 100%;
    }
    to {
        width: 0%;
    }
}

.modern-flash-alert.fade-out {
    animation: slideOutRight 0.3s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

@media (max-width: 768px) {
    .modern-flash-container {
        top: 10px;
        right: 10px;
        left: 10px;
        max-width: none;
    }
    
    .modern-flash-alert {
        padding: 14px 16px;
        margin-bottom: 8px;
    }
    
    .modern-flash-title {
        font-size: 13px;
    }
    
    .modern-flash-message {
        font-size: 12px;
    }
}
</style>

<div class="modern-flash-container">
    @if ($message = Session::get('success'))
    <div class="modern-flash-alert success" role="alert" data-auto-dismiss="5000">
        <div class="modern-flash-icon">
            <i class="fas fa-check"></i>
        </div>
        <div class="modern-flash-content">
            <div class="modern-flash-title">Success!</div>
            <div class="modern-flash-message">{{ $message }}</div>
        </div>
        <button type="button" class="modern-flash-close" onclick="dismissAlert(this)">
            <i class="fas fa-times"></i>
        </button>
        <div class="modern-flash-progress"></div>
    </div>
    @endif

    @if ($message = Session::get('error'))
    <div class="modern-flash-alert error" role="alert" data-auto-dismiss="7000">
        <div class="modern-flash-icon">
            <i class="fas fa-exclamation"></i>
        </div>
        <div class="modern-flash-content">
            <div class="modern-flash-title">Error!</div>
            <div class="modern-flash-message">{{ $message }}</div>
        </div>
        <button type="button" class="modern-flash-close" onclick="dismissAlert(this)">
            <i class="fas fa-times"></i>
        </button>
        <div class="modern-flash-progress"></div>
    </div>
    @endif

    @if ($message = Session::get('warning'))
    <div class="modern-flash-alert warning" role="alert" data-auto-dismiss="6000">
        <div class="modern-flash-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="modern-flash-content">
            <div class="modern-flash-title">Warning!</div>
            <div class="modern-flash-message">{{ $message }}</div>
        </div>
        <button type="button" class="modern-flash-close" onclick="dismissAlert(this)">
            <i class="fas fa-times"></i>
        </button>
        <div class="modern-flash-progress"></div>
    </div>
    @endif

    @if ($message = Session::get('info'))
    <div class="modern-flash-alert info" role="alert" data-auto-dismiss="5000">
        <div class="modern-flash-icon">
            <i class="fas fa-info"></i>
        </div>
        <div class="modern-flash-content">
            <div class="modern-flash-title">Information</div>
            <div class="modern-flash-message">{{ $message }}</div>
        </div>
        <button type="button" class="modern-flash-close" onclick="dismissAlert(this)">
            <i class="fas fa-times"></i>
        </button>
        <div class="modern-flash-progress"></div>
    </div>
    @endif

    @if ($errors->any())
    <div class="modern-flash-alert error" role="alert" data-auto-dismiss="8000">
        <div class="modern-flash-icon">
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <div class="modern-flash-content">
            <div class="modern-flash-title">Validation Errors</div>
            <div class="modern-flash-message">
                Please check the form below for errors:
                <ul style="margin: 8px 0 0 0; padding-left: 16px; font-size: 12px;">
                    @foreach ($errors->all() as $error)
                        <li style="margin-bottom: 2px;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <button type="button" class="modern-flash-close" onclick="dismissAlert(this)">
            <i class="fas fa-times"></i>
        </button>
        <div class="modern-flash-progress"></div>
    </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-dismiss alerts
    const alerts = document.querySelectorAll('.modern-flash-alert[data-auto-dismiss]');
    alerts.forEach(alert => {
        const dismissTime = parseInt(alert.dataset.autoDismiss);
        if (dismissTime > 0) {
            setTimeout(() => {
                dismissAlert(alert.querySelector('.modern-flash-close'));
            }, dismissTime);
        }
    });
});

function dismissAlert(closeBtn) {
    const alert = closeBtn.closest('.modern-flash-alert');
    if (alert) {
        alert.classList.add('fade-out');
        setTimeout(() => {
            alert.remove();
        }, 300);
    }
}

// Add sound notification for success (optional)
@if (Session::get('success'))
try {
    // Create a subtle success sound
    const audioContext = new (window.AudioContext || window.webkitAudioContext)();
    const oscillator = audioContext.createOscillator();
    const gainNode = audioContext.createGain();
    
    oscillator.connect(gainNode);
    gainNode.connect(audioContext.destination);
    
    oscillator.frequency.setValueAtTime(800, audioContext.currentTime);
    oscillator.frequency.setValueAtTime(1000, audioContext.currentTime + 0.1);
    
    gainNode.gain.setValueAtTime(0, audioContext.currentTime);
    gainNode.gain.linearRampToValueAtTime(0.1, audioContext.currentTime + 0.01);
    gainNode.gain.linearRampToValueAtTime(0, audioContext.currentTime + 0.2);
    
    oscillator.start(audioContext.currentTime);
    oscillator.stop(audioContext.currentTime + 0.2);
} catch (e) {
    // Silently fail if audio context is not available
}
@endif
</script>