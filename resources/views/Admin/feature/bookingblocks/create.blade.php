@extends('layouts.admin')
@section('title', 'Create Booking Block')

@section('content')
<style {!! \App\Services\CspService::getNonceAttribute() !!}>
/* Modern Booking Block Create Design System */
:root {
    --primary-color: #1B4D89;
    --secondary-color: #2c5aa0;
    --accent-color: #FF6B35;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --info-color: #06b6d4;
    --booking-color: #f59e0b;
    --booking-secondary: #d97706;
    --text-dark: #1e293b;
    --text-light: #64748b;
    --bg-light: #f8fafc;
    --white: #ffffff;
    --border-color: #e2e8f0;
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --border-radius: 12px;
    --border-radius-sm: 8px;
    --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

.modern-page-container {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 100vh;
    padding: 2rem 0;
}

.modern-card {
    background: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    border: 1px solid var(--border-color);
    overflow: hidden;
    transition: var(--transition);
    max-width: 1000px;
    margin: 0 auto;
}

.modern-card-header {
    background: linear-gradient(135deg, var(--booking-color) 0%, var(--booking-secondary) 100%);
    padding: 1.5rem 2rem;
    border-bottom: none;
    position: relative;
    overflow: hidden;
}

.modern-card-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.modern-card-title {
    color: var(--white);
    font-size: 1.75rem;
    font-weight: 700;
    margin: 0;
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.modern-card-title i {
    font-size: 1.5rem;
    opacity: 0.9;
}

.modern-header-actions {
    position: relative;
    z-index: 2;
    margin-top: 1.5rem;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.modern-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: var(--border-radius-sm);
    font-weight: 600;
    font-size: 0.875rem;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
}

.modern-btn-back {
    background: rgba(255, 255, 255, 0.2);
    color: var(--white);
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.modern-btn-back:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-2px);
    color: var(--white);
    text-decoration: none;
}

.modern-btn-primary {
    background: linear-gradient(135deg, var(--accent-color) 0%, #FF8E53 100%);
    color: var(--white);
}

.modern-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3);
    color: var(--white);
    text-decoration: none;
}

.modern-btn-secondary {
    background: linear-gradient(135deg, var(--text-light) 0%, #475569 100%);
    color: var(--white);
}

.modern-btn-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(100, 116, 139, 0.3);
    color: var(--white);
    text-decoration: none;
}

.modern-card-body {
    padding: 2rem;
}

.modern-form-section {
    margin-bottom: 2rem;
}

.modern-form-section:last-child {
    margin-bottom: 0;
}

.modern-section-title {
    color: var(--text-dark);
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--border-color);
}

.modern-section-title i {
    color: var(--booking-color);
}

.modern-form-group {
    margin-bottom: 1.5rem;
}

.modern-form-label {
    display: block;
    color: var(--text-dark);
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.modern-form-label .required {
    color: var(--danger-color);
    margin-left: 0.25rem;
}

.modern-form-input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    color: var(--text-dark);
    background: var(--white);
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
}

.modern-form-input:focus {
    outline: none;
    border-color: var(--booking-color);
    box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
    transform: translateY(-1px);
}

.modern-form-input:disabled {
    background: var(--bg-light);
    color: var(--text-light);
    cursor: not-allowed;
}

.modern-form-input[readonly] {
    background: var(--bg-light);
    border-color: var(--border-color);
    color: var(--text-dark);
    font-weight: 600;
}

.modern-form-select {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    color: var(--text-dark);
    background: var(--white);
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
    appearance: none;
    background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="%236B7280" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 8l4 4 4-4"/></svg>');
    background-position: right 0.75rem center;
    background-repeat: no-repeat;
    background-size: 1rem;
    padding-right: 2.5rem;
}

.modern-form-select:focus {
    outline: none;
    border-color: var(--booking-color);
    box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
    transform: translateY(-1px);
}

.modern-help-text {
    color: var(--text-light);
    font-size: 0.75rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.modern-help-text i {
    color: var(--info-color);
}

.modern-form-input.is-invalid {
    border-color: var(--danger-color);
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

.modern-field-error {
    color: var(--danger-color);
    font-size: 0.75rem;
    margin-top: 0.35rem;
    font-weight: 500;
}

.modern-validation-summary {
    background: #fef2f2;
    border: 1px solid #fecaca;
    border-radius: var(--border-radius-sm);
    padding: 1rem 1.25rem;
    margin-bottom: 1.25rem;
    color: #991b1b;
    font-size: 0.875rem;
}

.modern-validation-summary ul {
    margin: 0.5rem 0 0;
    padding-left: 1.25rem;
}

.modern-validation-summary li {
    margin-bottom: 0.25rem;
}

.modern-success-summary {
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    border-radius: var(--border-radius-sm);
    padding: 1rem 1.25rem;
    margin-bottom: 1.25rem;
    color: #065f46;
    font-size: 0.875rem;
}

.modern-booking-hours-note {
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    border-radius: var(--border-radius-sm);
    padding: 0.875rem 1rem;
    margin-bottom: 1.25rem;
    color: #1e40af;
    font-size: 0.8125rem;
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
}

.modern-person-display {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: var(--white);
    padding: 1rem;
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 2rem;
}

.modern-person-icon {
    width: 3rem;
    height: 3rem;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}

.modern-person-info h4 {
    margin: 0;
    font-size: 1.125rem;
    font-weight: 600;
}

.modern-person-info p {
    margin: 0;
    font-size: 0.875rem;
    opacity: 0.9;
}

.modern-block-container {
    background: var(--bg-light);
    border: 2px dashed var(--border-color);
    border-radius: var(--border-radius-sm);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    transition: var(--transition);
}

.modern-block-container:hover {
    border-color: var(--booking-color);
    background: #fefce8;
}

.modern-block-item {
    background: var(--white);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    padding: 1.5rem;
    margin-bottom: 1rem;
    box-shadow: var(--shadow-sm);
    position: relative;
    transition: var(--transition);
}

.modern-block-item:hover {
    box-shadow: var(--shadow);
    transform: translateY(-1px);
}

.modern-block-item:last-child {
    margin-bottom: 0;
}

.modern-block-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid var(--border-color);
}

.modern-block-title {
    color: var(--text-dark);
    font-size: 1rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.modern-block-number {
    background: var(--booking-color);
    color: var(--white);
    width: 1.5rem;
    height: 1.5rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 700;
}

.modern-form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    align-items: start;
}

.modern-form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 2px solid var(--border-color);
}

.modern-form-actions-left {
    display: flex;
    gap: 1rem;
}

.modern-form-actions-right {
    display: flex;
    gap: 1rem;
}

.modern-add-block-btn {
    background: linear-gradient(135deg, var(--text-light), #475569);
    color: var(--white);
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: var(--border-radius-sm);
    font-weight: 600;
    font-size: 0.875rem;
    cursor: pointer;
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.modern-add-block-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(100, 116, 139, 0.3);
}

.modern-time-toggle {
    position: absolute;
    top: 1rem;
    right: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--white);
    padding: 0.5rem;
    border-radius: var(--border-radius-sm);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-color);
}

.modern-toggle-label {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--text-dark);
}

/* Loading states */
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.loading {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@media (max-width: 768px) {
    .modern-page-container {
        padding: 1rem 0;
    }
    
    .modern-card-header {
        padding: 1rem 1.5rem;
    }
    
    .modern-card-title {
        font-size: 1.5rem;
    }
    
    .modern-card-body {
        padding: 1.5rem;
    }
    
    .modern-form-row {
        grid-template-columns: 1fr;
    }
    
    .modern-form-actions {
        flex-direction: column;
        align-items: stretch;
    }
    
    .modern-form-actions-left,
    .modern-form-actions-right {
        justify-content: center;
    }
    
    .modern-btn {
        justify-content: center;
    }
    
    .modern-header-actions {
        flex-direction: column;
        align-items: stretch;
    }
}
</style>

<div class="main-content modern-page-container">
    <section class="section">
        <div class="section-body">
            <div class="server-error">
                @include('Elements.flash-message')
            </div>
            
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="modern-card">
                            <div class="modern-card-header">
                                <h4 class="modern-card-title">
                                    <i data-lucide="calendar-plus"></i>
                                    Create Booking Block
                                </h4>
                                <div class="modern-header-actions">
                                    <a href="{{ route('admin.feature.bookingblocks.index') }}" class="modern-btn modern-btn-back">
                                        <i data-lucide="arrow-left"></i>
                                        Back to Blocks
                                    </a>
                                </div>
                            </div>
                            
                            <div class="modern-card-body">
                                <!-- Person Information -->
                                <div class="modern-person-display">
                                    <div class="modern-person-icon">
                                        <i data-lucide="user"></i>
                                    </div>
                                    <div class="modern-person-info">
                                        <h4>Ajay</h4>
                                        <p>Creating booking blocks for this person</p>
                                    </div>
                                </div>

                                @php
                                    $serviceStart = $serviceConfig ? date('H:i', strtotime($serviceConfig->start_time ?? '09:00')) : '09:00';
                                    $serviceEnd = $serviceConfig ? date('H:i', strtotime($serviceConfig->end_time ?? '17:00')) : '17:00';
                                    $weekendLabel = $serviceConfig->weekend ?? 'Sun,Sat';
                                    $oldDates = old('date', ['']);
                                    if (! is_array($oldDates)) {
                                        $oldDates = [0 => $oldDates];
                                    }
                                    $blockIndexes = array_keys($oldDates);
                                    if ($blockIndexes === []) {
                                        $blockIndexes = [0];
                                    }
                                @endphp

                                <form method="post"
                                      action="{{ route('admin.feature.bookingblocks.store') }}"
                                      id="booking-form"
                                      data-service-start="{{ $serviceStart }}"
                                      data-service-end="{{ $serviceEnd }}"
                                      data-weekends="{{ $weekendLabel }}">
                                    @csrf
                                    <input type="hidden" name="person_id" value="1">

                                    <!-- Blocks Container -->
                                    <div class="modern-form-section">
                                        <h3 class="modern-section-title">
                                            <i data-lucide="calendar-x"></i>
                                            Booking Blocks
                                        </h3>

                                        <div class="modern-booking-hours-note">
                                            <i data-lucide="info"></i>
                                            <span>Partial blocks must use times within <strong>{{ $serviceStart }} – {{ $serviceEnd }}</strong>. Non-working days: <strong>{{ $weekendLabel }}</strong>. Dates use <strong>DD/MM/YYYY</strong>.</span>
                                        </div>

                                        <div id="ajax-feedback" hidden></div>
                                        
                                        <div class="modern-block-container" id="blocks_wrapper">
                                            @foreach ($blockIndexes as $i)
                                            @php
                                                $fullDayValue = old('full_day.'.$i, '0');
                                                $isFullDay = (string) $fullDayValue === '1';
                                            @endphp
                                            <div class="modern-block-item block_item">
                                                <div class="modern-block-header">
                                                    <div class="modern-block-title">
                                                        <span class="modern-block-number">{{ $loop->iteration }}</span>
                                                        Block Configuration
                                                    </div>
                                                    <div class="modern-time-toggle">
                                                        <span class="modern-toggle-label">Full Day:</span>
                                                        <select name="full_day[{{ $i }}]" class="modern-form-select full-day" style="width: auto; padding: 0.25rem 0.5rem; font-size: 0.75rem;">
                                                            <option value="0" @selected(! $isFullDay)>No</option>
                                                            <option value="1" @selected($isFullDay)>Yes</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="modern-form-row">
                                                    <div class="modern-form-group">
                                                        <label class="modern-form-label">
                                                            Date <span class="required">*</span>
                                                        </label>
                                                        <input type="text"
                                                               class="modern-form-input block-date @error('date.'.$i) is-invalid @enderror"
                                                               name="date[{{ $i }}]"
                                                               value="{{ old('date.'.$i) }}"
                                                               placeholder="DD/MM/YYYY"
                                                               autocomplete="off"
                                                               required>
                                                        @error('date.'.$i)
                                                            <div class="modern-field-error">{{ $message }}</div>
                                                        @else
                                                        <div class="modern-help-text">
                                                            <i data-lucide="calendar"></i>
                                                            Enter date in DD/MM/YYYY format
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="modern-form-group time-range">
                                                        <label class="modern-form-label">Start Time</label>
                                                        <input type="time"
                                                               class="modern-form-input @error('start_time.'.$i) is-invalid @enderror"
                                                               name="start_time[{{ $i }}]"
                                                               value="{{ old('start_time.'.$i) }}"
                                                               @disabled($isFullDay)>
                                                        @error('start_time.'.$i)
                                                            <div class="modern-field-error">{{ $message }}</div>
                                                        @else
                                                        <div class="modern-help-text">
                                                            <i data-lucide="clock"></i>
                                                            Block start time
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="modern-form-group time-range">
                                                        <label class="modern-form-label">End Time</label>
                                                        <input type="time"
                                                               class="modern-form-input @error('end_time.'.$i) is-invalid @enderror"
                                                               name="end_time[{{ $i }}]"
                                                               value="{{ old('end_time.'.$i) }}"
                                                               @disabled($isFullDay)>
                                                        @error('end_time.'.$i)
                                                            <div class="modern-field-error">{{ $message }}</div>
                                                        @else
                                                        <div class="modern-help-text">
                                                            <i data-lucide="clock"></i>
                                                            Block end time
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="modern-form-actions">
                                        <div class="modern-form-actions-left">
                                            <button type="button" id="add_more_create" class="modern-add-block-btn">
                                                <i data-lucide="plus"></i>
                                                Add Another Block
                                            </button>
                                        </div>
                                        <div class="modern-form-actions-right">
                                            <button class="modern-btn modern-btn-primary" type="submit" id="booking-submit-btn">
                                                <i data-lucide="save"></i>
                                                Save Booking Blocks
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script {!! \App\Services\CspService::getNonceAttribute() !!}>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('booking-form');
    const submitBtn = document.getElementById('booking-submit-btn');
    const feedbackEl = document.getElementById('ajax-feedback');
    const submitBtnDefaultHtml = submitBtn.innerHTML;
    let idx = document.querySelectorAll('.block_item').length;
    const weekendMap = { Sun: 0, Mon: 1, Tue: 2, Wed: 3, Thu: 4, Fri: 5, Sat: 6 };

    function initBlockDatePicker(input) {
        if (!input || input._flatpickr || typeof flatpickr === 'undefined') {
            return;
        }
        flatpickr(input, {
            dateFormat: 'd/m/Y',
            allowInput: true,
            clickOpens: true,
            minDate: 'today'
        });
    }

    function getWeekendDays() {
        return (form.dataset.weekends || '')
            .split(',')
            .map(function(part) { return weekendMap[part.trim()]; })
            .filter(function(day) { return day !== undefined; });
    }

    function parseDisplayDate(value) {
        const match = String(value || '').trim().match(/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/);
        if (!match) {
            return null;
        }

        const day = parseInt(match[1], 10);
        const month = parseInt(match[2], 10) - 1;
        const year = parseInt(match[3], 10);
        const date = new Date(year, month, day);

        if (date.getFullYear() !== year || date.getMonth() !== month || date.getDate() !== day) {
            return null;
        }

        date.setHours(0, 0, 0, 0);
        return date;
    }

    function timeToMinutes(value) {
        if (!value) {
            return null;
        }
        const parts = value.split(':');
        if (parts.length < 2) {
            return null;
        }
        return (parseInt(parts[0], 10) * 60) + parseInt(parts[1], 10);
    }

    function blocksOverlap(blockA, blockB) {
        if (blockA.fullDay || blockB.fullDay) {
            return true;
        }
        return blockA.startMinutes < blockB.endMinutes && blockB.startMinutes < blockA.endMinutes;
    }

    function laravelKeyToFieldName(key) {
        const match = key.match(/^(.+)\.(\d+)$/);
        if (match) {
            return match[1] + '[' + match[2] + ']';
        }
        return key;
    }

    function clearValidationErrors() {
        form.querySelectorAll('.modern-field-error').forEach(function(el) { el.remove(); });
        form.querySelectorAll('.is-invalid').forEach(function(el) { el.classList.remove('is-invalid'); });
        form.querySelectorAll('.modern-help-text').forEach(function(el) { el.style.display = ''; });
        feedbackEl.hidden = true;
        feedbackEl.innerHTML = '';
        feedbackEl.className = '';
    }

    function showFieldError(fieldName, messages) {
        const input = form.querySelector('[name="' + fieldName + '"]');
        if (!input) {
            return;
        }

        input.classList.add('is-invalid');
        const group = input.closest('.modern-form-group');
        if (!group) {
            return;
        }

        group.querySelectorAll('.modern-field-error').forEach(function(el) { el.remove(); });
        const help = group.querySelector('.modern-help-text');
        if (help) {
            help.style.display = 'none';
        }

        messages.forEach(function(message) {
            const div = document.createElement('div');
            div.className = 'modern-field-error';
            div.textContent = message;
            input.insertAdjacentElement('afterend', div);
        });
    }

    function showValidationFeedback(fieldErrors, blockErrors, isSuccess, message) {
        clearValidationErrors();

        Object.keys(fieldErrors || {}).forEach(function(key) {
            const fieldName = laravelKeyToFieldName(key);
            const messages = fieldErrors[key];
            showFieldError(fieldName, Array.isArray(messages) ? messages : [messages]);
        });

        if (blockErrors && blockErrors.length) {
            feedbackEl.hidden = false;
            feedbackEl.className = 'modern-validation-summary';
            feedbackEl.setAttribute('role', 'alert');
            feedbackEl.innerHTML = '<strong>Please fix the following:</strong><ul>' +
                blockErrors.map(function(error) { return '<li>' + error + '</li>'; }).join('') +
                '</ul>';
        } else if (isSuccess && message) {
            feedbackEl.hidden = false;
            feedbackEl.className = 'modern-success-summary';
            feedbackEl.setAttribute('role', 'status');
            feedbackEl.textContent = message;
        } else if (!Object.keys(fieldErrors || {}).length && message) {
            feedbackEl.hidden = false;
            feedbackEl.className = 'modern-validation-summary';
            feedbackEl.setAttribute('role', 'alert');
            feedbackEl.textContent = message;
        }

        if (!isSuccess) {
            const scrollTarget = feedbackEl.hidden
                ? form.querySelector('.is-invalid') || form
                : feedbackEl;
            scrollTarget.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }

    function validateBookingBlocks() {
        const fieldErrors = {};
        const blockErrors = [];
        const serviceStart = timeToMinutes(form.dataset.serviceStart || '09:00');
        const serviceEnd = timeToMinutes(form.dataset.serviceEnd || '17:00');
        const weekendDays = getWeekendDays();
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        const parsedBlocks = [];

        function addFieldError(fieldIndex, field, message) {
            const key = field + '[' + fieldIndex + ']';
            if (!fieldErrors[key]) {
                fieldErrors[key] = [];
            }
            fieldErrors[key].push(message);
        }

        document.querySelectorAll('.block_item').forEach(function(row) {
            const dateInput = row.querySelector('.block-date');
            const fullDaySelect = row.querySelector('.full-day');
            const startInput = row.querySelector('input[name^="start_time"]');
            const endInput = row.querySelector('input[name^="end_time"]');
            const indexMatch = dateInput ? dateInput.getAttribute('name').match(/\[(\d+)\]/) : null;
            const fieldIndex = indexMatch ? indexMatch[1] : '0';
            const blockNumber = row.querySelector('.modern-block-number');
            const rowLabel = 'Block ' + (blockNumber ? blockNumber.textContent.trim() : fieldIndex);
            const isFullDay = fullDaySelect && fullDaySelect.value === '1';
            const dateValue = dateInput ? dateInput.value.trim() : '';

            if (!dateValue) {
                addFieldError(fieldIndex, 'date', rowLabel + ': Date is required.');
                return;
            }

            const parsedDate = parseDisplayDate(dateValue);
            if (!parsedDate) {
                addFieldError(fieldIndex, 'date', rowLabel + ': Invalid date. Use DD/MM/YYYY format.');
                return;
            }

            if (parsedDate < today) {
                addFieldError(fieldIndex, 'date', rowLabel + ': Date cannot be in the past.');
            }

            if (weekendDays.indexOf(parsedDate.getDay()) !== -1) {
                addFieldError(fieldIndex, 'date', rowLabel + ': Selected date is a non-working day and is already unavailable for bookings.');
            }

            let startMinutes = null;
            let endMinutes = null;

            if (!isFullDay) {
                const startValue = startInput ? startInput.value.trim() : '';
                const endValue = endInput ? endInput.value.trim() : '';

                if (!startValue || !endValue) {
                    addFieldError(fieldIndex, 'start_time', rowLabel + ': Start time and end time are required when Full Day is No.');
                } else {
                    startMinutes = timeToMinutes(startValue);
                    endMinutes = timeToMinutes(endValue);

                    if (startMinutes === null) {
                        addFieldError(fieldIndex, 'start_time', rowLabel + ': Invalid start time.');
                    }
                    if (endMinutes === null) {
                        addFieldError(fieldIndex, 'end_time', rowLabel + ': Invalid end time.');
                    }
                    if (startMinutes !== null && endMinutes !== null) {
                        if (startMinutes >= endMinutes) {
                            addFieldError(fieldIndex, 'end_time', rowLabel + ': End time must be after start time.');
                        } else if ((endMinutes - startMinutes) < 30) {
                            addFieldError(fieldIndex, 'end_time', rowLabel + ': Time range must be at least 30 minutes.');
                        } else if (serviceStart !== null && serviceEnd !== null && (startMinutes < serviceStart || endMinutes > serviceEnd)) {
                            addFieldError(fieldIndex, 'start_time', rowLabel + ': Time must be within booking hours (' + form.dataset.serviceStart + ' – ' + form.dataset.serviceEnd + ').');
                        }
                    }
                }
            }

            parsedBlocks.push({
                rowLabel: rowLabel,
                dateKey: parsedDate.toISOString().slice(0, 10),
                dateDisplay: dateValue,
                fullDay: isFullDay,
                startMinutes: startMinutes,
                endMinutes: endMinutes
            });
        });

        for (let i = 0; i < parsedBlocks.length; i++) {
            for (let j = i + 1; j < parsedBlocks.length; j++) {
                if (parsedBlocks[i].dateKey !== parsedBlocks[j].dateKey) {
                    continue;
                }
                if (blocksOverlap(parsedBlocks[i], parsedBlocks[j])) {
                    blockErrors.push(parsedBlocks[i].rowLabel + ' and ' + parsedBlocks[j].rowLabel + ' overlap on ' + parsedBlocks[i].dateDisplay + '.');
                }
            }
        }

        return { fieldErrors: fieldErrors, blockErrors: blockErrors };
    }

    function setSubmitLoading(isLoading) {
        submitBtn.disabled = isLoading;
        submitBtn.classList.toggle('loading', isLoading);
        submitBtn.innerHTML = isLoading
            ? '<i data-lucide="loader-2" class="lucide-spin"></i> Saving...'
            : submitBtnDefaultHtml;
        if (!isLoading && window.lucide && typeof window.lucide.createIcons === 'function') {
            window.lucide.createIcons();
        }
    }

    function submitBookingForm() {
        setSubmitLoading(true);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: new FormData(form)
        })
        .then(function(response) {
            return response.json()
                .catch(function() {
                    return {
                        success: false,
                        message: 'Unexpected server response. Please try again.',
                        errors: {}
                    };
                })
                .then(function(data) {
                    return { ok: response.ok, data: data };
                });
        })
        .then(function(result) {
            if (result.ok && result.data.success) {
                showValidationFeedback({}, [], true, result.data.message);
                window.setTimeout(function() {
                    window.location.href = result.data.redirect;
                }, 800);
                return;
            }

            const errors = result.data.errors || {};
            const blockErrors = errors.blocks || [];
            const fieldErrors = Object.assign({}, errors);
            delete fieldErrors.blocks;

            showValidationFeedback(fieldErrors, blockErrors, false, result.data.message);
            setSubmitLoading(false);
        })
        .catch(function() {
            showValidationFeedback({}, ['Something went wrong. Please try again.'], false);
            setSubmitLoading(false);
        });
    }

    document.querySelectorAll('.block-date').forEach(initBlockDatePicker);
    
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('full-day')) {
            const isFull = e.target.value === '1';
            const row = e.target.closest('.block_item');
            const timeInputs = row.querySelectorAll('.time-range input');
            
            timeInputs.forEach(function(input) {
                input.disabled = isFull;
                if (isFull) {
                    input.value = '';
                }
            });
        }
    });
    
    document.getElementById('add_more_create').addEventListener('click', function() {
        clearValidationErrors();

        const firstBlock = document.querySelector('.block_item');
        const newBlock = firstBlock.cloneNode(true);
        
        const blockNumber = newBlock.querySelector('.modern-block-number');
        blockNumber.textContent = idx + 1;
        
        const inputs = newBlock.querySelectorAll('input, select');
        inputs.forEach(function(input) {
            const name = input.getAttribute('name');
            if (name) {
                input.setAttribute('name', name.replace(/\[\d+\]/, '[' + idx + ']'));
                if (input.type !== 'hidden') {
                    input.value = '';
                    input.classList.remove('is-invalid');
                }
            }
        });

        newBlock.querySelectorAll('.modern-field-error').forEach(function(el) { el.remove(); });
        newBlock.querySelectorAll('.modern-help-text').forEach(function(el) { el.style.display = ''; });
        
        const fullDaySelect = newBlock.querySelector('.full-day');
        fullDaySelect.value = '0';
        
        const timeInputs = newBlock.querySelectorAll('.time-range input');
        timeInputs.forEach(function(input) {
            input.disabled = false;
        });
        
        document.getElementById('blocks_wrapper').appendChild(newBlock);

        const dateInput = newBlock.querySelector('.block-date');
        if (dateInput) {
            if (dateInput._flatpickr) {
                dateInput._flatpickr.destroy();
            }
            initBlockDatePicker(dateInput);
        }

        idx++;
    });
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        clearValidationErrors();

        const validation = validateBookingBlocks();
        const hasFieldErrors = Object.keys(validation.fieldErrors).length > 0;
        const hasBlockErrors = validation.blockErrors.length > 0;

        if (hasFieldErrors || hasBlockErrors) {
            showValidationFeedback(validation.fieldErrors, validation.blockErrors, false);
            return;
        }

        submitBookingForm();
    });
    
    document.querySelectorAll('.modern-btn[href]').forEach(function(button) {
        button.addEventListener('click', function() {
            this.classList.add('loading');
            const icon = this.querySelector('i');
            if (icon && window.setLucideIcon) {
                window.setLucideIcon(icon, 'loader-2', { spin: true });
            }
        });
    });
});
</script>
@endsection