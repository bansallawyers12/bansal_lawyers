@extends('layouts.admin')
@section('title', 'Booking Blocks')

@section('content')
@php
    $activeBlocks = $lists->sum(fn($item) => count($item->disabledSlots));
    $blockedDates = $lists->sum(fn($item) => count($item->groupedBlocks ?? []));
    $fullDayBlocks = $lists->sum(fn($item) => $item->disabledSlots->where('block_all', 1)->count());
@endphp

<style {!! \App\Services\CspService::getNonceAttribute() !!}>
:root {
    --primary-color: #1B4D89;
    --secondary-color: #2c5aa0;
    --accent-color: #FF6B35;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
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
}

.modern-card-header {
    background: linear-gradient(135deg, var(--booking-color) 0%, var(--booking-secondary) 100%);
    padding: 1.75rem 2rem;
    position: relative;
    overflow: hidden;
}

.modern-card-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.modern-header-inner {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.modern-card-title {
    color: var(--white);
    font-size: 1.75rem;
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.modern-card-subtitle {
    color: rgba(255, 255, 255, 0.85);
    font-size: 0.9rem;
    margin: 0.35rem 0 0;
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
    white-space: nowrap;
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

.modern-btn-success {
    background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
    color: var(--white);
}

.modern-btn-success:hover {
    color: var(--white);
    text-decoration: none;
    transform: translateY(-1px);
}

.modern-btn-ghost {
    background: var(--white);
    color: var(--text-dark);
    border: 1px solid var(--border-color);
}

.modern-btn-ghost:hover {
    border-color: var(--booking-color);
    color: var(--booking-secondary);
}

.modern-btn-sm {
    padding: 0.5rem 0.875rem;
    font-size: 0.8125rem;
}

.modern-card-body {
    padding: 2rem;
}

.modern-stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    margin-bottom: 1.75rem;
}

.modern-stat-card {
    background: linear-gradient(135deg, var(--white) 0%, #fafafa 100%);
    border-radius: var(--border-radius);
    padding: 1.35rem 1.5rem;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-color);
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.modern-stat-card::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 3px;
    opacity: 0.85;
}

.modern-stat-card:nth-child(1)::after { background: linear-gradient(90deg, var(--primary-color), var(--secondary-color)); }
.modern-stat-card:nth-child(2)::after { background: linear-gradient(90deg, var(--booking-color), var(--booking-secondary)); }
.modern-stat-card:nth-child(3)::after { background: linear-gradient(90deg, var(--danger-color), #dc2626); }

.modern-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow);
}

.modern-stat-icon {
    width: 2.75rem;
    height: 2.75rem;
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    flex-shrink: 0;
}

.modern-stat-icon.dates { background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); }
.modern-stat-icon.slots { background: linear-gradient(135deg, var(--booking-color), var(--booking-secondary)); }
.modern-stat-icon.fullday { background: linear-gradient(135deg, var(--danger-color), #dc2626); }

.modern-stat-label {
    color: var(--text-light);
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin: 0 0 0.25rem;
}

.modern-stat-value {
    color: var(--text-dark);
    font-size: 1.75rem;
    font-weight: 700;
    margin: 0;
    line-height: 1;
}

.modern-list-section {
    background: var(--white);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    margin-bottom: 1.5rem;
}

.modern-list-layout {
    display: grid;
    grid-template-columns: 280px 1fr;
    min-height: 320px;
}

.modern-list-sidebar {
    padding: 1.5rem;
    background: linear-gradient(180deg, #fffbeb 0%, #fff 100%);
    border-right: 1px solid var(--border-color);
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}

.modern-sidebar-profile {
    text-align: center;
    padding-bottom: 1.25rem;
    border-bottom: 1px dashed var(--border-color);
}

.modern-person-avatar {
    width: 4rem;
    height: 4rem;
    border-radius: 50%;
    margin: 0 auto 0.875rem;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: var(--white);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 20px rgba(27, 77, 137, 0.25);
}

.modern-sidebar-stats {
    display: grid;
    gap: 0.625rem;
}

.modern-sidebar-stat {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.625rem 0.875rem;
    background: var(--white);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    font-size: 0.8125rem;
}

.modern-sidebar-stat strong {
    color: var(--text-dark);
    font-size: 1rem;
}

.modern-sidebar-stat span {
    color: var(--text-light);
}

.modern-list-main {
    display: flex;
    flex-direction: column;
    min-width: 0;
}

.modern-legend {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    padding: 0 1.25rem 0.75rem;
    font-size: 0.75rem;
    color: var(--text-light);
}

.modern-legend-item {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
}

.modern-legend-dot {
    width: 0.625rem;
    height: 0.625rem;
    border-radius: 999px;
}

.modern-legend-dot.partial { background: var(--booking-color); }
.modern-legend-dot.full-day { background: var(--danger-color); }

.modern-filter-tabs {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.modern-filter-tab {
    appearance: none;
    border: 1px solid var(--border-color);
    background: var(--white);
    color: var(--text-light);
    padding: 0.45rem 0.875rem;
    border-radius: 999px;
    font-size: 0.8125rem;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
}

.modern-filter-tab:hover {
    border-color: var(--booking-color);
    color: var(--booking-secondary);
}

.modern-filter-tab.is-active {
    background: linear-gradient(135deg, var(--booking-color), var(--booking-secondary));
    border-color: transparent;
    color: var(--white);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.25);
}

.modern-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    padding: 1rem 1.25rem;
    border-bottom: 1px solid var(--border-color);
    background: var(--bg-light);
    flex-wrap: wrap;
}

.modern-toolbar-left {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.modern-month-section {
    padding: 0 1.25rem 1.25rem;
}

.modern-month-section + .modern-month-section {
    padding-top: 0.25rem;
}

.modern-month-heading {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin: 0 0 1rem;
    font-size: 0.9375rem;
    font-weight: 700;
    color: var(--text-dark);
}

.modern-month-heading::after {
    content: '';
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, var(--border-color), transparent);
}

.modern-month-count {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--text-light);
    background: var(--bg-light);
    padding: 0.2rem 0.5rem;
    border-radius: 999px;
}

.modern-search-no-results {
    display: none;
    text-align: center;
    padding: 3rem 1.5rem;
    color: var(--text-light);
}

.modern-search-no-results.is-visible {
    display: block;
}

.modern-search-no-results i {
    display: block;
    margin: 0 auto 0.75rem;
    color: var(--booking-color);
}

.modern-list-section.is-hidden {
    display: none;
}

.modern-list-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    padding: 1rem 1.25rem;
    background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
    border-bottom: 1px solid #fde68a;
    flex-wrap: wrap;
}

.modern-list-person {
    display: flex;
    align-items: center;
    gap: 0.875rem;
}

.modern-person-avatar {
    width: 2.75rem;
    height: 2.75rem;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: var(--white);
    display: flex;
    align-items: center;
    justify-content: center;
}

.modern-list-header .modern-person-avatar {
    width: 2.75rem;
    height: 2.75rem;
    margin: 0;
    box-shadow: none;
}

.modern-person-name {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text-dark);
    margin: 0;
}

.modern-person-meta {
    font-size: 0.8125rem;
    color: var(--text-light);
    margin: 0.15rem 0 0;
}

.modern-list-actions {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.modern-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    padding: 1rem 1.25rem;
    border-bottom: 1px solid var(--border-color);
    background: var(--bg-light);
    flex-wrap: wrap;
}

.modern-toolbar-title {
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--text-dark);
    margin: 0;
}

.modern-search-wrap {
    position: relative;
    min-width: 260px;
    flex: 1;
    max-width: 360px;
}

.modern-search-wrap i {
    position: absolute;
    left: 0.875rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-light);
    width: 1rem;
    height: 1rem;
    pointer-events: none;
}

.modern-search-input {
    width: 100%;
    padding: 0.65rem 0.875rem 0.65rem 2.5rem;
    border: 2px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    color: var(--text-dark);
    background: var(--white);
}

.modern-search-input:focus {
    outline: none;
    border-color: var(--booking-color);
    box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.12);
}

.modern-date-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(168px, 1fr));
    gap: 0.875rem;
}

.modern-date-card {
    appearance: none;
    width: 100%;
    text-align: left;
    background: var(--white);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    padding: 0;
    cursor: pointer;
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
    position: relative;
    overflow: hidden;
}

.modern-date-card-header {
    padding: 0.5rem 0.75rem;
    background: linear-gradient(135deg, var(--booking-color), var(--booking-secondary));
    color: var(--white);
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 0.6875rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.06em;
}

.modern-date-card.full-day .modern-date-card-header {
    background: linear-gradient(135deg, var(--danger-color), #dc2626);
}

.modern-date-card-body {
    padding: 0.875rem 0.875rem 0.75rem;
}

.modern-date-card.is-filter-hidden,
.modern-date-card.is-hidden {
    display: none;
}

.modern-month-section.is-filter-empty {
    display: none;
}

.modern-date-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 24px rgba(15, 23, 42, 0.12);
    border-color: #cbd5e1;
}

.modern-date-card:focus-visible {
    outline: 3px solid rgba(245, 158, 11, 0.35);
    outline-offset: 2px;
}

.modern-date-card-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 0.5rem;
    margin-bottom: 0.35rem;
}

.modern-date-day {
    font-size: 0.6875rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--text-light);
}

.modern-date-badge {
    font-size: 0.625rem;
    font-weight: 700;
    padding: 0.15rem 0.45rem;
    border-radius: 999px;
    background: #fffbeb;
    color: #92400e;
    border: 1px solid #fde68a;
    white-space: nowrap;
}

.modern-date-badge.full-day {
    background: #fef2f2;
    color: #991b1b;
    border-color: #fecaca;
}

.modern-date-number {
    font-size: 2rem;
    font-weight: 800;
    color: var(--text-dark);
    line-height: 1;
    margin: 0;
}

.modern-date-month {
    font-size: 0.8125rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-top: 0.15rem;
}

.modern-date-preview {
    margin-top: 0.625rem;
    font-size: 0.6875rem;
    color: var(--text-light);
    line-height: 1.4;
    min-height: 2.5em;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.modern-date-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.5rem;
    margin-top: 0.75rem;
    padding-top: 0.625rem;
    border-top: 1px solid var(--border-color);
    font-size: 0.6875rem;
    color: var(--booking-secondary);
    font-weight: 700;
}

.modern-date-footer i {
    width: 0.875rem;
    height: 0.875rem;
}

.modern-no-blocks {
    padding: 2.5rem 1.25rem;
    text-align: center;
    color: var(--text-light);
}

.modern-empty-state {
    text-align: center;
    padding: 4rem 2rem;
}

.modern-empty-icon {
    width: 5rem;
    height: 5rem;
    margin: 0 auto 1.25rem;
    border-radius: 50%;
    background: linear-gradient(135deg, #fffbeb, #fef3c7);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--booking-color);
}

.modern-empty-title {
    font-size: 1.375rem;
    font-weight: 700;
    margin: 0 0 0.5rem;
    color: var(--text-dark);
}

.modern-empty-description {
    font-size: 0.9375rem;
    margin: 0 0 1.5rem;
    color: var(--text-light);
}

.modern-pagination {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

.bb-modal {
    position: fixed;
    inset: 0;
    z-index: 10050;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}

.bb-modal[hidden] {
    display: none;
}

.bb-modal-backdrop {
    position: absolute;
    inset: 0;
    background: rgba(15, 23, 42, 0.55);
    backdrop-filter: blur(2px);
}

.bb-modal-panel {
    position: relative;
    z-index: 1;
    width: min(100%, 520px);
    background: var(--white);
    border-radius: var(--border-radius);
    box-shadow: 0 25px 50px rgba(15, 23, 42, 0.25);
    overflow: hidden;
    animation: bbModalIn 0.25s ease-out;
}

.bb-modal-hero {
    padding: 1.5rem;
    background: linear-gradient(135deg, var(--booking-color) 0%, var(--booking-secondary) 100%);
    color: var(--white);
    position: relative;
}

.bb-modal-hero.full-day {
    background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
}

.bb-modal-hero-day {
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    opacity: 0.9;
}

.bb-modal-hero-date {
    font-size: 2rem;
    font-weight: 800;
    margin: 0.25rem 0 0;
    line-height: 1.1;
}

.bb-modal-hero-meta {
    margin: 0.5rem 0 0;
    font-size: 0.8125rem;
    opacity: 0.92;
}

.bb-modal-close {
    appearance: none;
    border: none;
    background: rgba(255, 255, 255, 0.2);
    width: 2.25rem;
    height: 2.25rem;
    border-radius: 999px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: var(--white);
    flex-shrink: 0;
    position: absolute;
    top: 1rem;
    right: 1rem;
    transition: var(--transition);
}

.bb-modal-close:hover {
    background: rgba(255, 255, 255, 0.3);
}

.bb-modal-header {
    display: none;
}

.bb-slot-item {
    display: flex;
    align-items: center;
    gap: 0.875rem;
    padding: 1rem 1.125rem;
    border-radius: var(--border-radius-sm);
    border: 1px solid var(--border-color);
    background: var(--white);
    box-shadow: var(--shadow-sm);
}

.bb-slot-number {
    width: 1.75rem;
    height: 1.75rem;
    border-radius: 50%;
    background: var(--bg-light);
    color: var(--text-light);
    font-size: 0.75rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.bb-slot-item.full-day {
    background: #fef2f2;
    border-color: #fecaca;
}

.bb-slot-item.partial {
    background: #fffbeb;
    border-color: #fde68a;
}

.bb-slot-icon {
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--white);
    flex-shrink: 0;
}

.bb-slot-label {
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--text-dark);
}

.bb-slot-meta {
    font-size: 0.75rem;
    color: var(--text-light);
    margin-top: 0.15rem;
}

@keyframes bbModalIn {
    from { opacity: 0; transform: translateY(16px) scale(0.96); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

.bb-modal-body {
    padding: 1.25rem 1.5rem 1.5rem;
    max-height: 50vh;
    overflow-y: auto;
    background: var(--bg-light);
}

.bb-modal-body-title {
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: var(--text-light);
    margin: 0 0 0.875rem;
}

.bb-slot-list {
    list-style: none;
    margin: 0;
    padding: 0;
    display: grid;
    gap: 0.625rem;
}

.modern-list-actions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.modern-list-actions .modern-btn {
    justify-content: center;
    width: 100%;
}

@media (max-width: 992px) {
    .modern-stats-grid { grid-template-columns: 1fr; }
    .modern-list-layout { grid-template-columns: 1fr; }
    .modern-list-sidebar {
        border-right: none;
        border-bottom: 1px solid var(--border-color);
    }
    .modern-sidebar-profile { text-align: left; display: flex; align-items: center; gap: 1rem; padding-bottom: 0; border-bottom: none; }
    .modern-sidebar-profile .modern-person-avatar { margin: 0; width: 3rem; height: 3rem; }
    .modern-list-actions { flex-direction: row; }
    .modern-list-actions .modern-btn { width: auto; flex: 1; }
}

@media (max-width: 768px) {
    .modern-page-container { padding: 1rem 0; }
    .modern-card-body { padding: 1.5rem; }
    .modern-header-inner { flex-direction: column; align-items: stretch; }
    .modern-list-header { flex-direction: column; align-items: flex-start; }
    .modern-list-actions { width: 100%; }
    .modern-list-actions .modern-btn { flex: 1; justify-content: center; }
    .modern-toolbar { flex-direction: column; align-items: stretch; }
    .modern-search-wrap { max-width: none; }
    .modern-date-grid { grid-template-columns: repeat(2, 1fr); gap: 0.75rem; }
}
</style>

<div class="main-content modern-page-container">
    <section class="section">
        <div class="section-body">
            <div class="server-error">
                @include('Elements.flash-message')
            </div>
            <div class="custom-error-msg"></div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="modern-card">
                            <div class="modern-card-header">
                                <div class="modern-header-inner">
                                    <div>
                                        <h4 class="modern-card-title">
                                            <i data-lucide="calendar-x"></i>
                                            Booking Blocks
                                        </h4>
                                        <p class="modern-card-subtitle">Blocked dates grouped by day — click a date to view time slots</p>
                                    </div>
                                    <a href="{{ route('admin.feature.bookingblocks.create') }}" class="modern-btn modern-btn-primary">
                                        <i data-lucide="plus"></i>
                                        Create Block
                                    </a>
                                </div>
                            </div>

                            <div class="modern-card-body">
                                <div class="modern-stats-grid">
                                    <div class="modern-stat-card">
                                        <div class="modern-stat-icon dates">
                                            <i data-lucide="calendar-days"></i>
                                        </div>
                                        <div>
                                            <p class="modern-stat-label">Blocked Dates</p>
                                            <p class="modern-stat-value">{{ $blockedDates }}</p>
                                        </div>
                                    </div>
                                    <div class="modern-stat-card">
                                        <div class="modern-stat-icon slots">
                                            <i data-lucide="clock"></i>
                                        </div>
                                        <div>
                                            <p class="modern-stat-label">Time Slots</p>
                                            <p class="modern-stat-value">{{ $activeBlocks }}</p>
                                        </div>
                                    </div>
                                    <div class="modern-stat-card">
                                        <div class="modern-stat-icon fullday">
                                            <i data-lucide="ban"></i>
                                        </div>
                                        <div>
                                            <p class="modern-stat-label">Full Day</p>
                                            <p class="modern-stat-value">{{ $fullDayBlocks }}</p>
                                        </div>
                                    </div>
                                </div>

                                @if($totalData !== 0)
                                <div class="modern-toolbar" style="margin-bottom: 1.25rem; padding: 1rem 1.25rem; border: 1px solid var(--border-color); border-radius: var(--border-radius); background: var(--white);">
                                    <div class="modern-toolbar-left">
                                        <h5 class="modern-toolbar-title">{{ $blockedDates }} blocked date{{ $blockedDates !== 1 ? 's' : '' }}</h5>
                                        <div class="modern-filter-tabs" id="block-filter-tabs">
                                            <button type="button" class="modern-filter-tab is-active" data-filter="all">All</button>
                                            <button type="button" class="modern-filter-tab" data-filter="partial">Time slots</button>
                                            <button type="button" class="modern-filter-tab" data-filter="full-day">Full day</button>
                                        </div>
                                    </div>
                                    <div class="modern-search-wrap">
                                        <i data-lucide="search"></i>
                                        <input type="search" id="block-search" class="modern-search-input" placeholder="Search dates or times..." autocomplete="off">
                                    </div>
                                </div>

                                @foreach ($lists as $list)
                                @php
                                    $groupedBlocks = $list->groupedBlocks ?? [];
                                    $groupedCount = count($groupedBlocks);
                                    $blocksByMonth = collect($groupedBlocks)->groupBy(function ($block) {
                                        return \Carbon\Carbon::parse($block['date_iso'])->format('F Y');
                                    });
                                @endphp
                                <section class="modern-list-section" id="id_{{ $list->id }}" data-config-id="{{ $list->id }}">
                                    <div class="modern-list-layout">
                                        <aside class="modern-list-sidebar">
                                            <div class="modern-sidebar-profile">
                                                <div class="modern-person-avatar">
                                                    <i data-lucide="user"></i>
                                                </div>
                                                <div>
                                                    <h3 class="modern-person-name">Ajay</h3>
                                                    <p class="modern-person-meta">Consultation blocks</p>
                                                </div>
                                            </div>
                                            <div class="modern-sidebar-stats">
                                                <div class="modern-sidebar-stat">
                                                    <span>Dates</span>
                                                    <strong>{{ $groupedCount }}</strong>
                                                </div>
                                                <div class="modern-sidebar-stat">
                                                    <span>Slots</span>
                                                    <strong>{{ count($list->disabledSlots) }}</strong>
                                                </div>
                                                <div class="modern-sidebar-stat">
                                                    <span>Config</span>
                                                    <strong>#{{ $list->id }}</strong>
                                                </div>
                                            </div>
                                            <div class="modern-list-actions">
                                                <a class="modern-btn modern-btn-success modern-btn-sm" href="{{ route('admin.feature.bookingblocks.edit', $list->id) }}">
                                                    <i data-lucide="pencil"></i>
                                                    Edit Blocks
                                                </a>
                                                <button type="button" class="modern-btn modern-btn-ghost modern-btn-sm" data-delete-slot-action data-id="{{ $list->id }}" data-table="book_service_disable_slots">
                                                    <i data-lucide="trash-2"></i>
                                                    Delete All
                                                </button>
                                            </div>
                                        </aside>

                                        <div class="modern-list-main">
                                            @if($groupedCount > 0)
                                            <div class="modern-legend">
                                                <span class="modern-legend-item"><span class="modern-legend-dot partial"></span> Time slot blocks</span>
                                                <span class="modern-legend-item"><span class="modern-legend-dot full-day"></span> Full day blocks</span>
                                                <span class="modern-legend-item"><i data-lucide="mouse-pointer-click"></i> Click a date for details</span>
                                            </div>

                                            <div id="block-dates-container">
                                                @foreach($blocksByMonth as $monthLabel => $monthBlocks)
                                                <div class="modern-month-section" data-month-section>
                                                    <h4 class="modern-month-heading">
                                                        {{ $monthLabel }}
                                                        <span class="modern-month-count">{{ count($monthBlocks) }}</span>
                                                    </h4>
                                                    <div class="modern-date-grid">
                                                        @foreach($monthBlocks as $dateGroup)
                                                        @php
                                                            $isFullDayOnly = $dateGroup['has_full_day'] && $dateGroup['slot_count'] === 1;
                                                            $badgeLabel = $isFullDayOnly
                                                                ? 'Full day'
                                                                : ($dateGroup['slot_count'] . ' slot' . ($dateGroup['slot_count'] !== 1 ? 's' : ''));
                                                            $previewSlots = collect($dateGroup['slots'])->take(2)->pluck('label')->implode(', ');
                                                            if ($dateGroup['slot_count'] > 2) {
                                                                $previewSlots .= ' +' . ($dateGroup['slot_count'] - 2) . ' more';
                                                            }
                                                            $filterType = $isFullDayOnly ? 'full-day' : ($dateGroup['has_full_day'] ? 'mixed' : 'partial');
                                                        @endphp
                                                        <button type="button"
                                                                class="modern-date-card {{ $dateGroup['has_full_day'] ? 'full-day' : '' }}"
                                                                data-filter-type="{{ $filterType }}"
                                                                data-date-label="{{ $dateGroup['date_friendly'] }}"
                                                                data-date-display="{{ $dateGroup['date_display'] }}"
                                                                data-day-name="{{ $dateGroup['day_name'] }}"
                                                                data-slots='@json($dateGroup['slots'])'
                                                                data-search="{{ $dateGroup['search_terms'] }}">
                                                            <div class="modern-date-card-header">
                                                                <span>{{ $dateGroup['day_name'] }}</span>
                                                                <span>{{ $badgeLabel }}</span>
                                                            </div>
                                                            <div class="modern-date-card-body">
                                                                <div class="modern-date-number">{{ $dateGroup['day_number'] }}</div>
                                                                <div class="modern-date-month">{{ $dateGroup['month_short'] }} {{ $dateGroup['year'] }}</div>
                                                                <div class="modern-date-preview">{{ $previewSlots ?: 'Blocked' }}</div>
                                                                <div class="modern-date-footer">
                                                                    <span>{{ $dateGroup['date_display'] }}</span>
                                                                    <span><i data-lucide="chevron-right"></i></span>
                                                                </div>
                                                            </div>
                                                        </button>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>

                                            <div class="modern-search-no-results" id="search-no-results">
                                                <i data-lucide="search-x"></i>
                                                <p>No dates match your search or filter.</p>
                                            </div>
                                            @else
                                            <div class="modern-no-blocks">
                                                <i data-lucide="calendar-off"></i>
                                                <p>No blocked dates configured yet</p>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </section>
                                @endforeach

                                @if($lists->hasPages())
                                <div class="modern-pagination">
                                    {{ $lists->links() }}
                                </div>
                                @endif
                                @else
                                <div class="modern-empty-state">
                                    <div class="modern-empty-icon">
                                        <i data-lucide="calendar-x"></i>
                                    </div>
                                    <h3 class="modern-empty-title">No booking blocks yet</h3>
                                    <p class="modern-empty-description">Block specific dates or time ranges when appointments should not be available.</p>
                                    <a href="{{ route('admin.feature.bookingblocks.create') }}" class="modern-btn modern-btn-primary">
                                        <i data-lucide="plus"></i>
                                        Create First Block
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div id="block-date-modal" class="bb-modal" hidden aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="block-date-modal-title">
    <div class="bb-modal-backdrop" data-modal-close></div>
    <div class="bb-modal-panel">
        <div class="bb-modal-hero" id="block-date-modal-hero">
            <button type="button" class="bb-modal-close" data-modal-close aria-label="Close">
                <i data-lucide="x"></i>
            </button>
            <div class="bb-modal-hero-day" id="block-date-modal-day"></div>
            <h3 class="bb-modal-hero-date" id="block-date-modal-title"></h3>
            <p class="bb-modal-hero-meta" id="block-date-modal-subtitle"></p>
        </div>
        <div class="bb-modal-body">
            <p class="bb-modal-body-title">Blocked time slots</p>
            <ul class="bb-slot-list" id="block-date-modal-slots"></ul>
        </div>
    </div>
</div>

<script {!! \App\Services\CspService::getNonceAttribute() !!}>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('block-search');
    const filterTabs = document.querySelectorAll('.modern-filter-tab');
    const noResultsEl = document.getElementById('search-no-results');
    const modal = document.getElementById('block-date-modal');
    const modalHero = document.getElementById('block-date-modal-hero');
    const modalTitle = document.getElementById('block-date-modal-title');
    const modalDay = document.getElementById('block-date-modal-day');
    const modalSubtitle = document.getElementById('block-date-modal-subtitle');
    const modalSlots = document.getElementById('block-date-modal-slots');
    let activeFilter = 'all';

    function getDateCards() {
        return document.querySelectorAll('.modern-date-card');
    }

    function applyFilters() {
        const query = searchInput ? searchInput.value.trim().toLowerCase() : '';
        let visibleCount = 0;

        getDateCards().forEach(function(card) {
            const filterType = card.getAttribute('data-filter-type') || 'partial';
            const haystack = card.getAttribute('data-search') || '';
            const matchesSearch = !query || haystack.includes(query);
            const matchesFilter = activeFilter === 'all'
                || (activeFilter === 'full-day' && (filterType === 'full-day' || filterType === 'mixed'))
                || (activeFilter === 'partial' && (filterType === 'partial' || filterType === 'mixed'));

            const visible = matchesSearch && matchesFilter;
            card.classList.toggle('is-hidden', !visible);
            card.classList.toggle('is-filter-hidden', !visible);
            if (visible) {
                visibleCount++;
            }
        });

        document.querySelectorAll('[data-month-section]').forEach(function(section) {
            const visibleInMonth = section.querySelectorAll('.modern-date-card:not(.is-hidden)').length;
            section.classList.toggle('is-filter-empty', visibleInMonth === 0);
        });

        if (noResultsEl) {
            noResultsEl.classList.toggle('is-visible', visibleCount === 0 && getDateCards().length > 0);
        }
    }

    function openDateModal(card) {
        const dateLabel = card.getAttribute('data-date-label') || '';
        const dayName = card.getAttribute('data-day-name') || '';
        const dateDisplay = card.getAttribute('data-date-display') || '';
        const isFullDayCard = card.classList.contains('full-day');
        let slots = [];

        try {
            slots = JSON.parse(card.getAttribute('data-slots') || '[]');
        } catch (e) {
            slots = [];
        }

        modalDay.textContent = dayName;
        modalTitle.textContent = dateLabel;
        modalSubtitle.textContent = dateDisplay + ' · ' + slots.length + ' blocked slot' + (slots.length !== 1 ? 's' : '');
        modalHero.classList.toggle('full-day', isFullDayCard);

        modalSlots.innerHTML = slots.map(function(slot, index) {
            const isFullDay = slot.type === 'full-day';
            const icon = isFullDay ? 'ban' : 'clock';
            const meta = isFullDay ? 'Entire day unavailable for bookings' : 'Partial availability block';

            return '<li class="bb-slot-item ' + (isFullDay ? 'full-day' : 'partial') + '">' +
                '<span class="bb-slot-number">' + (index + 1) + '</span>' +
                '<div class="bb-slot-icon"><i data-lucide="' + icon + '"></i></div>' +
                '<div><div class="bb-slot-label">' + slot.label + '</div><div class="bb-slot-meta">' + meta + '</div></div>' +
                '</li>';
        }).join('');

        modal.hidden = false;
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';

        if (window.lucide && typeof window.lucide.createIcons === 'function') {
            window.lucide.createIcons();
        }
    }

    function closeDateModal() {
        modal.hidden = true;
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    document.addEventListener('click', function(e) {
        const card = e.target.closest('.modern-date-card');
        if (card && !card.classList.contains('is-hidden')) {
            openDateModal(card);
        }
    });

    modal.querySelectorAll('[data-modal-close]').forEach(function(el) {
        el.addEventListener('click', closeDateModal);
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.hidden) {
            closeDateModal();
        }
    });

    filterTabs.forEach(function(tab) {
        tab.addEventListener('click', function() {
            filterTabs.forEach(function(t) { t.classList.remove('is-active'); });
            tab.classList.add('is-active');
            activeFilter = tab.getAttribute('data-filter') || 'all';
            applyFilters();
        });
    });

    if (searchInput) {
        searchInput.addEventListener('input', applyFilters);
    }

    applyFilters();

    document.querySelectorAll('.modern-btn[href]').forEach(function(button) {
        button.addEventListener('click', function() {
            if (this.href && !this.href.includes('javascript:')) {
                this.classList.add('loading');
                const icon = this.querySelector('i');
                if (icon && window.setLucideIcon) {
                    window.setLucideIcon(icon, 'loader-2', { spin: true });
                }
            }
        });
    });
});

function deleteSlotAction(id, table) {
    window.adminConfirmForDelete(table).then(async function(confirmed) {
        if (!confirmed) {
            return;
        }
        if (id == '') {
            alert('Please select ID to delete the record.');
            return false;
        }
        if (window.adminHttp) {
            window.adminHttp.showLoader();
            window.adminHttp.setHtml('.server-error', '');
            window.adminHttp.setHtml('.custom-error-msg', '');
        }
        try {
            const obj = await window.adminHttp.post(site_url + '/admin/delete_slot_action', {
                id: id,
                table: table,
            });
            if (obj.status == 1) {
                document.getElementById('id_' + id)?.remove();
                window.adminHttp.setHtml('.custom-error-msg', successMessage(obj.message));
            } else {
                window.adminHttp.setHtml('.custom-error-msg', errorMessage(obj.message));
            }
        } catch (e) {
            console.error(e);
            window.adminHttp.setHtml('.custom-error-msg', errorMessage('Something went wrong. Please try again.'));
        } finally {
            window.adminHttp.hideLoader();
        }
    });
}
window.deleteSlotAction = deleteSlotAction;
</script>
@endsection
