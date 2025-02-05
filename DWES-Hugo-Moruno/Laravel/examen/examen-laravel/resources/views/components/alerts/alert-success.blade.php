@if (!empty(trim($slot)))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
         class="float-left ml-1">
        <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-900 px-4 py-2" role="alert">
            <p><i class="fa-solid fa-thumbs-up"></i> {{$slot}}</p>
        </div>
    </div>
@endif
