@if ($paginator->hasPages())
    <nav aria-label="Blog pagination" class="experimental-pagination">
        <div class="pagination-wrapper">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="pagination-btn pagination-btn-disabled" aria-disabled="true" aria-label="Previous page">
                    <i class="ion-ios-arrow-back"></i>
                    <span class="btn-text">Previous</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" 
                   class="pagination-btn pagination-btn-prev" 
                   rel="prev" 
                   aria-label="Previous page">
                    <i class="ion-ios-arrow-back"></i>
                    <span class="btn-text">Previous</span>
                </a>
            @endif

            {{-- Pagination Elements --}}
            <div class="pagination-numbers">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="pagination-dots">{{ $element }}</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="pagination-number pagination-number-active" 
                                      aria-current="page" 
                                      aria-label="Page {{ $page }}">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" 
                                   class="pagination-number" 
                                   aria-label="Go to page {{ $page }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" 
                   class="pagination-btn pagination-btn-next" 
                   rel="next" 
                   aria-label="Next page">
                    <span class="btn-text">Next</span>
                    <i class="ion-ios-arrow-forward"></i>
                </a>
            @else
                <span class="pagination-btn pagination-btn-disabled" aria-disabled="true" aria-label="Next page">
                    <span class="btn-text">Next</span>
                    <i class="ion-ios-arrow-forward"></i>
                </span>
            @endif
        </div>
        
        {{-- Page Info --}}
        <div class="pagination-info">
            <span class="pagination-text">
                Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} 
                of {{ $paginator->total() }} results
            </span>
        </div>
    </nav>
@endif

<style>
.experimental-pagination {
    margin: 40px 0;
    text-align: center;
}

.pagination-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.pagination-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    background: #1B4D89;
    color: white;
    text-decoration: none;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    border: 2px solid #1B4D89;
}

.pagination-btn:hover {
    background: #0d3a6b;
    border-color: #0d3a6b;
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(27, 77, 137, 0.3);
}

.pagination-btn-disabled {
    background: #f8f9fa;
    color: #6c757d;
    border-color: #dee2e6;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.pagination-btn-disabled:hover {
    background: #f8f9fa;
    color: #6c757d;
    border-color: #dee2e6;
    transform: none;
    box-shadow: none;
}

.pagination-numbers {
    display: flex;
    gap: 8px;
    align-items: center;
}

.pagination-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 45px;
    height: 45px;
    background: white;
    color: #1B4D89;
    text-decoration: none;
    border-radius: 50%;
    font-weight: 600;
    font-size: 0.9rem;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.pagination-number:hover {
    background: #1B4D89;
    color: white;
    border-color: #1B4D89;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(27, 77, 137, 0.3);
}

.pagination-number-active {
    background: #1B4D89;
    color: white;
    border-color: #1B4D89;
    cursor: default;
    transform: none;
    box-shadow: 0 5px 15px rgba(27, 77, 137, 0.3);
}

.pagination-dots {
    color: #6c757d;
    font-weight: 600;
    padding: 0 5px;
}

.pagination-info {
    margin-top: 15px;
}

.pagination-text {
    color: #666;
    font-size: 0.9rem;
    font-weight: 500;
}

.btn-text {
    font-size: 0.9rem;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .pagination-wrapper {
        gap: 10px;
    }
    
    .pagination-btn {
        padding: 10px 15px;
        font-size: 0.85rem;
    }
    
    .pagination-number {
        width: 40px;
        height: 40px;
        font-size: 0.85rem;
    }
    
    .pagination-text {
        font-size: 0.8rem;
    }
}

@media (max-width: 480px) {
    .pagination-wrapper {
        flex-direction: column;
        gap: 15px;
    }
    
    .pagination-numbers {
        order: 2;
    }
    
    .pagination-btn {
        order: 1;
        width: 100%;
        max-width: 200px;
        justify-content: center;
    }
}
</style>
