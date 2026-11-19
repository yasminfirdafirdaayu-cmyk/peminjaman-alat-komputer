
@props([
    'routeName',
    'label' => 'Kembali'
])

<style>
    .btn-kembali {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 11px 17px;
        background: #e7f0ff;
        color: #1765df;
        border: 1px solid #d5e5ff;
        border-radius: 8px;
        font-family: 'Inter', sans-serif;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: .2s;
        margin-bottom: 20px;
    }

    .btn-kembali:hover {
        background: #1765df;
        color: white;
        border-color: #1765df;
    }
</style>

<a href="{{ route($routeName) }}" class="btn-kembali">
    <i class="fas fa-arrow-left"></i>
    {{ $label }}
</a>
